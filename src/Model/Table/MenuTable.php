<?php
namespace App\Model\Table;

use ArrayObject;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Event\Event;

/**
 * TblMasterDepartments Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Logins
 *
 * @method \App\Model\Entity\RequestsTable get($primaryKey, $options = [])
 * @method \App\Model\Entity\RequestsTable newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\RequestsTable[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\RequestsTable|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\RequestsTable patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\RequestsTable[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\RequestsTable findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class RequestsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('tbl_master_requests');
        $this->displayField('id');
        $this->primaryKey('id');
        $this->addBehavior('Timestamp');
        $this->belongsTo('Users', [
            'className' => 'Users'
        ]);
        $this->belongsTo('Departments', [
            'className' => 'Departments',
            'foreignKey' => 'dep_id'
        ]);
        $this->belongsTo('Categories', [
            'className' => 'Categories',
            'foreignKey' => 'cate_id'
        ]);
//        $this->belongsTo('Users',[
//                'className'=>['Users'],
//                'propertyName'=>['alias_name']
//            ]
//        );

    }
    public function findOrWhere(Query $query, array $conditions){
        if(isset($conditions['OR']))
        {
             $query= $query->orWhere($conditions['OR']);
        }
        return $query->hydrate(true);
    }
    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        return $validator
            ->notEmpty('dep_name', 'The Name field is required')
            ->notEmpty('dep_address', 'The address field is required');
    }

    public function beforeMarshal(Event $event, ArrayObject $data, ArrayObject $options)
    {
        if (isset($data['sltCategory'])) {
            $data['cate_id'] = $data['sltCategory'];
        }
        if (isset($data['txtPrice'])) {
            $data['price'] = $data['txtPrice'];
        }
        if (isset($data['txtApproveDate'])) {
            $data['appr_date'] = $data['txtApproveDate'];
        }
        if (isset($data['txtTitle'])) {
            $data['title'] = $data['txtTitle'];
        }
        if (isset($data['txtDescription'])) {
            $data['description'] = $data['txtDescription'];
        }
        if (isset($data['txtReason'])) {
            $data['reason'] = $data['txtReason'];
        }
        if (isset($data['txtNote'])) {
            $data['note'] = $data['txtNote'];
        }
    }
}
