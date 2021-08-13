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

    public function getServer(): ServerInterface{
        if(! $this->server instanceof ServerInterface){
            $this->server = new Server();
        }
        return $this->server;
    }

    public function start(){
        return $this->getServer()->start();
    }
}