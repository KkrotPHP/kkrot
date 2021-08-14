<?php

namespace Kkrot\HttpServer;

use Kkrot\HttpServer\Contract\ResponseInterface;
use Psr\Http\Message\StreamInterface;

class Response implements ResponseInterface
{

    /**
     * @return string
     */
    public function getProtocolVersion()
    {
        // TODO: Implement getProtocolVersion() method.
    }

    /**
     * @param string $version
     * @return $this
     */
    public function withProtocolVersion($version)
    {
        // TODO: Implement withProtocolVersion() method.
    }

    /**
     * @return \string[][]
     */
    public function getHeaders()
    {
        // TODO: Implement getHeaders() method.
    }

    /**
     * @param string $name
     * @return bool
     */
    public function hasHeader($name)
    {
        // TODO: Implement hasHeader() method.
    }

    /**
     * @param string $name
     * @return string[]
     */
    public function getHeader($name)
    {
        // TODO: Implement getHeader() method.
    }

    /**
     * @param string $name
     * @return string
     */
    public function getHeaderLine($name)
    {
        // TODO: Implement getHeaderLine() method.
    }

    /**
     * @param string $name
     * @param string|string[] $value
     * @return $this
     */
    public function withHeader($name, $value)
    {
        // TODO: Implement withHeader() method.
    }

    /**
     * @param string $name
     * @param string|string[] $value
     * @return $this
     */
    public function withAddedHeader($name, $value)
    {
        // TODO: Implement withAddedHeader() method.
    }

    /**
     * @param string $name
     * @return $this
     */
    public function withoutHeader($name)
    {
        // TODO: Implement withoutHeader() method.
    }

    /**
     * @return StreamInterface
     */
    public function getBody()
    {
        // TODO: Implement getBody() method.
    }

    /**
     * @param StreamInterface $body
     * @return $this
     */
    public function withBody(StreamInterface $body)
    {
        // TODO: Implement withBody() method.
    }

    /**
     * @return int
     */
    public function getStatusCode()
    {
        // TODO: Implement getStatusCode() method.
    }

    /**
     * @param int $code
     * @param string $reasonPhrase
     * @return $this
     */
    public function withStatus($code, $reasonPhrase = '')
    {
        // TODO: Implement withStatus() method.
    }

    /**
     * @return string
     */
    public function getReasonPhrase()
    {
        // TODO: Implement getReasonPhrase() method.
    }
}