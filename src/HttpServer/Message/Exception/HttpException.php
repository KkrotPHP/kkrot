<?php

namespace Kkrot\HttpServer\Message\Exception;

use Kkrot\HttpServer\Message\Base\Response;
use RuntimeException;

class HttpException extends RuntimeException
{
    /**
     * @var int HTTP status
     */
    public $statusCode;

    /**
     * @param int $status HTTP status
     * @param null|string $message error message
     * @param int $code error code
     */
    public function __construct($status, $message = '', $code = 0, \Throwable $previous = null)
    {
        $this->statusCode = $status;
        if (is_null($message)) {
            $message = Response::getReasonPhraseByCode($status);
        }

        parent::__construct($message, $code, $previous);
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * @return string the user-friendly name of this exception
     */
    public function getName(): string
    {
        $message = Response::getReasonPhraseByCode($this->statusCode);
        if (! $message) {
            $message = 'Error';
        }
        return $message;
    }
}