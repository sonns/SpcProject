<?php
/**
 *
 * Copyright (c) Son Nguyen
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Son Nguyen
 * @link          Project
 * @since         1.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace Notification\Model\Entity;
use Cake\Core\Configure;
use Cake\ORM\Entity;
use Cake\Utility\Text;
/**
 * Notification Entity.
 */
class Notification extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'template' => true,
        'message' => true,
        'tracking_id' => true,
        'user_id' => true,
        'state' => false,
        'user' => false,
    ];
    /**
     * Virtual fields
     *
     * @var array
     */
    protected $_virtual = ['title', 'body', 'unread', 'read'];
    /**
     * _getmessage
     *
     * Getter for the message-column.
     *
     * @param string $message Data.
     * @return mixed
     */
    protected function _getMessage($message)
    {
        $array = json_decode($message, true);
        if (is_object($array)) {
            return $array;
        }
        return $message;
    }
    /**
     * _setmessage
     *
     * Setter for the message-column
     *
     * @param array $message Data.
     * @return string
     */
    protected function _setMessage($message)
    {
        if (is_array($message)) {
            return json_encode($message);
        }
        return $message;
    }
    /**
     * _getTitle
     *
     * Getter for the title.
     * Data is used from the message-column.
     * The template is used from the configurations.
     *
     * @return string
     */
    protected function _getTitle()
    {
        $templates = Configure::read('Notifier.templates');
        if (array_key_exists($this->_properties['template'], $templates)) {
            $template = $templates[$this->_properties['template']];
            $message = json_decode($this->_properties['message'], true);
            return Text::insert($template['title'], $message);
        }
        return '';
    }
    /**
     * _getBody
     *
     * Getter for the body.
     * Data is used from the message-column.
     * The template is used from the configurations.
     *
     * @return string
     */
    protected function _getBody()
    {
        $templates = Configure::read('Notifier.templates');
        if (array_key_exists($this->_properties['template'], $templates)) {
            $template = $templates[$this->_properties['template']];
            $message = json_decode($this->_properties['message'], true);
            return Text::insert($template['body'], $message);
        }
        return '';
    }
    /**
     * _getUnread
     *
     * Boolean if the notification is read or not.
     *
     * @return bool
     */
    protected function _getUnread()
    {
        if ($this->_properties['state'] === 1) {
            return true;
        }
        return false;
    }
    /**
     * _getRead
     *
     * Boolean if the notification is read or not.
     *
     * @return bool
     */
    protected function _getRead()
    {
        if ($this->_properties['state'] === 0) {
            return true;
        }
        return false;
    }

}