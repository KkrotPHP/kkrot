<?php

namespace Kkrot\Server;

use Kkrot\Di\Contract\ContainerInterface;
use Kkrot\Server\Contract\ServerInterface;
use RuntimeException;
use Swoole\Http\Server as SwooleHttpServer;
use const SWOOLE_PROCESS;

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
        $servers = $config->getServers();
        foreach ($servers as $server){
            $this->swooleServer = $this->makeServer($server->getType(),$server->getHost(),$server->getPort(),SWOOLE_PROCESS,$server->getSockType());
            $this->registerSwooleEvents($this->swooleServer,$server->getCallbacks());
        }
    }

    protected function makeServer(int $type, string $host, int $port, int $mode, int $sockType): SwooleHttpServer
    {
        switch ($type) {
            case ServerInterface::SERVER_HTTP:
                return new SwooleHttpServer($host, $port, $mode, $sockType);
        }
        throw new RuntimeException('Server type is invalid.');
    }

    protected function registerSwooleEvents(SwooleHttpServer $server,array $callbacks): void
    {
        foreach ($callbacks as $event => $callback){
            // if (! Event::isSwooleEvent($event))  continue;
            $server->on($event,[(new $callback[0]),$callback[1]]);
        }
    }
}