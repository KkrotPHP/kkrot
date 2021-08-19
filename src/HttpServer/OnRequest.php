<?php

namespace Kkrot\HttpServer;

use Hyperf\HttpMessage\Server\Response as Psr7Response;
use Kkrot\HttpServer\Contract\OnRequestInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ServerRequestInterface;

class OnRequest implements OnRequestInterface
{

    /**
     * @param $request
     * @param $response
     */
    public function onRequest($request, $response): void
    {
        dump(__FUNCTION__);
        dump(get_class($request));
        dump($request instanceof ServerRequestInterface);
        // $response->header('Content-Type', 'text/html; charset=utf-8');
        // $response->end('hello Kkrot');
        // RequestInterface::

    }

    protected function initRequestAndResponse($request, $response): array
    {
        if ($request instanceof ServerRequestInterface) {
            $psr7Request = $request;
        } else {
            $psr7Request = ServerRequest::loadFromSwooleRequest($request);
        }
        return [$psr7Request, new Response()];
    }
}