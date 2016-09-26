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
//    public $paginate = [
//        'limit' => 4,
//        'finder' => 'orWhere',
//        'order' => [
//            'Requests.id' => 'desc'
//        ],
//        'contain' =>[
//            'Users'=>array('fields'=>['username']),
//            'Departments' =>['fields'=>['name']],
//            'Categories' => ['fields'=>['name']]
//        ]
//    ];
    public $paginate = [
        'limit' => 6,
        'finder' => 'requestList',
        'order' => [
            'Requests.id' => 'asc'
        ]
    ];

//SELECT Req.*, de.name as department_name ,
//max(CASE WHEN ro.name = 'top' and ap.status = 'approved'  THEN TRUE ELSE FALSE END ) `top_status`,
//max(CASE WHEN ro.name = 'manager' and ap.status = 'approved' THEN TRUE ELSE FALSE END) `manager_status`,
//max(CASE WHEN ro.name = 'sub-manager' and ap.status = 'approved' THEN TRUE ELSE FALSE END) `sub_manager_status`
//FROM tbl_master_requests as Req
//LEFT JOIN tbl_master_approval as ap ON req.id = ap.req_id LEFT JOIN tbl_master_departments as de ON de.id = Req.dep_id
//LEFT JOIN tbl_master_roles as ro ON ro.id = ap.role_id
//GROUP BY Req.id




    public function index()
    {
        $roles = TableRegistry::get('Categories');
        $listCate = $roles->find('list', [
            'keyField' => 'id',
            'valueField' => 'name',
            'conditions' => ''
        ]);

        $conditions = [];
        if($this->user->role[0]->name ==='staff') {
//            $conditions = ['group'=>['Requests.id'], 'conditions' => ['Requests.user_id' => $this->user->id]];
            $conditions = ['group'=>['Requests.id Having Requests.user_id = '.$this->user->id.''],'conditions' => ['OR'=> ['Requests.status ' => 1]]];
        }elseif ($this->user->role[0]->name ==='top'){
//            $conditions = ['group'=>['Requests.id Having manager_status = 1'],'conditions' => ['OR'=> ['Requests.user_id ' => $this->user->id]]];
            $conditions = ['group'=>['Requests.id Having manager_status = 1 or Requests.user_id = '.$this->user->id.''],'conditions' => ['OR'=> ['Requests.status ' => 1]]];
        }elseif ($this->user->role[0]->name ==='manager'){
            $conditions = ['group'=>['Requests.id Having (department_id = 2 and department_id = '.$this->user->dep_id.' or Requests.user_id = '.$this->user->id.')
            or ( department_id <> 2 and department_id = '.$this->user->dep_id.' and sub_manager_status = 1 or Requests.user_id = '.$this->user->id.' )'],'conditions' => ['OR'=> ['Requests.status ' => 1]]];
        }
        elseif ($this->user->role[0]->name ==='sub-manager'){
            $conditions = ['group'=>['Requests.id Having  department_id <> 2 and role_name =\'staff\' and department_id = '.$this->user->dep_id.' or Requests.user_id = '.$this->user->id.' '],'conditions' => ['OR'=> ['Requests.status ' => 1]]];
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
            $this->request->data['user_id'] = $this->user->id;
            $this->request->data['dep_id'] = $this->user->dep_id;
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
                $this->request->data['user_id'] = $this->user->id;
                $this->request->data['dep_id'] = $this->user->dep_id;
                $request->status = 1;
                $this->request->data['txtApproveDate'] = Time::parse($this->request->data['txtApproveDate']);
                $request = $this->Requests->patchEntity($request, $this->request->data);
                $request = $this->Requests->save($request);
                if ($request) {
                    $this->Requests->save($request);
//                    if($this->user->role[0]->name === 'top' || ($this->user->role[0]->name === 'manager' && $this->user->dep_id === 2)){
//                        $this->_autoApprove($request->id);
//                    }
                    $result  = ['params'=>$request , 'status' => 'Success' , 'response'=> __('The request has been saved.')];
                } else {
                    $result  = ['params'=>$request , 'status' => 'Error' , 'response'=> __('The request could not be saved. Please, try again or contact for admin page.')];
                }
            }
            $this->set(compact('result'));
            $this->set('_serialize', ['result']);
        }
    }
//    private function _autoApprove($req_id){
//        if(!empty($req_id)){
//            $approval = TableRegistry::get('Approvals');
//            $approvalInfo = $approval->find()->where(['user_id'=>$this->user->id,'req_id'=>$req_id])->first();
//            if(!count($approvalInfo)){
//                $approvalE = $approval->newEntity();
//                $approvalE->user_id = $this->user->id;
//                $approvalE->req_id = $req_id;
//                $approval->save($approvalE);
//            }
//            return true;
//        }
//        return false;
//    }

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
            $approval = TableRegistry::get('Approvals');
            $approvalInfo = $approval->find()->where(['user_id'=>$this->user->id,'req_id'=>$id])->first();

            if($mod !== 'app' && $mod !== 'rej'){
                $request->status = 0;
            }
            else{
                if(!count($approvalInfo)){
                    $approvalE = $approval->newEntity();
                    $approvalE->user_id = $this->user->id;
                    $approvalE->req_id = $id;
                    $approvalE->role_id = $this->user->role[0]->id;
                    $approvalE->status = ($mod === 'app' ) ? 'approved' : 'rejected' ;
                    $approval->save($approvalE);
                }else{
                    throw new NotFoundException();
                }
            }
            $temp = $this->Requests->save($request);
            $result = $this->responseData(true,count($temp));
        }elseif($mod === 'multiDel' || $mod === 'multiApp'|| $mod === 'multiRej'){
            if($mod === 'multiApp'){
                throw new NotFoundException();
            }elseif ($mod === 'multiRej'){
                throw new NotFoundException();
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
