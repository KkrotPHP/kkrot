<?php

namespace Kkrot\Server\Entry;

use Psr\EventDispatcher\EventDispatcherInterface;

class EventDispatcher implements EventDispatcherInterface
{
    public function dispatch(object $event)
    {
        return $event;
    }
}