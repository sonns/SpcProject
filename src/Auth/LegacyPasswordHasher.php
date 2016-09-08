<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         3.0.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Auth;

use App\Utility\FunctionCommon;
use Cake\Auth\AbstractPasswordHasher;

class LegacyPasswordHasher extends AbstractPasswordHasher
{

    public function hash($password)
    {
        return (new FunctionCommon())->cipher_encrypt($password,MCRYPT_KEY);
    }

    public function check($password, $hashedPassword)
    {
        return $this->hash($password) === fread($hashedPassword, 256);
    }
    public function needsRehash($password)
    {
        return password_needs_rehash(fread($password, 256), PASSWORD_DEFAULT);
    }
}