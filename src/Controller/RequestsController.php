<?php
namespace App\Controller;

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
        'limit' => 1,
        'order' => [
            'Requests.id' => 'desc'
        ]
    ];
    public function index()
    {
        $requests = $this->paginate($this->Requests);
        $this->set(compact('requests'));
        $this->set('_serialize', ['requests']);
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
