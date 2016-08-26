<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TblMasterAccounts Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Logins
 *
 * @method \App\Model\Entity\AccountsTable get($primaryKey, $options = [])
 * @method \App\Model\Entity\AccountsTable newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\AccountsTable[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\AccountsTable|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\AccountsTable patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\AccountsTable[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\AccountsTable findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class AccountsTable extends Table
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

        $this->table('tbl_master_accounts');
        $this->displayField('id');
        $this->primaryKey('id');
        $this->addBehavior('Timestamp');

//        $this->belongsTo('Logins', [
//            'foreignKey' => 'login_id',
//            'joinType' => 'INNER'
//        ]);
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
            ->notEmpty('login_id', 'A username is required')
            ->notEmpty('login_pass', 'A password is required')
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
        $rules->add($rules->isUnique(['login_id']));
        return $rules;
    }
}
