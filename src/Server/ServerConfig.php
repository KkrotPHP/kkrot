<?php

namespace Kkrot\Server;

use Kkrot\Server\Exception\InvalidArgumentException;
use Kkrot\Utils\Contracts\Arrayable;

/**
 * @method int getType()
 * @method int getPort()
 * @method string getHost()
 * @method int getModel()
 * @method int getSockType()
 */
class ServerConfig implements Arrayable
{
    public function __call(string $name, array $arguments)
    {
        $prefix = strtolower(substr($name, 0, 3));
        if (in_array($prefix, ['set', 'get'])) {
            $propertyName = strtolower(substr($name, 3));
            if (! $this->isAvailableProperty($propertyName)) {
                throw new \InvalidArgumentException(sprintf('Invalid property %s', $propertyName));
            }
            return $prefix === 'set' ? $this->set($propertyName, ...$arguments) : $this->__get($propertyName);
        }
    }

    /**
     * @var array
     */
    protected array $config;

    public function __construct(array $config = [])
    {
        $this->config = $config;
    }

    public function __get(string $name)
    {
        return $this->config[$name];
    }

    protected function set($name, $value): self
    {
        if (! $this->isAvailableProperty($name)) {
            throw new \InvalidArgumentException(sprintf('Invalid property %s', $name));
        }
        $this->config[$name] = $value;
        return $this;
    }

    public function __set(string $name, $value): void
    {
        $this->config[$name] = $value;
    }

    public function toArray(): array
    {
        return $this->config;
    }

    private function isAvailableProperty(string $name): bool
    {
        return true;
        // return in_array($name, [
        //     'type', 'mode', 'servers', 'processes', 'settings', 'callbacks',
        // ]);
    }
}