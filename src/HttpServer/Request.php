<?php

namespace Kkrot\HttpServer;

use Kkrot\HttpServer\Contract\RequestInterface;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\UriInterface;

class Request implements RequestInterface
{

    /**
     * @return array
     */
    public function getServerParams()
    {
        // TODO: Implement getServerParams() method.
    }

    /**
     * @return array
     */
    public function getCookieParams()
    {
        // TODO: Implement getCookieParams() method.
    }

    /**
     * @param array $cookies
     * @return $this
     */
    public function withCookieParams(array $cookies)
    {
        // TODO: Implement withCookieParams() method.
    }

    /**
     * @return array
     */
    public function getQueryParams()
    {
        // TODO: Implement getQueryParams() method.
    }

    /**
     * @param array $query
     * @return $this
     */
    public function withQueryParams(array $query)
    {
        // TODO: Implement withQueryParams() method.
    }

    /**
     * @return array
     */
    public function getUploadedFiles()
    {
        // TODO: Implement getUploadedFiles() method.
    }

    /**
     * @param array $uploadedFiles
     * @return $this
     */
    public function withUploadedFiles(array $uploadedFiles)
    {
        // TODO: Implement withUploadedFiles() method.
    }

    /**
     * @return array|object|null
     */
    public function getParsedBody()
    {
        // TODO: Implement getParsedBody() method.
    }

    /**
     * @param array|object|null $data
     * @return $this
     */
    public function withParsedBody($data)
    {
        // TODO: Implement withParsedBody() method.
    }

    /**
     * @return array
     */
    public function getAttributes()
    {
        // TODO: Implement getAttributes() method.
    }

    /**
     * @param string $name
     * @param mixed|null $default
     * @return mixed
     */
    public function getAttribute($name, $default = null)
    {
        // TODO: Implement getAttribute() method.
    }

    /**
     * @param string $name
     * @param mixed $value
     * @return $this
     */
    public function withAttribute($name, $value)
    {
        // TODO: Implement withAttribute() method.
    }

    /**
     * @param string $name
     * @return $this
     */
    public function withoutAttribute($name)
    {
        // TODO: Implement withoutAttribute() method.
    }

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
     * @return string
     */
    public function getRequestTarget()
    {
        // TODO: Implement getRequestTarget() method.
    }

    /**
     * @param mixed $requestTarget
     * @return $this
     */
    public function withRequestTarget($requestTarget)
    {
        // TODO: Implement withRequestTarget() method.
    }

    /**
     * @return string
     */
    public function getMethod()
    {
        // TODO: Implement getMethod() method.
    }

    /**
     * @param string $method
     * @return $this
     */
    public function withMethod($method)
    {
        // TODO: Implement withMethod() method.
    }

    /**
     * @return UriInterface
     */
    public function getUri()
    {
        // TODO: Implement getUri() method.
    }

    /**
     * @param UriInterface $uri
     * @param bool $preserveHost
     * @return $this
     */
    public function withUri(UriInterface $uri, $preserveHost = false)
    {
        // TODO: Implement withUri() method.
    }
}