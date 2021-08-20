<?php

namespace Kkrot\HttpServer\Message\Server;

use Kkrot\HttpServer\Message\Server\Contract\RequestParserInterface;

class Parser implements RequestParserInterface
{
    protected $parsers = [];

    public function __construct()
    {
        $jsonParser = make(JsonParser::class);

        $this->parsers = [
            'application/json' => $jsonParser,
            'text/json' => $jsonParser,
        ];
    }

    public function parse(string $rawBody, string $contentType): array
    {
        $contentType = strtolower($contentType);
        if (! array_key_exists($contentType, $this->parsers)) {
            throw new \InvalidArgumentException("The '{$contentType}' request parser is not defined.");
        }

        $parser = $this->parsers[$contentType];
        if (! $parser instanceof RequestParserInterface) {
            throw new \InvalidArgumentException("The '{$contentType}' request parser is invalid. It must implement the Hyperf\\HttpMessage\\Server\\RequestParserInterface.");
        }

        return $parser->parse($rawBody, $contentType);
    }

    public function has(string $contentType): bool
    {
        return array_key_exists(strtolower($contentType), $this->parsers);
    }
}