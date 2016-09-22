<?php
namespace App\Controller;
use Cake\I18n\Time;
use Cake\Network\Exception\NotFoundException;
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
        $roles = TableRegistry::get('Categories');
        $listCate = $roles->find('list', [
            'keyField' => 'id',
            'valueField' => 'name',
            'conditions' => ''
        ]);
        $request = $this->Requests->newEntity();
        if ($this->request->is('post')) {

            //Check if image has been uploaded
            if (!empty($this->request->data['fileAttach']['name'])) {
                $file = $this->request->data['fileAttach'];

                $ext = substr(strtolower(strrchr($file['name'], '.')), 1);
                $arr_ext = array('jpg', 'jpeg', 'gif','png');
                if (in_array($ext, $arr_ext)) {
                    $path =  WWW_ROOT . 'file\request\\';
                    if(!is_dir($path)){
                        mkdir($path, 777,true);
                    }
                    move_uploaded_file($file['tmp_name'], $path . $file['name']);
                    //prepare the filename for database entry
                    $this->request->data['attach'] = $file['name'];
                }
            }
            $this->request->data['user_id'] = $this->uses->id;
            $this->request->data['dep_id'] = $this->uses->dep_id;
            $this->request->data['txtApproveDate'] = Time::parse($this->request->data['txtApproveDate']);
//            echo '<pre>';
//            print_r($this->request->data);
//            echo '</pre>';
//            exit;
            $request = $this->Requests->patchEntity($request, $this->request->data);
            if ($this->Requests->save($request)) {
                $this->Flash->success(__('The base has been saved.'));
                return $this->redirect(['action' => 'add']);
            } else {
                $this->Flash->error(__('The base could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('request'));
        $this->set(compact('listCate'));
        $this->set('_serialize', ['request']);
        $this->set('_serialize', ['listCate']);
    }
    public function addRequest()
    {
        if($this->request->is('ajax')){
            $request = $this->Requests->newEntity();
            $result = [];
            if ($this->request->is('post')) {
                //Check if image has been uploaded
                if (!empty($this->request->data['fileAttach']['name'])) {
                    $file = $this->request->data['fileAttach'];

                    $ext = substr(strtolower(strrchr($file['name'], '.')), 1);
                    $arr_ext = array('jpg', 'jpeg', 'gif','png');
                    if (in_array($ext, $arr_ext)) {
                        $path =  WWW_ROOT . 'file\request\\';
                        if(!is_dir($path)){
                            mkdir($path, 777,true);
                        }
                        move_uploaded_file($file['tmp_name'], $path . $file['name']);
                        //prepare the filename for database entry
                        $this->request->data['attach'] = $file['name'];
                    }
                }
                $this->request->data['user_id'] = $this->uses->id;
                $this->request->data['dep_id'] = $this->uses->dep_id;
                $this->request->data['txtApproveDate'] = Time::parse($this->request->data['txtApproveDate']);
                $request = $this->Requests->patchEntity($request, $this->request->data);
                if ($this->Requests->save($request)) {
                    $result  = ['params'=>$request , 'status' => 'Success' , 'response'=> __('The request has been saved.')];
                } else {
                    $result  = ['params'=>$request , 'status' => 'Error' , 'response'=> __('The request could not be saved. Please, try again or contact for admin page.')];
                }
            }
            $this->set(compact('result'));
            $this->set('_serialize', ['result']);
        }
    }

    public function changeStatus(){
        $this->request->allowMethod('ajax');
        $id = $this->request->query('request_id');
        $mod = $this->request->query('mod') ;
        if (!$id || !$this->request->query('mod')) {
            throw new NotFoundException();
        }
        if($mod === 'app' || $mod === 'del' || $mod === 'rej'){
            $request = $this->Requests->get($id);
            if (!$request) {
                throw new NotFoundException();
            }
            if($mod === 'app'){
                $request->status = 1;
            }elseif ($mod === 'rej'){
                $request->status = 2;
            }else{
                $request->status = 3;
            }
            $temp = $this->Requests->save($request);
            $result = $this->responseData(true,count($temp));
        }elseif($mod === 'multiDel' || $mod === 'multiApp'|| $mod === 'multiRej'){
            if($mod === 'multiApp'){
                $status = 1;
            }elseif ($mod === 'multiRej'){
                $status = 2;
            }else{
                $status = 3;
            }
            $arrId = explode(',',$id);
            $temp = $this->Requests->updateAll(['status'=> $status],['id IN'=>$arrId]);
            $result = $this->responseData(true,$temp);
        }
        $this->set(compact('result'));
        $this->set('_serialize', ['result']);
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
    public function preview(){

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
