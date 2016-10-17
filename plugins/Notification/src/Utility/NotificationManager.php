<?php
namespace Notification\Utility;

use Aura\Intl\Exception;
use Cake\Core\Configure;
use Cake\Core\Plugin;
use Cake\ORM\TableRegistry;
use Cake\Utility\Text;
use ElephantIO\Client as Elephant;
use ElephantIO\Engine\SocketIO\Version1X;
use ElephantIO\Exception\ServerConnectionFailureException;

class NotificationManager {

    protected static $_generalManager = null;
    protected static $_pushSocket = null;
    /**
     * instance
     *
     * The singleton class uses the instance() method to return the instance of the NotificationManager.
     *
     * @param null $manager Possible different manager. (Helpfull for testing).
     * @return NotificationManager
     */
    public static function instance($manager = null,$host =  null)
    {
        if ($manager instanceof NotificationManager) {
            static::$_generalManager = $manager;
        }
        if (empty(static::$_generalManager)) {
            static::$_generalManager = new NotificationManager();
        }
        static::$_pushSocket =  new Elephant(new Version1X(empty($host) ? 'http://localhost:5000' : $host));
        return static::$_generalManager;
    }
    /**
     * notify
     *
     * Sends notifications to specific users.
     * The first parameter `$data` is an array with multiple options.
     *
     * ### Options
     * - `users` - An array or int with id's of users who will receive a notification.
     * - `roles` - An array or int with id's of roles which all users ill receive a notification.
     * - `template` - The template wich will be used.
     * - `message` - The variables used in the template.
     *
     * ### Example
     * ```
     *  NotificationManager::instance()->notify([
     *      'users' => 1,
     *      'template' => 'newOrder',
     *      'message' => [
     *          'receiver' => $receiver->name
     *          'total' => $order->total
     *      ],
     *  ]);
     * ```
     *
     * @param array $data Data with options.
     * @return string The tracking_id to follow the notification.
     */
    public function notify($data)
    {
        $model = TableRegistry::get('Notification.Notifications');
        $_data = [
            'users' => [],
            'recipientLists' => [],
            'template' => ['default'],
            'message' => [],
            'tracking_id' => $this->getTrackingId()
        ];
        $data = array_merge($_data, $data);
        //notifierByManager and notifierBySubManager
        if((bool)$data['is_approve']){
            foreach ((array)$data['recipientLists'] as $recipientList) {
                $list = (array)$this->getRecipientList($recipientList);
                $data['users'] = array_merge($data['users'], $list);
                if($data['template'][0] === 'notifierBySubManager'){
                    //notify for staff and manager
                    $data['template'][$list[0]] = 'notifierForManager';
                    $data['template'][$_data['users'][0]] = 'notifierBySubManager';
                }elseif($data['template'][0] === 'notifierByManager'){
                    //check request in head company
                    if($recipientList === 'top'){
                        $data['template'][$list[0]] = (count($data['recipientLists']) === 1) ? 'notifierForTopHead' : 'notifierForTop';
                    }else{
                        $data['template'][$list[0]] = 'notifierByManager';
                        $data['template'][$_data['users'][0]] = 'notifierByManager';
                    }
                }
            }
        }else{
            if($data['template'][0] === 'notifierBySubManager'){
                $data['template'][0] = 'rejectBySubManager';
            }elseif($data['template'][0] === 'notifierByManager'){
                $data['template'][0] = 'rejectByManager';
            }elseif($data['template'][0] === 'notifierByTop'){
                $data['template'][0] = 'rejectByTop';
            }
        }
        $data['users'] = array_unique($data['users']);
        foreach ((array)$data['users'] as $user) {
            $entity = $model->newEntity();
            $entity->set('template', isset($data['template'][$user]) ? $data['template'][$user] : $data['template'][0]);
            $entity->set('tracking_id', $data['tracking_id']);
            $entity->set('message', $data['message']);
            $entity->set('state', 1);
            $entity->set('user_id', $user);
            $model->save($entity);
        }
        self::pushSocket($data['tracking_id'],$data['users']);
        return $data['tracking_id'];
    }
    /**
     * addRecipientList
     *
     * Method to add a new recipient list.
     * Recipient lists are used to create presets of users to write notifications to.
     *
     * ### Example
     * ```
     *  $notificationManager->addRecipientList('administrators', [1,2,3,4]);
     * ```
     *
     * The data will be stored in Cake's Configure: `Notification.recipientLists.{name}`
     *
     * @param string $name Name of the list.
     * @param array $userIds Array with id's of users.
     * @return void
     */
    public function addRecipientList($name, $userIds)
    {
        Configure::write('Notification.recipientLists.' . $name, $userIds);
    }
    /**
     * getRecipientList
     *
     * Returns a requested recipient list from Cake's Configure.
     * Will return `null` if the list doesn't exist.
     *
     * @param string $name The name of the list.
     * @return array|null
     */
    public function getRecipientList($name)
    {
        $recipientLists = (array) Configure::read('Notification.recipientLists.' . $name);
        return array_map(create_function('$query', 'return $query->id;'), $recipientLists);
    }
    /**
     * addTemplate
     *
     * Adds a template to the storage.
     *
     * ### Variables
     * Titles and bodies can contain variables. For that the
     * `Cake\Utilities\Text::insert($string, $data)` is used:
     * http://book.cakephp.org/3.0/en/core-libraries/text.html#Cake\Utility\Text::insert
     *
     * ### Options
     * - `title` - The title.
     * - `body` - The body.
     *
     * ### Example
     *
     * $this->Notification->addTemplate('newUser', [
     *  'title' => 'New User: :name',
     *  'body' => 'The user :email has been registered'
     * ]);
     *
     * This code contains the variables `title` and `body`.
     *
     * @param string $name Unique name.
     * @param array $options Options.
     * @return void
     */
    public function addTemplate($name, $options = [])
    {
        $_options = [
            'title' => 'Notification',
            'body' => '',
        ];
        $options = array_merge($_options, $options);
        Configure::write('Notification.templates.' . $name, $options);
    }
    /**
     * getTemplate
     *
     * Returns the requested template.
     * If the template or type does not exists, `false` will be returned.
     *
     * @param string $name Name of the template.
     * @param string|null $type The type like `title` or `body`. Leave empty to get the whole template.
     * @return array|string|bool
     */
    public function getTemplate($name, $type = null)
    {
        $templates = Configure::read('Notification.templates');
        if (array_key_exists($name, $templates)) {
            if ($type == 'title') {
                return $templates[$name]['title'];
            }
            if ($type == 'body') {
                return $templates[$name]['body'];
            }
            return $templates[$name];
        }
        return false;
    }
    /**
     * getTrackingId
     *
     * Generates a tracking id for a notification.
     *
     * @return string
     */
    public function getTrackingId()
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $trackingId = '';
        for ($i = 0; $i < 10; $i++) {
            $trackingId .= $characters[rand(0, $charactersLength - 1)];
        }
        return $trackingId;
    }
    private function pushSocket($data,$id){
        try {
            self::$_pushSocket->initialize();
            self::$_pushSocket->emit('cake_event',[ 'arg' => $data , 'id' => $id ]);
            self::$_pushSocket->close();
        } catch (Exception $e) {
            //Write log
            return false;
        }
    }
}
