<?php

namespace Kkrot\Di\Resolver;

use Kkrot\Di\Exception\CircularDependencyException;
use Kkrot\Utils\Context;

class DepthGuard
{
    /**
     * @var int
     */
    protected int $depthLimit = 500;

    /**
     * @var DepthGuard
     */
    private static $instance;

    public static function getInstance(): DepthGuard|static
    {
        if (! isset(self::$instance)) {
            self::$instance = new static();
        }
        return self::$instance;
    }

    /**
     * Allows user to adjust depth limit.
     * Should call it before di container bootstraps.
     */
    public function setDepthLimit(int $depthLimit)
    {
        $this->depthLimit = $depthLimit;
    }

    public function increment()
    {
        Context::override('di.depth', function ($depth) {
            $depth = $depth ?? 0;
            if (++$depth > $this->depthLimit) {
                throw new CircularDependencyException();
            }
            return $depth;
        });
    }

    public function decrement()
    {
        Context::override('di.depth', function ($depth) {
            return --$depth;
        });
    }

    public function call(string $name, callable $callable)
    {
        try {
            $this->increment();
            return $callable();
        } catch (CircularDependencyException $exception) {
            $exception->addDefinitionName($name);
            throw $exception;
        } finally {
            $this->decrement();
        }
    }
}