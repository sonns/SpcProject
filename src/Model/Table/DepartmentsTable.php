<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TblMasterDepartments Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Logins
 *
 * @method \App\Model\Entity\DepartmentsTable get($primaryKey, $options = [])
 * @method \App\Model\Entity\DepartmentsTable newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\DepartmentsTable[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\DepartmentsTable|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\DepartmentsTable patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\DepartmentsTable[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\DepartmentsTable findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class DepartmentsTable extends Table
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

        $this->table('tbl_master_departments');
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
            ->notEmpty('dep_name', 'The Name field is required')
            ->notEmpty('dep_tel', 'The Tel field is required')
            ->notEmpty('dep_address', 'The address field is required');
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
}