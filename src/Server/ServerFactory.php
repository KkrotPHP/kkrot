<?php

namespace Kkrot\Server;

use Kkrot\Di\ContainerInterface;
use Kkrot\Server\Impl\Server;

class ServerFactory
{
    protected ServerInterface $server;

    public function __construct(
        protected ContainerInterface $container
    ){}

    public function getServer(array $config): ServerInterface{
        $config = new ServerConfig($config);
        if(!isset($this->server)){
            $this->server = new Server($this->container);
            $this->server->init($config);
        }
        return $this->server;
    }
}