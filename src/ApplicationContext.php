<?php

namespace Kkrot;

use Psr\Container\ContainerInterface;

class ApplicationContext
{
    /**
     * @var ?ContainerInterface
     */
    private static ?ContainerInterface $container;

    public static function getContainer(): ContainerInterface
    {
        return self::$container;
    }

    public static function hasContainer(): bool
    {
        return isset(self::$container);
    }

    public static function setContainer(ContainerInterface $container): ContainerInterface
    {
        self::$container = $container;
        return $container;
    }
}