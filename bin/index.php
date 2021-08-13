<?php

use Kkrot\Config\Impl\Config;

! defined('BASE_PATH') && define('BASE_PATH', dirname(__DIR__, 1));

require BASE_PATH . '/vendor/autoload.php';



$http = new Swoole\Http\Server('0.0.0.0', 9502);
$config = require BASE_PATH . '/config/config.php';

$config = new Config();

dump($config->get('aaa'));

$http->on('Request', function ($request, $response) {
    $response->header('Content-Type', 'text/html; charset=utf-8');
    $response->end('<h1>Hello Swoole. #' . rand(1000, 9999) . '</h1>');
});

$http->start();