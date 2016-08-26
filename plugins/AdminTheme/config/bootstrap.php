<?php
use Cake\Core\Configure;
use Cake\Core\Exception\MissingPluginException;
use Cake\Core\Plugin;

Configure::write('Admin', [
    'debug'=>true,
    'title' => 'SPCProject',
    'logo' => [
        'mini' => '<b>A</b>LT',
        'large' => '<b>Admin</b>LTE'
    ],
    'login' => [
        'show_remember' => true,
        'show_register' => true,
        'show_social' => true
    ]
]);
