<?php

namespace Kkrot\HttpServer;

use Hyperf\Utils\Context;
use Kkrot\Dispatcher\HttpDispatcher;
use Kkrot\HttpServer\Message\Server\Request;
use Kkrot\HttpServer\Server\Contract\CoreMiddlewareInterface;
use Kkrot\HttpServer\Server\Contract\OnRequestInterface;
use Kkrot\HttpServer\Server\Contract\ResponseEmitterInterface;
use Kkrot\HttpServer\Server\CoreMiddleware;
use Kkrot\HttpServer\Server\ResponseEmitter;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class OnRequest implements OnRequestInterface
{
    protected HttpDispatcher $dispatcher;

    protected CoreMiddlewareInterface $coreMiddleware;

    protected ResponseEmitterInterface $responseEmitter;

    public function __construct(ContainerInterface $container)
    {
        $this->coreMiddleware = new CoreMiddleware($container, 'request');
        $this->responseEmitter = new ResponseEmitter();
        $this->dispatcher = new HttpDispatcher($container);
    }

    /**
     * @param $request
     * @param \Swoole\Http\Response $response
     */
    public function onRequest($request, $response): void
    {
        $response->setHeader('Content-Type', 'text/html; charset=utf-8');
        $response->write('hello1');
        [$psr7Request, $psr7Response] = $this->initRequestAndResponse($request, $response);
        $psr7Response = $this->dispatcher->dispatch($psr7Request, [], $this->coreMiddleware);
        $this->responseEmitter->emit($psr7Response, $response, false);
    }

    protected function initRequestAndResponse($request, $response): array
    {
        Context::set(ResponseInterface::class, $psr7Response = new \Kkrot\HttpServer\Message\Server\Response());
        if ($request instanceof ServerRequestInterface) {
            $psr7Request = $request;
        } else {
            $psr7Request = Request::loadFromSwooleRequest($request);
        }
        return [$psr7Request, new \Kkrot\HttpServer\Message\Base\Response()];
    }
}