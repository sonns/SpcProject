<?php
use Cake\Core\Configure;
Configure::write('Notification.Templates.Default', [
    'title' => ':title',
    'fromUser' => ':username',
    'body' => ':body',
    'link' => ':link'
]);
Configure::write('Notification.Templates.Request', [
    'title' => ':title',
    'fromUser' => ':username',
    'body' => ':username :message :category',
    'link' => ':link'
]);