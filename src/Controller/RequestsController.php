<?php
namespace App\Controller;
use Cake\ORM\TableRegistry;

/**
 * Base Controller
 *
 * @property \App\Model\Table\RequestsTable $Requests
 */
class RequestsController extends AuthMasterController
{
    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public $paginate = [
        'limit' => 4,
        'finder' => 'orWhere',
        'order' => [
            'Requests.id' => 'desc'
        ],
        'contain' =>[
            'Users'=>array('fields'=>['first_name','last_name']),
            'Departments' =>['fields'=>['name']],
            'Categories' => ['fields'=>['name']]
        ]
    ];
    public function index()
    {
        $roles = TableRegistry::get('Categories');
        $listCate = $roles->find('list', [
            'keyField' => 'id',
            'valueField' => 'name',
            'conditions' => ''
        ]);
        //check staff
//        echo '<pre>';
//        print_r($this->uses);
//        echo '<pre>';exit;
        $conditions = [];
        if($this->uses->role[0]->name ==='staff') {
            $conditions = ['conditions' => ['user_id' => $this->uses->id]];
        }elseif ($this->uses->role[0]->name ==='top'){
            $conditions = ['conditions' => ['status >=' => 4] , 'OR' => ['user_id' => $this->uses->role[0]->id]];
        }elseif ($this->uses->role[0]->name ==='manager'){
            $conditions = ['conditions' => ['status' => 3] , 'OR' => ['user_id' => $this->uses->role[0]->id]];
        }
        elseif ($this->uses->role[0]->name ==='sub-manager'){
            $conditions = ['conditions' => ['status' => 2] , 'OR' => ['user_id' => $this->uses->role[0]->id]];
        }else{
            $conditions = [];
        }
        $requests = $this->paginate($this->Requests,$conditions);
//        print_r($requests);exit;

//        echo '<pre>';print_r($requests) ; echo '</pre>';exit;
        $this->set(compact('requests'));
        $this->set(compact('listCate'));
        $this->set('_serialize', ['requests']);
        $this->set('_serialize', ['listCate']);
    }
    protected function _checkHead($data){
        if($data['id'] === 2 )
            return true;
        else{
            return false;
        }
    }
    /**
     * View method
     *
     * @param string|null $id Base id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {


    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {

        $base = $this->Base->newEntity();
        if ($this->request->is('post')) {
            $base = $this->Base->patchEntity($base, $this->request->data);
            if ($this->Base->save($base)) {
                $this->Flash->success(__('The base has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The base could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('base'));

        $this->set('_serialize', ['base']);
        $this->set('_serialize', ['listCate']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Base id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $base = $this->Base->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $base = $this->Base->patchEntity($base, $this->request->data);
            if ($this->Base->save($base)) {
                $this->Flash->success(__('The base has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The base could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('base'));
        $this->set('_serialize', ['base']);
    }
    /**
     * Delete method
     *
     * @param string|null $id Base id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $base = $this->Base->get($id);
        if ($this->Base->delete($base)) {
            $this->Flash->success(__('The base has been deleted.'));
        } else {
            $this->Flash->error(__('The base could not be deleted. Please, try again.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
