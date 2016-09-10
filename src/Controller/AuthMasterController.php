<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Model\Entity\User;
use Cake\Controller\Component\AuthComponent;
use Cake\Core\Configure;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;

/**
 * Login Controller
 *
 * @property \App\Model\Table\UsersTable $Login
 */
class AuthMasterController extends AppController
{

    public $uses = [];
    public $components = ['Cookie'];
    public function initialize()
    {
//        $this->User = TableRegistry::get('Users');
        parent::initialize(); // TODO: Change the autogenerated stub

    }

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        // set default authentication for all users
        $this->_authInit();
        // Allow users to register and logout.
        // You should not add the "login" action to allow list. Doing so would
        // cause problems with normal functioning of AuthComponent.
        $this->_allowActions();
    }


    protected function _authInit()
    {
        $this->loadComponent(
            'Auth', [
            'authenticate' => [
                'FOC/Authenticate.Cookie' => [
                    'fields' => ['username' => 'username', 'password' => 'password'],
                    'userModel' => 'Users',
                    'scope' => ['users.confirmed' => 1]
                ],
                'FOC/Authenticate.MultiColumn' => array(
                    'fields' => ['username' => 'username', 'password' => 'password'],
                    'passwordHasher' => [
                        'className' => 'Legacy',
                    ],
                    'columns' => ['username', 'email'],
                    'userModel' => 'Users',
                    'scope' => ['users.confirmed' => 1]
                )
            ],
            'loginAction' => [
                'controller' => 'AuthMaster',
                'action' => 'login',
                'login'
            ],
            'loginRedirect' => [
                'controller' => 'AuthMaster',
                'action' => 'index'
            ],
            'logoutRedirect' => [
                'controller' => 'AuthMaster',
                'action' => 'login',
                'login'
            ],
            'authorize' => [
                'SpcAuth.Spc'=>['multiRole'=>true,
                'pivotTable' => 'tbl_master_role_user',
                'autoClearCache' =>Configure::read('debug'),
            ]],
            'authError' => __('Did you really think you are allowed to see that?'),
            'unauthorizedRedirect' =>[
                'controller' => 'AuthMaster',
                'action' => 'accessDenied',
                'access_denied'
            ]

        ]);
        if ($this->Auth->user()) {
            $this->set('userInfo', $this->Auth->user());
            $this->set('params', $this->params);
        }
    }

    protected function _allowActions()
    {
        $this->Auth->allow(['login', 'logout' , 'accessDenied','pageNotFound']);
    }

    public function accessDenied(){

    }

    /**
     * Login method
     *
     *
     */
    public function login()
    {
        $this->viewBuilder()->layout('login');
        if ($this->request->is('post')) {

            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                $this->_setCookie();
                return $this->redirect($this->Auth->redirectUrl());
            }
//            show error
//            $this->Flash->error(__('Invalid username or password, try again'));
        }
    }

    /**
     * Logout method
     *
     *
     */
    public function logout()
    {
        return $this->redirect($this->Auth->logout());
    }


    public function index()
    {

    }

    protected function _setCookie()
    {
        if (!$this->request->data('remember_me')) {
            return false;
        }
        $data = [
            'username' => $this->request->data('username'),
            'password' => $this->request->data('password')
        ];
        $this->Cookie->write('RememberMe', $data, true, '+1 week');
        return true;


    }
}
