<?php
namespace App\Controller;

use App\Controller\AppController;
use Aura\Intl\Exception;

/**
 * Departments Controller
 *
 * @property \App\Model\Table\DepartmentsTable $Departments
 */
class DepartmentsController extends AuthMasterController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public $paginate = [
        'limit' => 1,
        'order' => [
            'Departments.title' => 'asc'
        ]
    ];
    public function  initialize()
    {
        parent::initialize(); // TODO: Change the autogenerated stub
        $this->loadComponent('Paginator');
    }

    public function index()
    {
        $depart = $this->Departments->newEntity();
        $departments = $this->paginate($this->Departments);
        $this->set(compact('departments'));
        $this->set('_serialize', ['departments']);
        $this->set(compact('depart'));
        $this->set('_serialize', ['depart']);
    }

    /**
     * View method
     *
     * @param string|null $id Department id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $department = $this->Departments->get($id, [
            'contain' => []
        ]);

        $this->set('department', $department);
        $this->set('_serialize', ['department']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $department = $this->Departments->newEntity();
        try{
            if ($this->request->is('post')) {
                $department = $this->Departments->patchEntity($department, $this->request->data);
                $result = [];
                if ($this->Departments->save($department)) {
                    $result = [
                        'status' => 'Success',
                        'response' => __('The department has been saved.')
                    ];
                } else {
                    $result = [
                        'status' => 'Error',
                        'response' => __('The department could not be saved. Please, try again.')
                    ];
                }
            }
        }catch (Exception $e){
//            debug
            $result = [
                'status' => 'Success',
                'response' => $e->getMessage()
            ];
        }

        $this->set(compact('department'));
        $this->set(compact('result'));
        $this->set('_serialize', ['result']);
    }
    /**
     * Edit method
     *
     * @param string|null $id Department id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $department = $this->Departments->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $department = $this->Departments->patchEntity($department, $this->request->data);
            if ($this->Departments->save($department)) {
                $this->Flash->success(__('The department has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The department could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('department'));
        $this->set('_serialize', ['department']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Department id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $department = $this->Departments->get($id);
        if ($this->Departments->delete($department)) {
            $this->Flash->success(__('The department has been deleted.'));
        } else {
            $this->Flash->error(__('The department could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
