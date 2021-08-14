<?php

namespace Kkrot\HttpServer\Contract;

interface OnRequestInterface
{
    public function onRequest($request, $response): void;
}