<?php

namespace Kkrot\Server\Contract;

use Kkrot\Server\ServerConfig;

interface ServerInterface
{
    public const SERVER_HTTP = 1;

    public const SERVER_WEBSOCKET = 2;

    public const SERVER_BASE = 3;

    public function start();

    public function init(ServerConfig $config): ServerInterface;
}