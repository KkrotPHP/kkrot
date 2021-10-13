<?php

namespace Kkrot;

use Hyperf\Di\Annotation\AnnotationCollector;
use Hyperf\Di\Annotation\AspectCollector;
use Hyperf\Di\Annotation\InjectAspect;
use Hyperf\Di\Aop\AstVisitorRegistry;
use Hyperf\Di\Aop\PropertyHandlerVisitor;
use Hyperf\Di\Aop\ProxyCallVisitor;
use Hyperf\Di\Aop\RegisterInjectPropertyHandler;
use Hyperf\Di\ClosureDefinitionCollector;
use Hyperf\Di\ClosureDefinitionCollectorInterface;
use Hyperf\Di\MethodDefinitionCollector;
use Hyperf\Di\MethodDefinitionCollectorInterface;
use Kkrot\Config\ConfigFactory;
use Kkrot\Config\Contract\ConfigInterface;
use Kkrot\Di\Container;
use Kkrot\Di\Contract\ContainerInterface;

class ConfigProvider
{
    public function __invoke(): array
    {
        // Register AST visitors to the collector.
        if (! AstVisitorRegistry::exists(PropertyHandlerVisitor::class)) {
            AstVisitorRegistry::insert(PropertyHandlerVisitor::class, PHP_INT_MAX / 2);
        }

        if (! AstVisitorRegistry::exists(ProxyCallVisitor::class)) {
            AstVisitorRegistry::insert(ProxyCallVisitor::class, PHP_INT_MAX / 2);
        }

        // Register Property Handler.
        RegisterInjectPropertyHandler::register();

        return [
            'dependencies' => [
                MethodDefinitionCollectorInterface::class => MethodDefinitionCollector::class,
                ContainerInterface::class => Container::class,
                ClosureDefinitionCollectorInterface::class => ClosureDefinitionCollector::class,
                ConfigInterface::class => ConfigFactory::class
            ],
            'aspects' => [
                InjectAspect::class,
            ],
            'annotations' => [
                'scan' => [
                    'paths' => [
                        __DIR__,
                    ],
                    'collectors' => [
                        AnnotationCollector::class,
                        AspectCollector::class,
                    ],
                ],
                'ignore_annotations' => [
                    'mixin',
                ],
            ],
        ];
    }
}