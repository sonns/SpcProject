<?php

namespace SpcAuth\Controller\Component;

use Cake\Cache\Cache;
use Cake\Controller\ComponentRegistry;
use Cake\Controller\Component\AuthComponent as CakeAuthComponent;
use Cake\Core\Configure;
use Cake\Core\Exception\Exception;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
use SpcAuth\Utility\Utility;

/**
 * SpcAuth AuthComponent to handle all authentication in a central ini file.
 */
class AuthComponent extends CakeAuthComponent {

	/**
	 * @var array
	 */
	protected $_defaultSpcAuthConfig = [
	    'mode'=>true,
		'cache' => '_cake_core_',
		'cacheKey' => 'spc_auth_allow',
		'cacheKeyAcl' => 'spc_auth_acl',
		'autoClearCache' => false, // Set to true to delete cache automatically in debug mode
		'filePath' => null, // Possible to locate ini file at given path e.g. Plugin::configPath('Admin')
		'file' => 'auth_allow.ini',
		'file_alc' => 'acl.ini',
		'rolesTable' => 'Roles',// name of Configure key holding available roles OR class name of roles table
		'aliasColumn' => 'name',// Name of column in roles table holding role alias/slug
	];

	/**
	 * @param \Cake\Controller\ComponentRegistry $registry
	 * @param array $config
	 * @throws \Cake\Core\Exception\Exception
	 */
	public function __construct(ComponentRegistry $registry, array $config = []) {
		$config += $this->_defaultSpcAuthConfig;

		parent::__construct($registry, $config);

		if (!in_array($config['cache'], Cache::configured())) {
			throw new Exception(sprintf('Invalid SpcAuth cache `%s`', $config['cache']));
		}
	}

	/**
	 * @param \Cake\Event\Event $event Event instance.
	 * @return \Cake\Network\Response|null
	 */
	public function startup(Event $event) {
	    if($this->_config['mode']){
            $this->_prepareAuthentication();
        }
		return parent::startup($event);
	}

	/**
	 * @return void
	 */
	protected function _prepareAuthentication() {
		$authentication = $this->_getAuth($this->_config['filePath']);

		$params = $this->request->params;
		foreach ($authentication as $rule) {
			if ($params['plugin'] && $params['plugin'] !== $rule['plugin']) {
				continue;
			}
			if (!empty($params['prefix']) && $params['prefix'] !== $rule['prefix']) {
				continue;
			}
			if ($params['controller'] !== $rule['controller']) {
				continue;
			}

			if ($rule['actions'] === []) {
				$this->allow();
				return;
			}

			$this->allow($rule['actions']);
		}
	}

	/**
	 * Parse ini file and returns the allowed actions.
	 *
	 * Uses cache for maximum performance.
	 *
	 * @param string|null $path
	 * @return array Actions
	 */
	protected function _getAuth($path = null) {
		if ($path === null) {
			$path = ROOT . DS . 'config' . DS;
		}

		if ($this->_config['autoClearCache'] && Configure::read('debug')) {
			Cache::delete($this->_config['cacheKey'], $this->_config['cache']);
		}
		$roles = Cache::read($this->_config['cacheKey'], $this->_config['cache']);
		if ($roles !== false) {
			return $roles;
		}

		$iniArray = Utility::parseFile($path . $this->_config['file']);

		$res = [];
		foreach ($iniArray as $key => $actions) {
			$res[$key] = Utility::deconstructIniKey($key);
			$res[$key]['map'] = $actions;

			$actions = explode(',', $actions);

			if (in_array('*', $actions)) {
				$res[$key]['actions'] = [];
				continue;
			}

			foreach ($actions as $action) {
				$action = trim($action);
				if (!$action) {
					continue;
				}

				$res[$key]['actions'][] = $action;
			}
		}

		Cache::write($this->_config['cacheKey'], $res, $this->_config['cache']);
		return $res;
	}

	public function getACL($path = null){
        if ($path === null) {
            $path = ROOT . DS . 'config' . DS;
        }

        if ($this->_config['autoClearCache'] && Configure::read('debug')) {
            Cache::delete($this->_config['cacheKeyAcl'], $this->_config['cache']);
        }
        $roles = Cache::read($this->_config['cacheKeyAcl'], $this->_config['cache']);
        if ($roles !== false) {
            return $roles;
        }

        $iniArray = Utility::parseFile($path . $this->_config['file_alc']);
        $availableRoles = $this->_getAvailableRoles();
        $res = [];
		foreach ($iniArray as $key => $array) {

			$tempRes = Utility::deconstructIniKey($key);
			$res[$tempRes['controller']] =$tempRes;

			$res[$tempRes['controller']]['map'] = $array;

			foreach ($array as $actions => $roles) {
				// Get all roles used in the current ini section
				$roles = explode(',', $roles);
				if($actions === 'actions' ){
					$tempActions = [];
					foreach($roles as $act) {
						list($k, $v) = explode('|', $act);
						$tempActions[ $k ] = $v;
					}
					$res[$tempRes['controller']]['roles'] = $tempActions;
					continue;
				}
				$actions = explode(',', $actions);
				foreach ($roles as $roleId => $role) {
					$role = trim($role);
					if (!$role) {
						continue;
					}
					// Prevent undefined roles appearing in the iniMap
					if (!array_key_exists($role, $availableRoles) && $role !== '*') {
						unset($roles[$roleId]);
						continue;
					}
					if ($role === '*') {
						unset($roles[$roleId]);
						$roles = array_merge($roles, array_keys($availableRoles));
					}
				}

				foreach ($actions as $action) {
					$action = trim($action);
					if (!$action) {
						continue;
					}

					foreach ($roles as $role) {
						$role = trim($role);
						if (!$role || $role === '*') {
							continue;
						}
						// Lookup role id by name in roles array
						$newRole = $availableRoles[strtolower($role)];
						$res[$tempRes['controller']]['actions'][$action][] = $newRole;
					}
				}

			}
        }

        Cache::write($this->_config['cacheKeyAcl'], $res, $this->_config['cache']);
        return $res;
    }
    /**
     * Returns a list of all available roles.
     *
     * Will look for a roles array in
     * Configure first, tries database roles table next.
     *
     * @return array List with all available roles
     * @throws \Cake\Core\Exception\Exception
     */
    protected function _getAvailableRoles() {
        $roles = Configure::read($this->_config['rolesTable']);
        if (is_array($roles)) {
            return $roles;
        }

        $rolesTable = TableRegistry::get($this->_config['rolesTable']);
        $roles = $rolesTable->find()->formatResults(function ($results) {
            return $results->combine($this->_config['aliasColumn'], 'id');
        })->toArray();
        if (count($roles) < 1) {
            throw new Exception('Invalid SpcAuth role setup (roles table `' . $this->_config['rolesTable'] . '` has no roles)');
        }

        return $roles;
    }
}
