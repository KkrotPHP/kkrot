<?php

namespace Kkrot\Utils;

use co;
use Swoole\Coroutine as SwooleCo;

class Coroutine
{
    /**
     * Returns the current coroutine ID.
     * Returns -1 when running in non-coroutine context.
     */
    public static function id(): int
    {
        return SwooleCo::getCid();
    }

    public static function defer(callable $callable)
    {
        SwooleCo::defer($callable);
    }

    public static function sleep(float $seconds)
    {
        usleep(intval($seconds * 1000 * 1000));
    }


    public static function inCoroutine(): bool
    {
        return self::id() > 0;
    }

    /**
     * @return null|\ArrayObject
     */
    public static function getContextFor(?int $id = null)
    {
        if ($id === null) {
            return SwooleCo::getContext();
        }

        return SwooleCo::getContext($id);
    }
}