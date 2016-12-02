<?php
namespace App\Controller;
use Cake\I18n\Time;
use Cake\Network\Exception\NotFoundException;
use Cake\ORM\TableRegistry;
use Cake\Routing\Router;

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
        'limit' => 20,
        'finder' => 'requestList',
        'order' => [
            'Requests.id' => 'desc'
        ]
    ];
    public  function initialize()
    {
        parent::initialize(); // TODO: Change the autogenerated stub

    }


    public function index()
    {
        $this->showRequest();
    }
    public function reload(){
        $this->reload();
    }
    private function showRequest(){
        $roles = TableRegistry::get('Categories');
        $listCate = $roles->find('list', [
            'keyField' => 'id',
            'valueField' => 'name',
            'conditions' => ''
        ]);
        if($this->user->role[0]->name ==='staff') {
            $conditions = ['group'=>['Requests.id Having Requests.user_id = '.$this->user->id.''],'conditions' => ['OR'=> ['Requests.status ' => 1]]];
        }elseif ($this->user->role[0]->name ==='top'){
            $conditions = ['group'=>['Requests.id Having manager_status = 1 or Requests.user_id = '.$this->user->id.' OR Requests.is_report = 1'],'conditions' => ['OR'=> ['Requests.status ' => 1]]];
        }elseif ($this->user->role[0]->name ==='manager'){
            $conditions = ['group'=>
                ['Requests.id Having (department_id = 2 and role_name ="staff" or Requests.user_id = '.$this->user->id.')
            or ( department_id <> 2  and sub_manager_status = 1 or Requests.user_id = '.$this->user->id.' )'],'conditions' => ['OR'=> ['Requests.status ' => 1]]];
        }
        elseif ($this->user->role[0]->name ==='sub-manager'){
            $conditions = ['group'=>['Requests.id Having  department_id <> 2 and role_name =\'staff\' and department_id = '.$this->user->dep_id.' or Requests.user_id = '.$this->user->id.' '],'conditions' => ['OR'=> ['Requests.status ' => 1]]];
        }else{
            $conditions = [];
        }
        $requests = $this->paginate($this->Requests,$conditions);
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
            $this->request->data['txtPaymentDate'] = Time::parse($this->request->data['txtPaymentDate']);
            $request = $this->Requests->patchEntity($request, $this->request->data);
            if ($this->Requests->save($request)) {
                $this->Flash->success(__('request_success'));
//                $this->addActivities(['req_id'=> $request->id, 'type' => 'add' , 'contents' =>  __('new_post') . ' ' . __('request') ]);
                return $this->redirect(['action' => 'add']);
            } else {
                $this->Flash->error(__('request_error'));
            }
        }
        $this->set(compact('request'));
        $this->set(compact('listCate'));
        $this->set('_serialize', ['request']);
        $this->set('_serialize', ['listCate']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function addOrEdit()
    {
        if($this->request->is('ajax') && $this->request->is('post')){

            $this->viewBuilder()->className('AdminTheme.Ajax');

            //Check if image has been uploaded
            if (!empty($this->request->data['fileAttach']['name'])) {
                $file = $this->request->data['fileAttach'];

                $ext = substr(strtolower(strrchr($file['name'], '.')), 1);
                $arr_ext = array('jpg', 'jpeg', 'gif','png');
//                    if (in_array($ext, $arr_ext)) {
                if (true) {
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
            $this->request->data['txtPaymentDate'] = Time::parse($this->request->data['txtPaymentDate']);
            // If the request_id is empty, add new request
            if(empty($this->request->data['request_id']))
            {
                $request = $this->Requests->newEntity();
            }else{
                $request = $this->Requests->get($this->request->data['request_id']);
                if(!count($request)){
                    throw new NotFoundException();
                }
            }
            $request = $this->Requests->patchEntity($request, $this->request->data);
            $request = $this->Requests->save($request);
            if($request){
                $this->pushNotification($request, empty($this->request->data['request_id']) ? 'add' : 'edit');
                $requestDetail = $this->Requests->find('requestList')->where(['Requests.id'=>$request->id])->groupBy('Requests.id')->first();
                $result  = ['params'=>(count($requestDetail[0])) ? $requestDetail[0] : '' , 'status' => 'Success' , 'response'=> __('request_success')];
            }else{
                $result  = ['params'=>$request , 'status' => 'Error' , 'response'=> __('request_error')];
            }
            $this->set(compact('result'));
            $this->set('_serialize', ['result']);
        }
    }


    public function addRequest()
    {
        if($this->request->is('ajax')){
            $this->viewBuilder()->className('AdminTheme.Ajax');
            $request = $this->Requests->newEntity();
            $result = [];
            if ($this->request->is('post')) {
                //Check if image has been uploaded
                if (!empty($this->request->data['fileAttach']['name'])) {
                    $file = $this->request->data['fileAttach'];

                    $ext = substr(strtolower(strrchr($file['name'], '.')), 1);
                    $arr_ext = array('jpg', 'jpeg', 'gif','png');
//                    if (in_array($ext, $arr_ext)) {
                    if (true) {
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
                $this->request->data['txtPaymentDate'] = Time::parse($this->request->data['txtPaymentDate']);
                $request = $this->Requests->patchEntity($request, $this->request->data);
                $request = $this->Requests->save($request);
                if ($request) {
                    $this->pushNotification($request,'add');
                    $requestDetail = $this->Requests->find('requestList')->where(['Requests.id'=>$request->id])->groupBy('Requests.id')->first();
                    $result  = ['params'=>(count($requestDetail[0])) ? $requestDetail[0] : '' , 'status' => 'Success' , 'response'=> __('request_success')];
                } else {
                    $result  = ['params'=>$request , 'status' => 'Error' , 'response'=> __('request_error')];
                }
            }
            $this->set(compact('result'));
            $this->set('_serialize', ['result']);
        }
    }
    private function pushNotification($request,$mode, $is_approve = true ,$cmt = null){
        if($mode === 'add'){
            if(isset($this->user->role[0]->name) && $this->user->role[0]->name === 'staff'){
                $this->Notification->notify([
                    'recipientLists' => ($this->user->dep->name === 'Headquarter') ? ['manager'] : ['sub-manager'],
                    'template' => ['notifierRequest'],
                    'is_approve' => $is_approve,
                    'message' => [
                        'username' => $this->user->profile->first_name . ' ' .$this->user->profile->last_name,
                        'title' => $request->title,
                        'category' => 'Request',
                        'link' => Router::url(array('controller'=>'Requests', 'action'=>'preview', $request->id),true)
                    ]
                ]);
            }
            else if(isset($this->user->role[0]->name) && $this->user->role[0]->name === 'sub-manager'){
                $this->Notification->notify([
                    'recipientLists' => ['manager'],
                    'template' => ['notifierRequest'],
                    'is_approve' => $is_approve,
                    'message' => [
                        'username' => $this->user->profile->first_name . ' ' .$this->user->profile->last_name,
                        'title' => $request->title,
                        'category' => 'Request',
                        'link' => Router::url(array('controller'=>'Requests', 'action'=>'preview',  $request->id),true)
                    ]
                ]);
            }else if(isset($this->user->role[0]->name) && $this->user->role[0]->name === 'manager'){
                $this->Notification->notify([
                    'recipientLists' => ['top'] ,
                    'template' => ['notifierRequest'],
                    'is_approve' => $is_approve,
                    'message' => [
                        'username' => $this->user->profile->first_name . ' ' .$this->user->profile->last_name,
                        'title' => $request->title,
                        'category' => 'Request',
                        'link' => Router::url(array('controller'=>'Requests', 'action'=>'preview', $request->id),true)
                    ]
                ]);
            }else{
                //nothing
            }
            $this->addActivities(['req_id'=> $request->id, 'type' => 'add' , 'contents' =>  __('new_post') . ' ' . __('request') ]);
        }
        elseif($mode === 'return'){
            $this->Notification->notify([
                'recipientLists' =>  ['top'],
                'template' => ['notifierRequest'],
                'is_approve' => $is_approve,
                'message' => [
                    'username' => $this->user->profile->first_name . ' ' .$this->user->profile->last_name,
                    'title' => $request->title,
                    'category' => 'Request',
                    'link' => Router::url(array('controller'=>'Requests', 'action'=>'preview', $request->id),true)
                ]
            ]);
        }
        elseif($mode === 'changeStatus'){
            $topInfo = $this->Notification->getRecipientList('top');
            $managerInfo = $this->Notification->getRecipientList('manager');
            if(count($topInfo)){
                $top_name = (empty($topInfo[0]->first_name)) ? $topInfo[0]->username : $topInfo[0]->first_name . $topInfo[0]->last_name;
            }else{
                $top_name = '';
            }
            if(count($managerInfo)){
                $manager_name = (empty($managerInfo[0]->first_name)) ? $managerInfo[0]->username : $managerInfo[0]->first_name . $managerInfo[0]->last_name;
            }else{
                $manager_name = '';
            }
            if($this->user->dep->name === 'Headquarter'){
                $recipientLists = ['top','manager'];
                $sub_manager_name = '';
            }else{
                $recipientLists = ['top','manager','sub-manager'];
                $subManagerInfo = $this->Notification->getRecipientList('sub-manager');
                if(count($subManagerInfo)){
                    $sub_manager_name = (empty($subManagerInfo[0]->first_name)) ? $subManagerInfo[0]->username : $subManagerInfo[0]->first_name . $subManagerInfo[0]->last_name;
                }else{
                    $sub_manager_name = '';
                }
            }
           if(isset($this->user->role[0]->name) && $this->user->role[0]->name === 'sub-manager'){
                // notify for user
                $this->Notification->notify([
                    'users' => [$request->user_id],
                    'recipientLists' => ['manager'],
                    'template' => ['notifierBySubManager'],
                    'is_approve' => $is_approve,
                    'message' => [
                        'subManagerName' => $sub_manager_name,
                        'username' => isset($request->profile->first_name) ? $request->profile->first_name . ' ' . $request->profile->last_name : $request->user->username,
                        'title' => $request->title,
                        'category' => 'Request',
                        'link' => Router::url(array('controller'=>'Requests', 'action'=>'preview',  $request->id),true)
                    ]
                ]);
            }else if(isset($this->user->role[0]->name) && $this->user->role[0]->name === 'manager'){
                // notify for user and sub-manager
                $this->Notification->notify([
                    'users' => [$request->user_id],
                    'recipientLists' => (in_array("sub-manager", $recipientLists)) ? ['top','sub-manager'] : ['top'],
                    'template' => ['notifierByManager'],
                    'is_approve' => $is_approve,
                    'message' => [
                        'managerName' => $manager_name,
                        'subManagerName' =>$sub_manager_name,
                        'username' => isset($request->profile->first_name) ? $request->profile->first_name . ' ' . $request->profile->last_name : $request->user->username,
                        'title' => $request->title,
                        'category' => 'Request',
                        'link' => Router::url(array('controller'=>'Requests', 'action'=>'preview',  $request->id),true)
                    ]
                ]);
            }else if(isset($this->user->role[0]->name) && $this->user->role[0]->name === 'top'){
                // notify for user and sub-manager and manager
                $this->Notification->notify([
                    'users' => [$request->user_id],
                    'recipientLists' => (in_array("sub-manager", $recipientLists)) ? ['manager','sub-manager'] : ['manager'],
                    'template' => ['notifierByTop'],
                    'is_approve' => $is_approve,
                    'message' => [
                        'topName' => $top_name,
                        'managerName' => $manager_name,
                        'subManagerName' =>$sub_manager_name,
                        'username' => isset($request->profile->first_name) ? $request->profile->first_name . ' ' . $request->profile->last_name : $request->user->username,
                        'title' => $request->title,
                        'category' => 'Request',
                        'link' => Router::url(array('controller'=>'Requests', 'action'=>'preview', $request->id),true)
                    ]
                ]);
            }
            else{
                //nothing
            }
            $this->addActivities(['req_id'=> $request->id, 'type' => 'status' , 'contents' => ( (($is_approve) ? __('approve_post') : __('rejected_post') ). ' ' . __('request')) . ' with comment : "'. $cmt . '"' ]);
        }
    }
    public function changeStatus(){
        $this->request->allowMethod('ajax');
        $id = $this->request->data['request_id'];
        $mod = $this->request->data['mod'];
        $cmt = $this->request->data['txtComment'];
        if (!$id || !$mod) {
            throw new NotFoundException();
        }
        if($mod === 'app' || $mod === 'rej'){
            $request = $this->Requests->find()->where(['Requests.id' => $id])
                ->contain(['Profiles', 'Users'])->first();
            if (!count($request)) {
                throw new NotFoundException();
            }
            $approval = TableRegistry::get('Approvals');
            $approvalInfo = $approval->find()->where(['user_id'=>$this->user->id,'req_id'=>$id])->first();

            $request->status = 1;
            if(!count($approvalInfo)){
                $approvalE = $approval->newEntity();
                $approvalE->user_id = $this->user->id;
                $approvalE->req_id = $id;
                $approvalE->role_id = $this->user->role[0]->id;
                $approvalE->status = ($mod === 'app' ) ? 'approved' : 'rejected' ;
                $approval->save($approvalE);
                //add push noti
                $this->pushNotification($request,'changeStatus',$mod === 'app' ,$cmt );

            }else{
                throw new NotFoundException();
            }
            if($this->Requests->save($request)){
                $result = $this->responseData(true,['id'=>$request->id]);
            }else{
                throw new NotFoundException();
            }

        }elseif($mod === 'return'){
            $request = $this->Requests->find()->where(['Requests.id' => $id])
                ->contain(['Profiles', 'Users'])->first();
            $message = $this->request->query('message');
            if (!count($request)) {
                throw new NotFoundException();
            }
            $request->is_report = 1;
            if($this->Requests->save($request)){
                $this->pushNotification($request,'report' );
                $result = $this->responseData(true,['id'=>$request->id]);
            }else{
                throw new NotFoundException();
            }
        }
        elseif($mod === 'multiDel' || $mod === 'multiApp'|| $mod === 'multiRej'){
            if($mod === 'multiApp'){
                throw new NotFoundException();
            }elseif ($mod === 'multiRej'){
                throw new NotFoundException();
            }else{
                throw new NotFoundException();
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
                $this->Flash->success(__('request_success'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('request_error'));
            }
        }
        $this->set(compact('base'));
        $this->set('_serialize', ['base']);
    }
    public function preview($id = null){
        $requestDetail = $this->Requests->find('requestList')->where(['Requests.id'=>$id])->groupBy('Requests.id')->first();
        if(!count($requestDetail[0]))
        {
            throw new NotFoundException;
        }
        $result = $requestDetail[0];
        $tblApproval = TableRegistry::get('Approvals');
        $approvals =  $tblApproval->find()->where(['req_id'=>$id])->contain(['Roles','Profiles','Users'])->all()->toArray();
        $result['app_status'] = 0;
        if(count($approvals)){
            foreach($approvals as $app){
                if($this->user->role[0]->name === $app->role->name){
                    $result['app_status'] = ($app->status === 'approved') ? 1 : 2 ;
                }
                if($app->role->name === 'manager'){

                    $result['manager_name'] = (isset($app->profile->first_name)) ? $app->profile->first_name.' '. $app->profile->last_name :  $app->user->username ;
                    $result['manager_status'] = ($app->status === 'approved') ? 1 : 2 ;
                }elseif ($app->role->name === 'top'){
                    $result['top_name'] = (isset($app->profile->first_name)) ? $app->profile->first_name.' '. $app->profile->last_name :  $app->user->username;
                    $result['app_status'] = $result['top_status'] = ($app->status === 'approved') ? 1 : 2 ;
                }else{
                    $result['sub_name'] = (isset($app->profile->first_name)) ? $app->profile->first_name.' '. $app->profile->last_name :  $app->user->username;
                    $result['sub_manager_status'] = ($app->status === 'approved') ? 1 : 2 ;
                }
            }
        }
        $this->set('requestDetail',$result);
        $this->set('_serialize', ['requestDetail']);
    }

    private function addActivities($data){
        if(is_array($data) && count($data)){
            $tblComment = TableRegistry::get('Comments');
            $commentE = $tblComment->newEntity();
            $commentE->from_user_id = $this->user->id;
            $commentE->req_id = $data['req_id'];
            $commentE->role_id = $this->user->role[0]->id;
            $commentE->contents = $this->user->profile->first_name .' '. $this->user->profile->last_name .' ' . $data['contents'];
            $commentE->type = $data['type'];
            $tblComment->save($commentE);
            return true;
        }
        return false;
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
            $this->Flash->success(__('request_del_success'));
        } else {
            $this->Flash->error(__('request_del_error'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
