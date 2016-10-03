<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

use Cake\Core\Plugin;
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;

/**
 * The default class to use for all routes
 *
 * The following route classes are supplied with CakePHP and are appropriate
 * to set as the default:
 *
 * - Route
 * - InflectedRoute
 * - DashedRoute
 *
 * If no call is made to `Router::defaultRouteClass()`, the class used is
 * `Route` (`Cake\Routing\Route\Route`)
 *
 * Note that `Route` does not do any inflections on URLs which will result in
 * inconsistently cased URLs when used with `:plugin`, `:controller` and
 * `:action` markers.
 *
 */
Router::defaultRouteClass(DashedRoute::class);
Router::scope('/', function (RouteBuilder $routes) {
    /**
     * Here, we are connecting '/' (base path) to a controller called 'Pages',
     * its action called 'display', and we pass a param to select the view file
     * to use (in this case, src/Template/Pages/home.ctp)...
     */
//    $routes->connect('/', ['controller' => 'Pages', 'action' => 'display', 'home']);
    $routes->connect('/login', ['controller' => 'AuthMaster', 'action' => 'login', 'login']);
    $routes->connect('/changeLanguage', ['controller' => 'AuthMaster', 'action' => 'changeLanguage']);
    $routes->connect('/logout', ['controller' => 'AuthMaster', 'action' => 'logout', 'logout']);
    $routes->connect('/403', ['controller' => 'AuthMaster', 'action' => 'accessDenied', 'access_denied']);
    $routes->connect('/404', ['controller' => 'AuthMaster', 'action' => 'pageNotFound', 'page_not_found']);
    $routes->connect('/', ['controller' => 'Requests', 'action' => 'index','home']);



    /**
     * ...and connect the rest of 'Pages' controller's URLs.
     */
    $routes->connect('/pages/*', ['controller' => 'Pages', 'action' => 'display']);

    /**
     * Connect catchall routes for all controllers.
     *
     * Using the argument `DashedRoute`, the `fallbacks` method is a shortcut for
     *    `$routes->connect('/:controller', ['action' => 'index'], ['routeClass' => 'DashedRoute']);`
     *    `$routes->connect('/:controller/:action/*', [], ['routeClass' => 'DashedRoute']);`
     *
     * Any route class can be used with this method, such as:
     * - DashedRoute
     * - InflectedRoute
     * - Route
     * - Or your own route class
     *
     * You can remove these routes once you've connected the
     * routes you want in your application.
     */
    $routes->fallbacks('DashedRoute');
});
//Department router
Router::scope('/department', function (RouteBuilder $routes) {
    $routes->connect('/', ['controller' => 'Departments', 'action' => 'index'], ['routeClass' => 'DashedRoute']);
    $routes->connect('/:action/*', ['controller' => 'Departments'], ['routeClass' => 'DashedRoute']);
    $routes->fallbacks('DashedRoute');
});
//User router
Router::scope('/user', function (RouteBuilder $routes) {
    $routes->connect('/', ['controller' => 'Users', 'action' => 'index'], ['routeClass' => 'DashedRoute']);
    $routes->connect('/:action/*', ['controller' => 'Users'], ['routeClass' => 'DashedRoute']);
    $routes->fallbacks('DashedRoute');
});
//Role router
Router::scope('/configuration', function (RouteBuilder $routes) {
    $routes->connect('/', ['controller' => 'Roles', 'action' => 'index'], ['routeClass' => 'DashedRoute']);
    $routes->connect('/:action/*', ['controller' => 'Roles'], ['routeClass' => 'DashedRoute']);
    $routes->fallbacks('DashedRoute');
});

//Requests router
Router::scope('/request', function (RouteBuilder $routes) {
    $routes->connect('/', ['controller' => 'Requests', 'action' => 'index'], ['routeClass' => 'DashedRoute']);
    $routes->connect('/:action/*', ['controller' => 'Requests'], ['routeClass' => 'DashedRoute']);
    $routes->fallbacks('DashedRoute');
});

//Requests router
Router::scope('/notification', function (RouteBuilder $routes) {
    $routes->connect('/', ['controller' => 'Notifications', 'action' => 'index'], ['routeClass' => 'DashedRoute']);
    $routes->connect('/:action/*', ['controller' => 'Notifications'], ['routeClass' => 'DashedRoute']);
    $routes->fallbacks('DashedRoute');
});

Plugin::routes();
