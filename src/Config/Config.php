<?php
namespace Kkrot\Config;

use Hyperf\Utils\Arr;
use Kkrot\Config\Contract\ConfigInterface;

class Config implements ConfigInterface
{
    /**
     * @var array
     */
    private array $configs = [];

    public function __construct(array $configs)
    {
        $this->configs = $configs;
    }

    /**
     * Finds an entry of the container by its identifier and returns it.
     *
     * @param string $key identifier of the entry to look for
     * @param mixed $default default value of the entry when does not found
     * @return mixed entry
     */
    public function get(string $key, $default = null): mixed
    {
        return data_get($this->configs, $key, $default);
    }

    /**
     * Returns true if the container can return an entry for the given identifier.
     * Returns false otherwise.
     *
     * @param string $keys identifier of the entry to look for
     * @return bool
     */
    public function has(string $keys) :bool
    {
        return Arr::has($this->configs, $keys);
    }

    /**
     * Set a value to the container by its identifier.
     *
     * @param string $key identifier of the entry to set
     * @param mixed $value the value that save to container
     */
    public function set(string $key, $value) : void
    {
        data_set($this->configs, $key, $value);
    }
}