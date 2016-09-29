<?php
use Cake\Core\Configure;
Configure::write('Notification.templates.default', [
    'title' => ':title',
    'body' => ':body'
]);
Configure::write('Notification.templates.notification', [
    'title' => ':title',
    'body' => ':username has posted a new :category',
]);