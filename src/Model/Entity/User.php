<?php
namespace App\Model\Entity;

use App\Utility\FunctionCommon;
use Cake\Core\Configure;
use Cake\ORM\Entity;
use Cake\Utility\Security;

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
class User extends Entity
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
//    protected $_virtual = ['alias_name'];
//    protected $_hidden = ['password'];

    protected function _setPassword($password)
    {
//        print_r(fopen((new FunctionCommon)->cipher_encrypt($password,MCRYPT_KEY),256)) ;exit;
        return base64_encode(Security::encrypt($password, Configure::read("Security.password")));
    }


//    protected function _getAliasName()
//    {
//        return $this->_properties['first_name'] . '  ' . $this->_properties['last_name'];
//    }



}
