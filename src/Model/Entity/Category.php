<?php
namespace App\Model\Entity;

use App\Utility\FunctionCommon;
use Cake\ORM\Entity;

/**
 * TblMasterUser Entity
 *
 * @property int $id
 * @property string $login_id
 * @property string|resource $login_pass
 * @property int $del_flg
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \App\Model\Entity\Login $login
 */
class Category extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];




}
