<?php

namespace Kkrot\HttpServer;

use Kkrot\HttpServer\Contract\OnRequestInterface;

class OnRequest implements OnRequestInterface
{

    /**
     * @param $request
     * @param $response
     */
    public function onRequest($request, $response): void
    {
        dump(__FUNCTION__);
        $response->header('Content-Type', 'text/html; charset=utf-8');
        $response->end('<h1>Hello Swoole. #' . rand(1000, 9999) . '</h1>');
    }
}