<?php

namespace Kkrot\Dispatcher;

use InvalidArgumentException;
use Psr\Container\ContainerInterface;

class AbstractRequestHandler
{
    /**
     * @var array
     */
    protected $middlewares = [];

    /**
     * @var int
     */
    protected $offset = 0;


    /**
     * @var ContainerInterface
     */
    protected $container;

    private $coreHandler;

    public function __construct(array $middlewares,$coreHandler, ContainerInterface $container)
    {
        $this->middlewares = array_values($middlewares);
        $this->coreHandler = $coreHandler;
        $this->container = $container;
    }

    protected function handleRequest($request)
    {
        if (! isset($this->middlewares[$this->offset]) && ! empty($this->coreHandler)) {
            $handler = $this->coreHandler;
        } else {
            $handler = $this->middlewares[$this->offset];
            is_string($handler) && $handler = $this->container->get($handler);
        }
        if (! method_exists($handler, 'process')) {
            throw new InvalidArgumentException(sprintf('Invalid middleware, it has to provide a process() method.'));
        }
        return $handler->process($request, $this->next());
    }

    protected function next(): self
    {
        ++$this->offset;
        return $this;
    }
}