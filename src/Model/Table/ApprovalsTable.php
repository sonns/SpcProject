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
class ApprovalsTable extends Table
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

        $this->table('tbl_master_approval');
        $this->displayField('id');
        $this->primaryKey('id');
        $this->addBehavior('Timestamp');
    }

    public function beforeMarshal(Event $event, ArrayObject $data, ArrayObject $options)
    {

    }
}
