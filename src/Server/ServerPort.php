<?php

namespace Kkrot\Server;

use Kkrot\Server\Contract\ServerInterface;

class ServerPort
{
    /**
     * @var string
     */
    protected string $name = 'http';

    /**
     * @var int
     */
    protected int $type = ServerInterface::SERVER_HTTP;

    /**
     * @var string
     */
    protected string $host = '0.0.0.0';

    /**
     * @var int
     */
    protected int $port = 9501;

    /**
     * @var int
     */
    protected int $sockType = 0;

    /**
     * @var array
     */
    protected array $callbacks = [];

    /**
     * @var array
     */
    protected array $settings = [];

    public static function build(array $config): static
    {
        $config = self::filter($config);

        $port = new static();
        isset($config['name']) && $port->setName($config['name']);
        isset($config['type']) && $port->setType($config['type']);
        isset($config['host']) && $port->setHost($config['host']);
        isset($config['port']) && $port->setPort($config['port']);
        isset($config['sock_type']) && $port->setSockType($config['sock_type']);
        isset($config['callbacks']) && $port->setCallbacks($config['callbacks']);
        isset($config['settings']) && $port->setSettings($config['settings']);

        return $port;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getType(): int
    {
        return $this->type;
    }

    /**
     * @param int $type
     */
    public function setType(int $type): void
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getHost(): string
    {
        return $this->host;
    }

    /**
     * @param string $host
     */
    public function setHost(string $host): void
    {
        $this->host = $host;
    }

    /**
     * @return int
     */
    public function getPort(): int
    {
        return $this->port;
    }

    /**
     * @param int $port
     */
    public function setPort(int $port): void
    {
        $this->port = $port;
    }

    /**
     * @return int
     */
    public function getSockType(): int
    {
        return $this->sockType;
    }

    /**
     * @param int $sockType
     */
    public function setSockType(int $sockType): void
    {
        $this->sockType = $sockType;
    }

    /**
     * @return array
     */
    public function getCallbacks(): array
    {
        return $this->callbacks;
    }

    /**
     * @param array $callbacks
     */
    public function setCallbacks(array $callbacks): void
    {
        $this->callbacks = $callbacks;
    }

    /**
     * @return array
     */
    public function getSettings(): array
    {
        return $this->settings;
    }

    /**
     * @param array $settings
     */
    public function setSettings(array $settings): void
    {
        $this->settings = $settings;
    }

    private static function filter(array $config): array
    {
        if ((int) $config['type'] === ServerInterface::SERVER_BASE) {
            $default = [
                'open_http2_protocol' => false,
                'open_http_protocol' => false,
            ];

            $config['settings'] = array_merge($default, $config['settings'] ?? []);
        }

        return $config;
    }
}