<?php
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;

Router::plugin(
    'Notification',
    ['path' => '/notification'],
    function (RouteBuilder $routes) {
        $routes->fallbacks('DashedRoute');
    }
);
