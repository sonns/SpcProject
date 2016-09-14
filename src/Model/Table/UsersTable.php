<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TblMasterUsers Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Logins
 *
 * @method \App\Model\Entity\UsersTable get($primaryKey, $options = [])
 * @method \App\Model\Entity\UsersTable newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\UsersTable[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\UsersTable|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\UsersTable patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\UsersTable[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\UsersTable findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class UsersTable extends Table
{
    public  $hasMany = array( 'Requests' => array( 'className' => 'Requests' ) );
    public $hasOne = array(
        'Profiles' => array(
            'className' => 'Profiles',
//            'conditions' => array('Profiles.published' => '1'),
            'dependent' => true
        )

    );

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('tbl_master_users');
        $this->displayField('id');
        $this->primaryKey('id');
        $this->addBehavior('Timestamp');
        $this->belongsTo('Roles');
        $this->belongsToMany('role', [
            'through' => 'RoleUsers',
            'className' => 'Roles',
            'foreignKey' => 'user_id',
            'targetForeignKey' => 'role_id'
        ]);
//        $this->belongsTo('Logins', [
//            'foreignKey' => 'login_id',
//            'joinType' => 'INNER'
//        ]);
    }
    public function findExistsOr(Query $query, array $conditions)
    {

        return (bool)count(
            $query->select(['existing' => 1])
                ->orWhere($conditions)
                ->limit(1)
                ->hydrate(false)
                ->toArray()
        );

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
            ->notEmpty('username', 'A username is required')
            ->notEmpty('password', 'A password is required')
            ->notEmpty('role', 'A role is required')
            ->add('role', 'inList', [
                'rule' => ['inList', ['admin', 'author']],
                'message' => 'Please enter a valid role'
            ]);
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->isUnique(['email','username']));
        return $rules;
    }
    public function beforeMarshal(Event $event, ArrayObject $data, ArrayObject $options)
    {
//        Define data to mapping entity
        if (isset($data['dep_name'])) {
            $data['name'] = $data['dep_name'];
        }
        if (isset($data['dep_tel'])) {
            $data['tel'] = $data['dep_tel'];
        }
        if (isset($data['dep_address'])) {
            $data['address'] = $data['dep_address'];
        }
    }
}
