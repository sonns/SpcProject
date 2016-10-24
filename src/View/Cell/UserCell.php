<?php
namespace App\View\Cell;

use Cake\View\Cell;

/**
 * User cell
 */
class UserCell extends Cell
{

    /**
     * List of valid options that can be passed into this
     * cell's constructor.
     *
     * @var array
     */
    protected $_validCellOptions = [];

    /**
     * Default display method.
     *
     * @return void
     */
    public function display($user)
    {
        if(isset($user->dep_id)){
            $this->loadModel('Requests');
            $result= $this->Requests->find('all')->where(['Requests.dep_id'=>$user->dep_id])->count();
        }
        $this->set('requestCount',$result);
//        print_r($user);exit;
        $this->set('userInfo',$user);
    }
}
