<?php

namespace Kkrot\Server;

use Hyperf\Contract\ContainerInterface;
use Kkrot\Server\Contract\ServerInterface;
use Kkrot\Server\Entry\EventDispatcher;
use Kkrot\Server\Entry\Logger;
use Psr\EventDispatcher\EventDispatcherInterface;
use Psr\Log\LoggerInterface;

class ServerFactory
{
    protected ?ServerInterface $server = null;
    private ?LoggerInterface $logger = null;
    private ?EventDispatcherInterface $eventDispatcher = null;
    private \Psr\Container\ContainerInterface $container;
    private ServerConfig $config;

    public function __construct(\Psr\Container\ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function getServer(): ServerInterface
    {
        if (! $this->server instanceof ServerInterface) {
            $serverName = $this->config->getType();
            $this->server = new $serverName(
                $this->container,
                $this->getLogger(),
                $this->getEventDispatcher()
            );
        }

        return $this->server;
    }

    public function getLogger(): LoggerInterface
    {
        if ($this->logger instanceof LoggerInterface) {
            return $this->logger;
        }
        return $this->getDefaultLogger();
    }

    public function getEventDispatcher(): EventDispatcherInterface
    {
        if ($this->eventDispatcher instanceof EventDispatcherInterface) {
            return $this->eventDispatcher;
        }
        return $this->getDefaultEventDispatcher();
    }

    public function setEventDispatcher(EventDispatcherInterface $eventDispatcher): self
    {
        $this->eventDispatcher = $eventDispatcher;
        return $this;
    }

    public function setLogger(LoggerInterface $logger): self
    {
        $this->logger = $logger;
        return $this;
    }

    public function configure(array $config)
    {
        $this->config = new ServerConfig($config);

        $this->getServer()->init($this->config);
    }

    private function getDefaultEventDispatcher(): EventDispatcher
    {
        return new EventDispatcher();
    }

    private function getDefaultLogger(): Logger
    {
        return new Logger();
    }

    public function start()
    {
        return $this->getServer()->start();
    }


}