<?php

namespace Kkrot\Server\Impl;

use Hyperf\Server\Event;
use Kkrot\Di\ContainerInterface;
use Kkrot\Server\ServerConfig;
use Kkrot\Server\ServerInterface;
use RuntimeException;
use Swoole\Http\Server as SwooleHttpServer;

class Server implements ServerInterface
{
    protected SwooleHttpServer $swooleServer;

    public function __construct(
        protected ContainerInterface $container
    ){}

    public function start()
    {
        $this->swooleServer->start();
    }

    public function init(ServerConfig $config): ServerInterface
    {
        $this->initServers($config);
        return $this;
    }

    protected function initServers(ServerConfig $config)
    {
        $this->swooleServer = $this->makeServer($config->getType(),$config->getHost(),$config->getPort(),SWOOLE_PROCESS,$config->getSockType());
        $this->registerSwooleEvents($this->swooleServer);
    }

    protected function makeServer(int $type, string $host, int $port, int $mode, int $sockType): SwooleHttpServer
    {
        switch ($type) {
            case ServerInterface::SERVER_HTTP:
                return new SwooleHttpServer($host, $port, $mode, $sockType);
        }
        throw new RuntimeException('Server type is invalid.');
    }

    protected function registerSwooleEvents(SwooleHttpServer $server): void
    {
        $server->on('request',[new \Kkrot\HttpServer\OnRequest(),'onRequest']);
        // $server->on('response',[new \Kkrot\HttpServer\Response(),'onResponse']);
    }
}