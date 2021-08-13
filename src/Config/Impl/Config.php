<?php
namespace Kkrot\Config\Impl;

use Kkrot\Config\ConfigInterface;

class Config implements ConfigInterface
{

    /**
     * @param string $key
     * @param mixed|null $default
     * @return mixed
     */
    public function get(string $key, $default = null)
    {
        return 1;
    }

    /**
     * @param string $keys
     * @return bool
     */
    public function has(string $keys): bool
    {
        return 1;
    }

    /**
     * @param string $key
     * @param mixed $value
     */
    public function set(string $key, $value): void
    {
    }
}