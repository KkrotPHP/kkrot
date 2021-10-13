<?php

use Hyperf\Di\Container;
use Hyperf\Di\Definition\DefinitionSourceFactory;
use Kkrot\ApplicationContext;
use Kkrot\Config\Contract\ConfigInterface;
use Kkrot\Server\Command\StartServer;
use Kkrot\Server\ServerFactory;
use Symfony\Component\Console\Application;
use function Co\run;

! defined('BASE_PATH') && define('BASE_PATH', dirname(__DIR__, 1));

require BASE_PATH . '/vendor/autoload.php';


(function () {
    Hyperf\Di\ClassLoader::init();
    // $serverConfig = require BASE_PATH . '/config/server.php';
    $container = new Container((new DefinitionSourceFactory(true))());
    ApplicationContext::setContainer($container);

    $application = $container->get(Application::class);


    $application->add(new StartServer($container));

    // $config = $container->get(ConfigInterface::class);
    $application->run();
    // dump($config);
})();

// Hyperf\Di\ClassLoader::init();
//
// $serverConfig = require BASE_PATH . '/config/server.php';
// $container = new Container((new DefinitionSourceFactory(true))());
// ApplicationContext::setContainer($container);
// $serverFactory = new ServerFactory($container);
// $server = $serverFactory->getServer($serverConfig);
//
// $server->start();

// $config = $container->get(ConfigInterface::class);
//
// dump($config);
//
//
// $application = $container->get(Application::class);
//
// $application->add(new StartServer($container));
//
// /** @noinspection PhpUnhandledExceptionInspection */
// $application->run();

// $http = new Swoole\Http\Server('0.0.0.0', 9501);
//
// $http->on('Request', function ($request, $response) {
//     $response->header('Content-Type', 'text/html; charset=utf-8');
//     $response->end('<h1>Hello Swoole. #' . rand(1000, 9999) . '</h1>');
// });
//
// $http->start();