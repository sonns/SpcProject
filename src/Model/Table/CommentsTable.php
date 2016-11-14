<?php
namespace App\Model\Table;

use ArrayObject;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Event\Event;

/**
 * TblMasterComments Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Logins
 *
 * @method \App\Model\Entity\CommentsTable get($primaryKey, $options = [])
 * @method \App\Model\Entity\CommentsTable newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\CommentsTable[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CommentsTable|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CommentsTable patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CommentsTable[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\CommentsTable findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CommentsTable extends Table
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

        $this->table('tbl_master_comments');
        $this->displayField('id');
        $this->primaryKey('id');
        $this->addBehavior('Timestamp');
        $this->belongsTo('Users', [
            'className' => 'Users',
            'foreignKey' => 'from_user_id'
        ]);
        $this->belongsTo('Profiles', [
            'className' => 'Profiles',
            'foreignKey' => 'from_user_id'
        ]);
    }

    public function beforeMarshal(Event $event, ArrayObject $data, ArrayObject $options)
    {
        if (isset($data['txtComment'])) {
            $data['contents'] = $data['txtComment'];
        }
        if (isset($data['request_id'])) {
            $data['req_id'] = $data['request_id'];
        }
        if (isset($data['mod'])) {
            unset($data['mod']);
        }
    }
}
