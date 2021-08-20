<?php

namespace Kkrot\HttpServer\Message\Server\Contract;

interface RequestParserInterface
{
    public function parse(string $rawBody, string $contentType): array;

    public function has(string $contentType): bool;
}