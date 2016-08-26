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
        $this->loadComponent('Flash');
//        echo 123;exit;
//           $this->Auth->config('authenticate', [
//            AuthComponent::ALL => [
//               'userModel' => 'Accounts',
//               'scope' => ['Accounts.active' => 1]
//          ],
//          'Form',
//          'Basic'
//       ]);
        $this->loadComponent('Auth', [
                'authenticate' => ['all' => array(
                    'userModel' => 'Accounts'
                ),
                'Form' => [
                    'fields' => ['username' => 'login_id', 'password' => 'login_pass'],
                    'passwordHasher' => [
                        'className' => 'Legacy',
                    ]
                ]
            ],
            'loginRedirect' => [
                'controller' => '/',
                'action' => 'home'
            ],
            'logoutRedirect' => [
                'controller' => 'home',
                'action' => 'login',
                'home'
            ],

        ]);
    }
    public function beforeFilter(Event $event)
    {
        $this->Auth->allow(['login','logout','register']);

    }

//    function __isEffectiveAccount($id,$pass=""){
//
//        if(empty($pass)) return false;
//        $this->loadModel("Accounts");
//        $flg=false;
//        $all_accounts=$this->Accounts->findAllByDelFlg(0);
//        foreach($all_accounts as $k=>$v){
//            $dec_pass=$this->Common->cipher_decrypt($v->login_pass,MCRYPT_KEY);
//            if($dec_pass==$pass){
//                $flg=true;
//                break;
//            }
//        }
//        if(!$flg) return false;
//        if($v->login_id!=$id)
//            return false;
//        return $v;
//    }

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
}
