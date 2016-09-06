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
    $routes->extensions(['json', 'xml','html']);
    /**
     * Here, we are connecting '/' (base path) to a controller called 'Pages',
     * its action called 'display', and we pass a param to select the view file
     * to use (in this case, src/Template/Pages/home.ctp)...
     */
//    $routes->connect('/', ['controller' => 'Pages', 'action' => 'display', 'home']);
    $routes->connect('/login', ['controller' => 'Home', 'action' => 'login', 'login']);
    $routes->connect('/logout', ['controller' => 'Home', 'action' => 'logout', 'logout']);
    $routes->connect('/', ['controller' => 'Home', 'action' => 'index','home']);
    $routes->connect('/register', ['controller' => 'Home', 'action' => 'register']);
    $routes->connect('/user/list', ['controller' => 'Users', 'action' => 'index','manage_user']);
    $routes->connect('/user/add', ['controller' => 'Users', 'action' => 'add','add_user']);
    $routes->connect('/user/edit', ['controller' => 'Users', 'action' => 'edit','edit_user']);
    $routes->connect('/user/delete', ['controller' => 'Users', 'action' => 'delete','del_user']);
    $routes->connect('/user/profile', ['controller' => 'Users', 'action' => 'myProfile','profile']);
//Department router
    $routes->connect('/department/list', ['controller' => 'Departments', 'action' => 'index','manage_dep']);
    $routes->connect('/department/add', ['controller' => 'Departments', 'action' => 'add','add_dep']);
    $routes->connect('/department/edit', ['controller' => 'Departments', 'action' => 'edit','edit_dep']);
    $routes->connect('/department/delete', ['controller' => 'Departments', 'action' => 'delete','del_dep']);

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

/**
 * Load all plugin routes.  See the Plugin documentation on
 * how to customize the loading of plugin routes.
 */


Plugin::routes();
