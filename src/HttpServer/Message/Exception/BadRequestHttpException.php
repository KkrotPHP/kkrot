<?php

namespace Kkrot\HttpServer\Message\Exception;

class BadRequestHttpException extends HttpException
{
    public function __construct($message = null, $code = 0, \Throwable $previous = null)
    {
        parent::__construct(400, $message, $code, $previous);
    }
}