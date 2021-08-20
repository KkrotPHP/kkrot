<?php

namespace Kkrot\HttpServer\Server\Contract;

use Psr\Http\Message\ResponseInterface;

interface ResponseEmitterInterface
{
    /**
     * @param mixed $connection swoole response or swow session
     */
    public function emit(ResponseInterface $response, $connection, bool $withContent = true);
}