<?php
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;

Router::defaultRouteClass(DashedRoute::class);

Router::scope('/', function ($routes) {
    $routes->connect(
        '/login',
        ['controller' => 'Auth', 'action' => 'login'],
        ['_name' => 'login', 'methods' => ['GET', 'POST']]
    );

    $routes->connect(
        '/register',
        ['controller' => 'Auth', 'action' => 'register'],
        ['_name' => 'register', 'methods' => ['GET', 'POST']]
    );
    $routes->connect(
        '/profile/{id}',
        ['controller' => 'Users', 'action' => 'view'],
        ['id' => '\d+', 'pass' => ['id'], 'methods' => ['GET']]
    );
    $routes->connect(
        '/profile/:tag', 
        ['controller' => 'Users', 'action' => 'viewByTag'],
        ['pass' => ['tag'], 'tag' => '@.*'] 
    );
    $routes->connect('/home', ['controller' => 'Users', 'action' => 'home']);
    $routes->connect('/recovery', ['controller' => 'Auth', 'action' => 'recovery']);
    $routes->connect('/chat', ['controller' => 'Chat', 'action' => 'index']);
    $routes->connect('/chat/messagesto/*', ['controller' => 'Chat', 'action' => 'messageto']);
    $routes->connect(
        '/edit/{id}',
        ['controller' => 'Users', 'action' => 'edit'],
        ['id' => '\d+', 'pass' => ['id'], 'methods' => ['GET', 'POST', 'PUT']]
    );
    $routes->connect('/admin', ['controller' => 'Admin', 'action' => 'admin']);
    
    $routes->connect('/', ['controller' => 'Pages', 'action' => 'home']);
    $routes->connect('/chat', ['controller' => 'Chat', 'action' => 'index']);
    
    
    $routes->fallbacks(DashedRoute::class);
});
