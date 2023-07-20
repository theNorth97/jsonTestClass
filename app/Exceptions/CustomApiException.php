<?php

namespace App\Exceptions;

use Exception;

class CustomApiException extends Exception
{
    protected int $statusCode;
    protected string $errorMessage;

    public function __construct($message, $statusCode = null, Exception $previous = null)
    {
        parent::__construct($message, $statusCode, $previous);
        $this->statusCode = $statusCode;
        $this->errorMessage = $message;
    }

    public function getStatusCode(): int
    {

        return $this->statusCode;
    }

    public function getErrorMessage(): string
    {
        return $this->errorMessage;
    }
}
