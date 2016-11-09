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
    public $user = [];
    public $components = ['Cookie','Flash'];
    public $paginate = [
        'limit' => 10
    ];
    public function initialize()
    {
//        $this->User = TableRegistry::get('Users');
        parent::initialize(); // TODO: Change the autogenerated stub
        $this->loadComponent('Notification.Notification');

        $this->_authInit();
        $this->_init_language();
        $this->_initNotification();
    }
    private function _initNotification(){
        if (!empty($this->user)) {
            $tblUser = TableRegistry::get('Users');
//            echo '<pre>';
//            print_r($tblUser->find('groupUsers', ['Roles.name' => 'top']));
//            echo '<pre>'
//            exit;
            $this->Notification->addRecipientList('top', $tblUser->find('groupUsers', ['Roles.name' => 'top']));
            $this->Notification->addRecipientList('manager', $tblUser->find('groupUsers', ['Roles.name' => 'manager','Users.dep_id'=> $this->user->dep_id]));
            if($this->user->role[0]->name !== 'top') {
                $this->Notification->addRecipientList('sub-manager', $tblUser->find('groupUsers', ['Roles.name' => 'sub-manager','Users.dep_id'=> $this->user->dep_id]));
            }
            // count all unread notifications
            $countUnreadNoti =  $this->Notification->countNotifications($this->user->id,true);
            // get all unread notifications;
            $totalUnreadNoti = $this->Notification->getNotifications($this->user->id,null,true,10);
            $arrNotification = [
                'count' => $countUnreadNoti,
                'notificationList' => $totalUnreadNoti
            ];
            $this->set(compact('arrNotification'));
        }
    }
    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        // set default authentication for all users
        // Allow users to register and logout.
        // You should not add the "login" action to allow list. Doing so would
        // cause problems with normal functioning of AuthComponent.
        $this->_authInit();
        $this->_allowActions();

    }
    protected function _authInit()
    {
        $this->loadComponent('Paginator');
        $this->loadComponent(
            'Auth', [
            'authenticate' => [
                'FOC/Authenticate.Cookie' => [
                    'fields' => ['username' => 'username', 'password' => 'password'],
                    'userModel' => 'Users',
                    'passwordHasher' => [
                        'className' => 'Legacy',
                    ],
                    'scope' => ['Users.confirmed' => 1]
                ],
                'FOC/Authenticate.MultiColumn' => array(
                    'fields' => ['username' => 'username', 'password' => 'password'],
                    'passwordHasher' => [
                        'className' => 'Legacy',
                    ],
                    'columns' => ['username', 'email'],
                    'userModel' => 'Users',
                    'scope' => ['Users.confirmed' => 1]
                )
            ],
            'loginAction' => [
                'controller' => 'AuthMaster',
                'action' => 'login',
                'login'
            ],
            'loginRedirect' => [
                'controller' => 'Requests',
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

        if (!$this->Auth->user()) {
            $user = $this->Auth->identify();
            $this->Auth->setUser($user);
        }
        if ($this->Auth->user()) {
//            echo 1234;exit;
            $users = TableRegistry::get('Users');
            $this->user = $users->find()->where(['Users.id' => $this->Auth->user()['id']])
                ->contain(['role', 'dep', 'Profiles'])->first();
//                    echo '<pre>';
//                    print_r($this->user);
//                    echo '</pre>';
//                    exit;
            $this->set('userInfo', $this->user);
            $this->set('params', $this->params);
            if (!empty($this->user) && empty($this->user->profile)) {
                if (!$this->_isUpdateProfile())
                    return $this->redirect('user/profile');
            } elseif(empty($this->user)){
//                print_r($this->user);exit;
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->_initMenu();
        }
    }
    private function _isUpdateProfile(){
        if($this->request->params['action'] === 'saveProfile' && $this->request->params['controller'] === 'Users')
            return true;
        if($this->request->params['action'] !== 'profile' || $this->request->params['controller'] !== 'Users')
            return false;
        return true;
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
                $this->Flash->success(__('Login success!!!'));
                return $this->redirect($this->Auth->redirectUrl());
            }
//            show error
            $this->Flash->error(__('Invalid username or password, try again'));
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
        $this->Cookie->delete('RememberMe');
        return $this->redirect($this->Auth->logout());
    }
    public function index()
    {

    }
    private function _initMenu(){
        $this->loadComponent('MyAuth',[
            'className'=>'SpcAuth.Auth',
            'autoClearCache' => true,
            'multiRole' => true,
            'rolesTable'=> 'Roles',
            'pivotTable'=> 'tbl_master_role_user',
            'mode' =>false,
        ]);
        $menus = [
            'left-menu'=>[
//                [
//                    'position'=>1,
//                    'title'=>"Dashboard",
//                    'url' => ['controller'=>"AuthMaster",'action'=>'index'],
//                    'hasPermission' => false,
//                    'active' => false
//
//                ],
                [
                    'position'=>2,
                    'title'=>"Department",
                    'url' => ['controller'=>"Departments",'action'=>'index'],
                    'hasPermission' => false,
                    'active' => false
                ],
                [
                    'position'=>3,
                    'title'=>'User',
                    'url' => ['controller'=>"Users",'action'=>'index'],
                    'children' => [
                        [
                            'position'=>1,
                            'title'=>'Profile',
                            'url' => ['controller'=>"Users",'action'=>'profile'],
                            'active' => false,
                            'hasPermission' => false

                        ],
                        [
                            'position'=>2,
                            'title'=>'Manage User',
                            'url' => ['controller'=>"Users",'action'=>'index'],
                            'active' => false,
                            'hasPermission' => false
                        ],
                        [
                            'position'=>3,
                            'title'=>'Create User',
                            'url' => ['controller'=>"Users",'action'=>'add'],
                            'active' => false,
                            'hasPermission' => false
                        ]
                    ],
                    'active' => false,
                    'hasPermission' => false
                ],
                [
                    'position'=>4,
                    'title'=>"Configuration",
                    'url' => ['controller'=>"Roles",'action'=>'index'],
                    'active' => false,
                    'hasPermission' => false
                ],
                [
                    'position'=>5,
                    'title'=>'Request',
                    'url' => ['controller'=>"Requests",'action'=>'index'],
                    'active' => false,
                    'hasPermission' => false
                ],
//                [
//                    'position'=>6,
//                    'title'=>'Notification',
//                    'url' => ['controller'=>"Notifications",'action'=>'index'],
//                    'active' => false,
//                    'hasPermission' => false
//                ],
                [
                    'position'=>7,
                    'title'=>"Message",
                    'url' => ['controller'=>"Messages",'action'=>'index'],
                    'active' => false,
                    'hasPermission' => false
                ]
            ]
        ];
        // check roles
        $listAcl = $this->MyAuth->getActionByRoles($this->Auth->user());
        $result = $this->_checkRole($menus['left-menu'],$listAcl);
//        echo '<pre>';
//        print_r($result);
//        echo '</pre>';
//        exit;
        $this->set('sidebar',$result);
    }
    private function _checkRole(array $menus , $listAcl , $checkPerm = false){
        foreach ($menus as $key => $menu )
        {
//            print_r($menu);exit;
            if(isset($menu['children'])){
                $menu['children'] = $this->_checkRole($menu['children'],$listAcl);
                $menus[$key]['children'] =  $menu['children'];
                $menus[$key]['hasPermission'] = $this->_checkRole($menu['children'],$listAcl,true);
            }
            if(isset($listAcl[$menu['url']['controller']]) && ( in_array('*',$listAcl[$menu['url']['controller']]) || in_array($menu['url']['action'],$listAcl[$menu['url']['controller']]))){
                $menus[$key]['hasPermission'] = true;
                if($checkPerm){
                    return true;
                }
                if($menu['url']['controller'] === $this->request->params['controller']){
//                    echo $this->request->params['controller'];exit;
                    $menus[$key]['active'] = true;
//                    if(isset($menu['children'])){
//
//                    }elseif($menu['url']['action'] === $this->request->params['action']){
//                        $menus[$key]['active'] = true;
//                    }
                }
            }
        }

        return $menus;
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
        $language = (!empty($this->request->session()->read('Config.language')))   ?   $this->request->session()->read('Config.language') : 'jp_JP';
        $this->set('selectLanguage', isset(Configure::read('language')[$language]) ? Configure::read('language')[$language] : 'Japan (JP)');
        switch($language)
        {
            case "jp_JP":
                I18n::locale('jp_JP');
                $result[] = array(
                    'ok'=>I18n::locale()
                );
                break;
            default:
                I18n::locale('en_US');
                break;
        }

    }
    public function changeLanguage()
    {
        $this->request->allowMethod('ajax');
        $session = $this->request->session();
        if($this->request->is('ajax')){
            if (!empty($this->request->query('keyLanguage')) && $this->request->query('keyLanguage') !=  $session->read('Config.language')) {
                $session->write('Config.language', $this->request->query('keyLanguage'));
                $this->Cookie->write('language', $this->request->query('keyLanguage'), false, '20 days');
            }
            $result = array(
                'language'=>$this->request->query('keyLanguage')
            );
        }else{
            if ($this->Cookie->read('language') && !$session->check('Config.language')) {
                $session->write('Config.language', $this->Cookie->read('language'));
            }
        }
        $this->_init_language();
        $this->set(compact('result'));
        $this->set('_serialize', ['result']);
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
    private function _iniNotification(){
        $templates = Configure::read('Notification.templates');
        if (array_key_exists('Request', $templates)) {
            Configure::write('Notification.templates.Request', [
                'title' => ' :title ',
                'body' => ':username has posted a request named :name'
            ]);
        }
        return true;

    }
}
