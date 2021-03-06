<?php
namespace App\Controller;

use App\Utility\FunctionCommon;
use Cake\Core\Configure;
use Cake\Event\Event;
use Cake\I18n\Time;
use Cake\ORM\TableRegistry;
use Cake\Utility\Security;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AuthMasterController
{
    public $paginate = [
        'limit' => 20,
        'contain' => ['Profiles'],
        'order' => [
            'id' => 'desc'
        ]
    ];
    public function  initialize()
    {
        parent::initialize(); // TODO: Change the autogenerated stub
    }

    public function beforeFilter(Event $event)
    {

        parent::beforeFilter($event);
    }

    public function profile(){
//      Get and set profile info
        $listTimezone = new FunctionCommon();
        $this->set('timezone', $listTimezone->getTimeZone());
        $this->set('_serialize', ['timezone']);
    }

    public function saveProfile(){
        $this->request->allowMethod('ajax');
        $result = $this->responseData(false,__('profile_error'));
        if ($this->request->is('post')) {
            if(isset($this->request->data['hdnmode']) && $this->request->data['hdnmode'] === 'profile'){
                $profile = TableRegistry::get('Profiles');
                $profileInfo = $profile->find()->where(['user_id'=>$this->user->id])->first();
                if (!empty($this->request->data['imgProfile']['name'])) {
                    $file = $this->request->data['imgProfile'];

                    $ext = substr(strtolower(strrchr($file['name'], '.')), 1);
                    $arr_ext = array('jpg', 'jpeg', 'gif','png');
                    if (in_array($ext, $arr_ext)) {
                        $path =  WWW_ROOT . 'file/profile/';
                        if(!is_dir($path)){
                            mkdir($path, 777,true);
                        }
                        move_uploaded_file($file['tmp_name'], $path . $file['name']);
                        //prepare the filename for database entry
                        $this->request->data['photo'] = $file['name'];
                        unset($this->request->data['imgProfile']);
                        unset($this->request->data['hdnmode']);
                    }
                }
                unset($this->request->data['imgProfile']);
                //add profile
                if(!count($profileInfo)){
                    $profileE = $profile->newEntity();
                    $this->request->data['user_id'] = $this->user->id;
//                    $this->request->data['birthday'] = Time::parse($this->request->data['birthday']);
                    $profileE = $profile->patchEntity($profileE, $this->request->data);
                    if ($profile->save($profileE)) {
                        $result  = ['params'=>$this->request->data , 'status' => 'Success' , 'response'=> __('profile_success')];
                    }
                }else{
                    //update profile
                    $this->request->data['modified'] = Time::now();
                    $profileInfo = $profile->patchEntity($profileInfo, $this->request->data);
                    if ($profile->save($profileInfo)) {
                        $result  = ['params'=>$this->request->data , 'status' => 'Success' , 'response'=> __('profile_change_success')];
                    }
                }
            }elseif (isset($this->request->data['hdnmode']) && $this->request->data['hdnmode'] === 'resetpass'){
                $query = $this->Users->query();
                $userInfo =  $query->update()
                    ->set(['password' => base64_encode(Security::encrypt($this->request->data['password'], Configure::read("Security.password")))])
                    ->where(['id' => $this->user->id])
                    ->execute();
                if ($userInfo) {
                    $result  = ['params'=>$userInfo , 'status' => 'Success' , 'response'=> __('profile_change_success')];
                }
            }

        }
        $this->set('result',$result);
        $this->set('_serialize', ['result']);

    }
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $users = $this->paginate($this->Users);
//        print_r($users);exit;
        $this->set(compact('users'));
        $this->set('_serialize', ['users']);
    }
    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $roles = TableRegistry::get('Roles');
        if(!$this->request->is('ajax')){

            $listRoles = $roles->find('list', [
                'keyField' => 'id',
                'valueField' => 'display_name',
                'conditions' => ['status' => true,'id >'=>2]
            ]);
            $department = TableRegistry::get('Departments');
            $listDepartments = $department->find('list', [
                'keyField' => 'id',
                'valueField' => 'name',
                'conditions' => ['status' => true,'del_flg' => false]
            ]);
            $this->set(compact('listRoles'));
            $this->set(compact('listDepartments'));
        }else{
            $createUserE = $this->Users->newEntity();
            $this->viewBuilder()->className('AdminTheme.Ajax');
            $isCheck = false;
            $this->set(compact('result'));
            if ($this->request->is('post')) {
                $this->request->data['confirmed'] =  1;
                $createUserE = $this->Users->patchEntity($createUserE, $this->request->data);
                if ($this->Users->save($createUserE)) {
                    $roleUsers = TableRegistry::get('RoleUsers');
                    $roleUserE = $roleUsers->newEntity();
                    $roleUserE->user_id = $createUserE->id;
                    $roleUserE->role_id = $this->request->data['role_id'];
                    $roleUsers->save($roleUserE);
                    $isCheck = true;
                }
                $result = [
                    'status'=> $isCheck,
                    'response'=> $isCheck ?  __('user_success'): __('user_error')
                ];
            }
            $this->set(compact('result'));
            $this->set(compact('_serialize', ['result']));
        }
    }
    public function checkUnique(){
        $this->request->allowMethod('ajax');
        $this->viewBuilder()->className('AdminTheme.Ajax');
//        Check email
        $status = false;
        if($this->checkExist('email')){
            $mode = 1;
            $response = __('email_exist');
        }elseif($this->checkExist('username'))
        {
            $mode = 2;
            $response = __('username_exist');
        }else{
            $roleUsers = TableRegistry::get('RoleUsers');
            $row =  $roleUsers->find()
                ->orWhere(['Users.dep_id'=>$this->request->data['dep_id'] ,'RoleUsers.role_id'=> $this->request->data['role_id'],'Roles.name'=>'top'])
                ->orWhere([['Users.dep_id'=>$this->request->data['dep_id'] ,'RoleUsers.role_id'=> $this->request->data['role_id'],'Roles.name'=>'manager']])
                ->orWhere([['Users.dep_id'=>$this->request->data['dep_id'] ,'RoleUsers.role_id'=> $this->request->data['role_id'],'Roles.name'=>'sub-manager']])
                ->contain(['Users','Roles'])->first();
//            check rule or  return true
            if(count($row)){
                $mode = 3;
                $response = __('already_role_exist');
            }else
            {
                $mode = 4;
                $response =  __("success");
                $status = true;
            }


        }
        $result = [
            'status'=> $status,
            'mode'=>$mode,
            'response'=>$response
        ];
        $this->set(compact('result'));
        $this->set('_serialize', ['result']);
    }
    private function checkExist($key){
        return $this->Users->find('existsOr',[$key=>$this->request->data[$key]]);
    }
    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('user_success'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('user_error'));
            }
        }
        $this->set(compact('user'));
//        $this->set('_serialize', ['User']);
    }
    public function setLanguage($language)
    {
        $status =  $this->setLanguage($language); // TODO: Change the autogenerated stub
        return $this->responseData($status);
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->users->get($id);
        if ($this->users->delete($user)) {
            $this->Flash->success(__('user_del_success'));
        } else {
            $this->Flash->error(__('user_del_error'));
        }

        return $this->redirect(['action' => 'index']);
    }


}
