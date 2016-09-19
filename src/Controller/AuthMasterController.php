<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Model\Entity\User;
use App\Utility\FunctionCommon;
use Cake\Controller\Component\AuthComponent;
use Cake\Core\Configure;
use Cake\Event\Event;
use Cake\I18n\I18n;
use Cake\ORM\TableRegistry;
use Symfony\Component\Config\Definition\Exception\Exception;

/**
 * Login Controller
 *
 * @property \App\Model\Table\UsersTable $Login
 */
class AuthMasterController extends AppController
{

    public $uses = [];
    public $components = ['Cookie'];
    public $paginate = [
        'limit' => 1
    ];
    public function initialize()
    {
//        $this->User = TableRegistry::get('Users');
        parent::initialize(); // TODO: Change the autogenerated stub
        $this->_authInit();
        $this->_init_language();
//        print_r($this->Cookie->read('RememberMe')) ;exit;
    }

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        // set default authentication for all users

        // Allow users to register and logout.
        // You should not add the "login" action to allow list. Doing so would
        // cause problems with normal functioning of AuthComponent.
        $this->_allowActions();

    }


    protected function _authInit()
    {
        $this->loadComponent('Paginator');
        $this->loadComponent(
            'Auth', [
            'authenticate' => [
                'SpcAuth.SPCCookie' => [
                    'fields' => ['username' => 'username', 'password' => 'password'],
                    'userModel' => 'Users',
                    'passwordHasher' => [
                        'className' => 'Legacy',
                    ],
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
                'action' => 'index',
                'home'
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
            $users = TableRegistry::get('Users');
//            print_r($this->Auth->user());exit;
            $this->uses = $users->find()->where(['Users.id'=>$this->Auth->user()['id']])->contain(['role','dep'])->first();
//            $this->uses = $this->Auth->user();

//            echo '<pre>';
//            print_r($this->uses);
//            echo '</pre>';
//            exit;
            $this->set('userInfo', $this->uses);
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
        }else{
//
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
//                $this->_setCookie();
                return $this->redirect($this->Auth->redirectUrl());
            }
        }
    }

    /**
     * Logout method
     *
     *
     */
    public function logout()
    {
        $this->Auth->logout();
        return $this->redirect($this->Auth->logout());
    }


    public function index()
    {

    }
    private function _getMenu(){
        $roles = TableRegistry::get('Roles');
    }
    protected function _setCookie()
    {
        $common = new FunctionCommon();

        $pass  = $common->cipher_encrypt($this->request->data('password'),MCRYPT_KEY);

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
    private function _init_language(){
        $this->set('ddlLanguage', Configure::read('language'));
        $language = (!empty($this->request->session()->read('Config.language')))   ?   $this->request->session()->read('Config.language') : 'en';
        switch($language)
        {
            case "ja_JP":
                I18n::locale('ja_JP');
                break;
            default:
                I18n::locale('en_US');
                break;
        }
    }
    protected function setLanguage($language)
    {
        try{
            $session = $this->request->session();
            if ($this->Cookie->read('language') && !$session->check('Config.language')) {
                $session->write('Config.language', $this->Cookie->read('language'));
            }
            else if ($language !=  $session->read('Config.language')) {
                $session->write('Config.language', $language);
                $this->Cookie->write('language', $language, false, '20 days');
            }
        }catch(Exception $e){
            return false;
        }

        return true;
    }
    protected function responseData($status = false , $data = null){
         $strStatus = $status ? 'Success' : 'Error';
         $strMessage = $status ? __('successMes') : __('errorMes');
        $result = [
            'status'=> $strStatus,
            'mode'=>$status ? 200 : 500,
            'response'=>is_null($data) ? $strMessage : $data
        ];
        return $result;
    }


}
