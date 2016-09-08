<?php
namespace App\Controller;

/**
 * Roles Controller
 *
 * @property \App\Model\Table\RolesTable $Roles
 */
class RolesController extends AuthMasterController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->set('roles', $this->Roles->find('all'));
//        $roles = $this->Roles;
//        print_r($roles);exit;
//        $this->set(compact('roles'));
        $this->set('_serialize', ['roles']);
    }

    /**
     * View method
     *
     * @param string|null $id Role id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */

    public function view($id = null)
    {
//
//        $role = $this->Roles->get($id, [
//            'contain' => []
//        ]);
//
//        $this->set('role', $role);
//        $this->set('_serialize', ['role']);
    }
}
