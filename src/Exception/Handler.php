<?php

namespace IanOlson\Insightly\Exception;

use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Arr;

class Handler
{
    /**
     * List of mapped exceptions and their corresponding status codes.
     *
     * @var array
     */
    protected $exceptionsByStatusCode = [

        // Often missing a required parameter
        400 => 'BadRequest',

        // Invalid Insightly API key provided
        401 => 'Unauthorized',

        // Parameters were valid but request failed
        402 => 'InvalidRequest',

        // The requested item doesn't exist
        404 => 'NotFound',

        // Something went wrong on Insightly's end
        500 => 'ServerError',
        502 => 'ServerError',
        503 => 'ServerError',
        504 => 'ServerError',
    ];

    /**
     * Constructor.
     *
     * @param ClientException $exception
     *
     * @return void
     */
    public function __construct(ClientException $exception)
    {
        $response = $exception->getResponse();
        $statusCode = $response->getStatusCode();
        $message = $response->getReasonPhrase();

        $this->handleException($message, $statusCode);
    }

    /**
     * Handle and throw an exception.
     *
     * @param string $message
     * @param int    $statusCode
     */
    protected function handleException($message, $statusCode)
    {
        if (Arr::has($this->exceptionsByStatusCode, $statusCode)) {
            $class = Arr::get($this->exceptionsByStatusCode, $statusCode);
        }

        $class = "\\IanOlson\\Insightly\\Exception\\{$class}Exception";

        throw new $class($message, $statusCode);
    }
}
