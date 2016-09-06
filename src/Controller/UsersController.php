<?php
namespace App\Controller;

use App\Controller\AppController;
use App\Utility\FunctionCommon;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{
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

    public function myProfile(){

        if($this->request->is('post')){
            if($this->request->data['hdnmode'] === 'profile')
                $this->saveProfile($this->request->data);
            else if($this->request->data['hdnmode'] === 'resetpass')
                $this->resetPassword($this->request->data);

//            $this->Session->write('Auth.User.timezone', $this->request->data['selectedZone']);

//            if($this->User->updateTimezone($this->request->data)){
//                $this->Session->setFlash(__('The profile has been updated.'));
//            }else{
//                $this->Session->setFlash(__('There was an error updating the profile.'), 'default', array('class' => 'error-message'));
//            }
        }
        $listTimezone = new FunctionCommon();
        $this->set('timezone', $listTimezone->getTimeZone());
        $this->set('_serialize', ['timezone']);

    }

    private function saveProfile($data){


    }
    private function resetPassword($data){

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


//        $this->set('_serialize', ['users']);
    }



    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->users->get($id, [
            'contain' => []
        ]);

        $this->set('userDetail', $user);
//        $this->set('_serialize', ['User']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                echo 1;exit;
                $this->Flash->success(__('The User has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                echo 2;exit;
                $this->Flash->error(__('The User could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('user'));
//        $this->set('_serialize', ['User']);
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
