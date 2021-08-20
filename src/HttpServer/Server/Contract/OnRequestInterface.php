<?php

namespace Kkrot\HttpServer\Server\Contract;

interface OnRequestInterface
{
    public function onRequest($request, $response): void;
}