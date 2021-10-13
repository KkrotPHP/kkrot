<?php

namespace Kkrot\Di;


use Hyperf\Di\Definition;
use Kkrot\Di\Contract\ContainerInterface;

class Container extends \Hyperf\Di\Container implements \Kkrot\Di\Contract\ContainerInterface
{
    /**
     * @template T
     * @param class-string<T>|string $name
     * @return T
     */
    public function get($name)
    {
        return parent::get($name);
    }
}