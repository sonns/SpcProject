<?php
namespace App\Controller;

use App\Utility\FunctionCommon;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AuthMasterController
{
    public $paginate = [
        'limit' => 4
    ];
    public function  initialize()
    {
        parent::initialize(); // TODO: Change the autogenerated stub
    }

    public function beforeFilter(Event $event)
    {

        parent::beforeFilter($event);
    }

    public function isAuthorized($user = null)
    {

        // All registered users can add articles
        if ($this->request->action === 'add') {
            return true;
        }
        // The owner of an article can edit and delete it
        if (in_array($this->request->action, ['edit', 'delete'])) {

            $userId = (int)$this->request->params[''][0];
            if ($this->User->isOwnedBy($userId, $user['id'])) {
                return true;
            }
        }
        return parent::isAuthorized($user);
    }

    public function profile(){




        if($this->request->is('post')){
//            if($this->request->data['hdnmode'] === 'profile')
//                $this->saveProfile($this->request->data);
//            else if($this->request->data['hdnmode'] === 'resetpass')
//                $this->resetPassword($this->request->data);

//            $this->Session->write('Auth.User.timezone', $this->request->data['selectedZone']);

//            if($this->User->updateTimezone($this->request->data)){
//                $this->Session->setFlash(__('The profile has been updated.'));
//            }else{
//                $this->Session->setFlash(__('There was an error updating the profile.'), 'default', array('class' => 'error-message'));
//            }
        }
//      Get and set profile info
        $listTimezone = new FunctionCommon();
        $this->set('timezone', $listTimezone->getTimeZone());
        $this->set('_serialize', ['timezone']);

    }

    public function saveProfile(){
        $this->request->allowMethod('ajax');
//        echo 123;exit;
        $result = $this->request->data['first_name'];
        print_r($result);exit;
        $this->set('result',$result);
        $this->set('_serialize', ['result']);

    }

    private function resetPassword($data){
        $userE = $this->Users->newEntity();
        try{
            $userE = $this->Users->patchEntity($userE, $data);
            $result = [];
            if ($this->Users->save($userE)) {
                $result = [
                    'status' => 'Success',
                    'response' => __('Your profile has been saved.')
                ];
            } else {
                $result = [
                    'status' => 'Error',
                    'response' => __('Your profile could not be saved. Please, try again.')
                ];
            }
        }catch (Exception $e){
//            debug
            $result = [
                'status' => 'Success',
                'response' => $e->getMessage()
            ];
        }
        $this->set(compact('result'));
        $this->set('_serialize', ['result']);
    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->set('users', $this->Users->find('all'));
        $userE = $this->Users->newEntity();
        $users = $this->paginate($this->Users);
        $this->set(compact('users'));
        $this->set('_serialize', ['users']);
        $this->set(compact('userE'));
        $this->set('_serialize', ['userE']);
    }
    protected function _allowActions() {
//        $this->Auth->allow(['index']);
    }
    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {

        if(!$this->request->is('ajax')){
            $roles = TableRegistry::get('Roles');
            $listRoles = $roles->find('list', [
                'keyField' => 'id',
                'valueField' => 'display_name',
                'conditions' => ['status' => true]
            ]);
            $department = TableRegistry::get('Departments');
            $listDepartments = $department->find('list', [
                'keyField' => 'id',
                'valueField' => 'name',
                'conditions' => ['status' => true]
            ]);
            $this->set(compact('listRoles'));
            $this->set(compact('listDepartments'));
        }else{
            $createUserE = $this->Users->newEntity();
            $this->request->allowMethod('ajax');
            $this->viewBuilder()->className('AdminTheme.Ajax');
            $isCheck = false;
            $this->set(compact('result'));
            if ($this->request->is('post')) {
                $createUserE = $this->Users->patchEntity($createUserE, $this->request->data);
                if ($this->Users->save($createUserE)) {
                    $isCheck = true;
                }
                $result = [
                    'status'=> $isCheck,
                    'response'=> $isCheck ?  __('The user has been saved.'): __('The User could not be saved. Please, try again.')
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
            $response = __('This e-mail already exists, please change it');
        }elseif($this->checkExist('username'))
        {
            $mode = 2;
            $response = __('This username already exists, please change it');
        }else{
//            check rule or  return true
            $mode = 3;
            $response =  __("OK!!!");
            $status = true;
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
                $this->Flash->success(__('The User has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The User could not be saved. Please, try again.'));
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
            $this->Flash->success(__('The User has been deleted.'));
        } else {
            $this->Flash->error(__('The User could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
