<?php

namespace Kkrot\HttpServer;

use Kkrot\Di\Container;
use Kkrot\Dispatcher\HttpDispatcher;
use Kkrot\HttpServer\Message\Server\Request;
use Kkrot\HttpServer\Server\Contract\CoreMiddlewareInterface;
use Kkrot\HttpServer\Server\Contract\OnRequestInterface;
use Kkrot\HttpServer\Server\Contract\ResponseEmitterInterface;
use Kkrot\HttpServer\Server\CoreMiddleware;
use Kkrot\HttpServer\Server\ResponseEmitter;
use Psr\Http\Message\ServerRequestInterface;

class OnRequest implements OnRequestInterface
{
    /**
     * @var HttpDispatcher
     */
    protected $dispatcher;

    /**
     * @var CoreMiddlewareInterface
     */
    protected $coreMiddleware;

    /**
     * @var ResponseEmitterInterface
     */
    protected $responseEmitter;

    public function __construct()
    {
        $this->coreMiddleware = new CoreMiddleware();
        $this->responseEmitter = new ResponseEmitter();
        $this->dispatcher = new HttpDispatcher(new Container());
    }

    /**
     * @param $request
     * @param $response
     */
    public function onRequest($request, $response): void
    {
        [$psr7Request, $psr7Response] = $this->initRequestAndResponse($request, $response);
        $psr7Response = $this->dispatcher->dispatch($psr7Request, [], $this->coreMiddleware);
        $this->responseEmitter->emit($psr7Response, $response, false);
        // $response->header('Content-Type', 'text/html; charset=utf-8');
        // $response->end('hello Kkrot');

    }

    protected function initRequestAndResponse($request, $response): array
    {
        if ($request instanceof ServerRequestInterface) {
            $psr7Request = $request;
        } else {
            $psr7Request = Request::loadFromSwooleRequest($request);
        }
        return [$psr7Request, new Response()];
    }
}