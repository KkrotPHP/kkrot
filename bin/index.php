<?php

use Kkrot\Config\Impl\Config;
use Kkrot\Di\Impl\Container;
use Kkrot\Server\ServerFactory;

! defined('BASE_PATH') && define('BASE_PATH', dirname(__DIR__, 1));

require BASE_PATH . '/vendor/autoload.php';

$serverConfig = require BASE_PATH . '/config/server.php';

$container = new Container();
$serverFactory = new ServerFactory($container);
$server = $serverFactory->getServer($serverConfig['servers'][0]);

$server->start();

// $http->on('Request', function ($request, $response) {
//     $response->header('Content-Type', 'text/html; charset=utf-8');
//     $response->end('<h1>Hello Swoole. #' . rand(1000, 9999) . '</h1>');
// });

// $http->start();