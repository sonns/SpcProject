<?php
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;

Router::plugin(
    'AdminTheme',
    ['path' => '/AdminTheme'],
    function (RouteBuilder $routes) {
        $routes->fallbacks('DashedRoute');
    }
);
