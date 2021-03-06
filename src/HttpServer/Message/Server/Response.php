<?php

namespace Kkrot\HttpServer\Message\Server;


use Kkrot\HttpServer\Message\Stream\SwooleStream;

class Response extends \Kkrot\HttpServer\Message\Base\Response
{
    /**
     * @var array
     */
    protected $cookies = [];

    /**
     * @var array
     */
    protected $trailers = [];

    /**
     * Returns an instance with body content.
     */
    public function withContent(string $content): self
    {
        $new = clone $this;
        $new->stream = new SwooleStream($content);
        return $new;
    }

    /**
     * Retrieves all cookies.
     */
    public function getCookies(): array
    {
        return $this->cookies;
    }

    /**
     * Returns an instance with specified trailer.
     * @param string $value
     */
    public function withTrailer(string $key, $value): self
    {
        $new = clone $this;
        $new->trailers[$key] = $value;
        return $new;
    }

    /**
     * Retrieves a specified trailer value, returns null if the value does not exists.
     */
    public function getTrailer(string $key)
    {
        return $this->trailers[$key] ?? null;
    }

    /**
     * Retrieves all trailers values.
     */
    public function getTrailers(): array
    {
        return $this->trailers;
    }
}