<?php
namespace Kkrot\Config;

interface ConfigInterface
{
    /**
     * @param string $key
     * @param mixed|null $default
     * @return mixed
     */
    public function get(string $key, $default = null);

    /**
     * @param string $keys
     * @return bool
     */
    public function has(string $keys): bool;

    /**
     * @param string $key
     * @param mixed $value
     */
    public function set(string $key, $value): void;
}