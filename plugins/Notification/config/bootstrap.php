<?php
use Cake\Core\Configure;
Configure::write('Notification.templates.default', [
    'title' => ':title',
    'body' => ':body'
]);