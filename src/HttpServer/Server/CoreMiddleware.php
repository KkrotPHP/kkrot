<?php

namespace Kkrot\HttpServer\Server;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use Kkrot\HttpServer\Message\Stream\SwooleStream;
use Kkrot\HttpServer\Response;
use Kkrot\HttpServer\Server\Contract\CoreMiddlewareInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class CoreMiddleware implements CoreMiddlewareInterface
{

    /**
     * @param ServerRequestInterface $request
     * @return ServerRequestInterface
     */
    public function dispatch(ServerRequestInterface $request): ServerRequestInterface
    {
        return $request;
    }

    /**
     * @param ServerRequestInterface $request
     * @param RequestHandlerInterface $handler
     * @return ResponseInterface
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $response = $this->transferToResponse('hello',$request);
        return $response->withAddedHeader('Server', 'Hyperf');
    }

    /**
     * Transfer the non-standard response content to a standard response object.
     *
     * @param null|array|Arrayable|Jsonable|string $response
     */
    protected function transferToResponse($response, ServerRequestInterface $request): ResponseInterface
    {
        if (is_string($response)) {
            return $this->response()->withAddedHeader('content-type', 'text/plain')->withBody(new SwooleStream($response));
        }

        if (is_array($response) || $response instanceof Arrayable) {
            return $this->response()
                ->withAddedHeader('content-type', 'application/json')
                ->withBody(new SwooleStream(json_encode($response)));
        }

        if ($response instanceof Jsonable) {
            return $this->response()
                ->withAddedHeader('content-type', 'application/json')
                ->withBody(new SwooleStream((string) $response));
        }

        return $this->response()->withAddedHeader('content-type', 'text/plain')->withBody(new SwooleStream((string) $response));
    }

    /**
     * Get response instance from context.
     */
    protected function response(): ResponseInterface
    {
        return new Response();
    }
}