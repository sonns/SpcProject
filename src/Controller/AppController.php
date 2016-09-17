<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;
use App\Utility\FunctionCommon as Common;
use Cake\Controller\Component\AuthComponent;
use Cake\Controller\Controller;
use Cake\Core\Configure;
use Cake\Event\Event;
use Cake\I18n\I18n;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link http://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */

    private $Common;

    public function initialize()
    {
        $this->Common = new Common();
        parent::initialize();
        $this->loadComponent('RequestHandler');
        $this->loadComponent('Cookie');
        $this->_init_language();
    }
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
    }
    /**
     * Before render callback.
     *
     * @param \Cake\Event\Event $event The beforeRender event.
     * @return void
     */
    public function beforeRender(Event $event)
    {
        if (!array_key_exists('_serialize', $this->viewVars) &&
            in_array($this->response->type(), ['application/json', 'application/xml'])
        ) {
            $this->set('_serialize', true);
        }
        $this->viewBuilder()->theme('AdminTheme');
        $this->set('theme', Configure::read('Admin'));
    }


    private function _init_language(){
        $this->set('ddlLanguage', Configure::read('language'));
        $language = !isset($this->request->query['language'])   ?   $this->request->session()->read('Config.language')
            :   $this->request->query['language'];
        switch($language)
        {
            case "du":
                I18n::locale('du_DU');
                break;
            case "ru":
                I18n::locale('ru_RU');
                break;
            case "jp":
                I18n::locale('ja_JP');
                break;
            default:
                I18n::locale('en_US');
                break;
        }
    }


    private function _setLanguage()
    {

        $session = $this->request->session();
        if ($this->Cookie->read('language') && !$session->check('Config.language')) {
            $session->write('Config.language', $this->Cookie->read('language'));
        }
        else if (isset($this->request->query['language']) && ($this->request->query['language'] !=  $session->read('Config.language'))) {
            $session->write('Config.language', $this->request->query['language']);
            $this->Cookie->write('language', $this->request->query['language'], false, '20 days');
        }

    }


}
