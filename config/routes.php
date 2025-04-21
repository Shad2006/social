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
        '/edit/{id}',
        ['controller' => 'Users', 'action' => 'edit'],
        ['id' => '\d+', 'pass' => ['id'], 'methods' => ['GET', 'POST', 'PUT']]
    );

    // Главная страница
    $routes->connect('/', ['controller' => 'Pages', 'action' => 'home']);
    
    // Оставшиеся маршруты
    $routes->fallbacks(DashedRoute::class);
});
