<?php

namespace Kkrot\HttpServer\Message\Server;

use InvalidArgumentException;
use Kkrot\HttpServer\Message\Exception\BadRequestHttpException;

class JsonParser
{
    /**
     * @var bool
     */
    public $asArray = true;

    /**
     * @var bool
     */
    public $throwException = true;

    public function parse(string $rawBody, string $contentType): array
    {
        try {
            $parameters = json_decode($rawBody, $this->asArray);
            return is_array($parameters) ? $parameters : [];
        } catch (InvalidArgumentException $e) {
            if ($this->throwException) {
                throw new BadRequestHttpException('Invalid JSON data in request body: ' . $e->getMessage());
            }
            return [];
        }
    }

    public function has(string $contentType): bool
    {
        return true;
    }
}