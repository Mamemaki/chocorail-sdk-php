<?php
namespace Chocorail\Exceptions;

use Chocorail\ApiResponse;
use Chocorail\Exceptions\ChocorailException;

/**
 * Class ApiResponseException
 *
 * @package Chocorail
 */
class ApiResponseException extends ChocorailException
{
    /**
     * @var ApiResponse The response that threw the exception.
     */
    protected $response;

    /**
     * @var array Decoded response.
     */
    protected $responseData;

    /**
     * Creates a ApiResponseException.
     *
     * @param ApiResponse          $response          The response that threw the exception.
     * @param ChocorailException   $previousException The more detailed exception.
     */
    public function __construct(ApiResponse $response, ChocorailException $previousException = null)
    {
        $this->response = $response;
        $this->responseData = $response->getDecodedBody();

        $errorMessage = $this->response->getMessage();
        if ($errorMessage === null) {
            $errorMessage = 'Unknown error.';
        }

        parent::__construct($errorMessage, 0, $previousException);
    }

    /**
     * Returns the HTTP status code
     *
     * @return int
     */
    public function getHttpStatusCode()
    {
        return $this->response->getHttpStatusCode();
    }

    /**
     * Returns the error code
     *
     * @return int
     */
    public function getErrorCode()
    {
        return $this->responseData->getErrorCode();
    }

    /**
     * Returns the error type
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->responseData->getStatus();
    }

    /**
     * Returns the raw response used to create the exception.
     *
     * @return string
     */
    public function getRawResponse()
    {
        return $this->response->getBody();
    }

    /**
     * Returns the decoded response used to create the exception.
     *
     * @return array
     */
    public function getResponseData()
    {
        return $this->responseData;
    }

    /**
     * Returns the response entity used to create the exception.
     *
     * @return ApiResponse
     */
    public function getResponse()
    {
        return $this->response;
    }
}
