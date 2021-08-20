<?php

namespace Kkrot\HttpServer\Server\Contract;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;

interface CoreMiddlewareInterface extends MiddlewareInterface
{
    public function dispatch(ServerRequestInterface $request): ServerRequestInterface;
}