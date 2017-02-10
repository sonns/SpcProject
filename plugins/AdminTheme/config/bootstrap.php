<?php
use Cake\Core\Configure;
use Cake\Core\Exception\MissingPluginException;
use Cake\Core\Plugin;
use Cake\Routing\Router;


Configure::write('Admin', [
    'debug'=>true,
    'title' => 'RINGISHO',
    'logo' => [
        'mini' => '<b>A</b>LT',
        'large' => '<b>Admin</b>'
    ],
    'login' => [
        'show_remember' => true,
        'show_register' => true,
        'show_social' => true
    ]
]

);
Configure::write('language',[
    'en_US' => 'English (US)',
    'jp_JP' => 'Japan (JP)',
    'vi_VN' => 'Vietnamese (VN)'
]);
Router::extensions(['json']);