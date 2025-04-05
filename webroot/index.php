<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <div class="header-logo">
            <img src="https://github.com/favicon.ico">
        </div>
        <div class="header-about">
            <a href="#">About us</a>
        </div>
    </header>
    <div class="center">
        <div class="center-authorisation">
            <form action="login.php" method="post">
                <p>Login:</p>
                <input class="center-authorisation-fields" type="email" placeholder="adress@domain.zone">
                <p>password: <a class="center-authorisation-links" href="#">Visible password</a></p>
                <input class="center-authorisation-fields" type="password" placeholder="*****">
                <p><a class="center-authorisation-links" href="#">Forgot your password?</a>
                <a href="#">Sign in</a></p>
                <input class="center-authorisation-button" type="submit">
            </form>
        </div>
    </div>
</body>
</html>
<?php
/**
 * The Front Controller for handling every request
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.2.9
 * @license       MIT License (https://opensource.org/licenses/mit-license.php)
 */
/*
// Check platform requirements
require dirname(__DIR__) . '/config/requirements.php';

// For built-in server
if (PHP_SAPI === 'cli-server') {
    $_SERVER['PHP_SELF'] = '/' . basename(__FILE__);

    $url = parse_url(urldecode($_SERVER['REQUEST_URI']));
    $file = __DIR__ . $url['path'];
    if (strpos($url['path'], '..') === false && strpos($url['path'], '.') !== false && is_file($file)) {
        return false;
    }
}
require dirname(__DIR__) . '/vendor/autoload.php';

use App\Application;
use Cake\Http\Server;

// Bind your application to the server.
$server = new Server(new Application(dirname(__DIR__) . '/config'));

// Run the request/response through the application and emit the response.
$server->emit($server->run());
