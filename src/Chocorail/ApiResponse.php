<?php
namespace Chocorail;

/**
 * Class ApiResponse
 *
 * @package Chocorail
 */
class ApiResponse
{
    /**
     * @var int The HTTP status code response from API.
     */
    protected $httpStatusCode;

    /**
     * @var array The headers returned from API.
     */
    protected $headers;

    /**
     * @var string The raw body of the response from API.
     */
    protected $body;

    /**
     * @var array The decoded body of the API response.
     */
    protected $decodedBody = [];

    /**
     * @var ApiRequest The original request that returned this response.
     */
    protected $request;

    /**
     * @var ApiRequest The status(success/fail/error) that returned this response.
     */
    protected $status;

    /**
     * @var ApiRequest The data that returned this response.
     */
    protected $data;

    /**
     * @var ApiRequest The message that returned this response. Available only when status is error.
     */
    protected $message;

    /**
     * @var ApiRequest The error code that returned this response. Available only when status is error.
     */
    protected $code;

    /**
     * Creates a new Response entity.
     *
     * @param ApiRequest      $request
     * @param string|null     $body
     * @param int|null        $httpStatusCode
     * @param array|null      $headers
     */
    public function __construct(ApiRequest $request, $body = null, $httpStatusCode = null, array $headers = [])
    {
        $this->request = $request;
        $this->body = $body;
        $this->httpStatusCode = $httpStatusCode;
        $this->headers = $headers;

        $this->decodeBody();
    }

    /**
     * Return the original request that returned this response.
     *
     * @return ApiRequest
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * Return the HTTP status code for this response.
     *
     * @return int
     */
    public function getHttpStatusCode()
    {
        return $this->httpStatusCode;
    }

    /**
     * Return the HTTP headers for this response.
     *
     * @return array
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * Return the raw body response.
     *
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Return the decoded body response.
     *
     * @return array
     */
    public function getDecodedBody()
    {
        return $this->decodedBody;
    }

    /**
     * Convert the raw response into an array if possible.
     *
     * API will return following types of responses:
     * - JSON(P)
     *    Most responses from API are JSON(P)
     * - And sometimes nothing :/ but that'd be a bug.
     */
    public function decodeBody()
    {
        $this->decodedBody = json_decode($this->body, true);

        if ($this->decodedBody === null) {
            $this->decodedBody = [];
        }

        if (!is_array($this->decodedBody)) {
            $this->decodedBody = [];
        }

        if (isset($this->decodedBody['status'])) {
            $this->status = $this->decodedBody['status'];
        } else {
            $this->status = 'error';
        }

        if (isset($this->decodedBody['data'])) {
            $this->data = $this->decodedBody['data'];
        } else {
            $this->data = [];
        }

        if ($this->status == 'error') {
            if (isset($this->decodedBody['message'])) {
                $this->message = $this->decodedBody['message'];
            } else {
                $this->message = 'Unknown error(HTTP '.$this->getHttpStatusCode().')';
            }

            if (isset($this->decodedBody['code'])) {
                $this->code = $this->decodedBody['code'];
            } else {
                $this->code = 'UNKNOWN';
            }
        }
    }

    /**
     * Returns true if API returned success.
     *
     * @return boolean
     */
    public function isSuccess()
    {
        return ($this->status === 'success');
    }

    /**
     * Returns true if API returned an fail.
     *
     * @return boolean
     */
    public function isFail()
    {
        return ($this->status === 'error');
    }

    /**
     * Returns true if API returned an error message.
     *
     * @return boolean
     */
    public function isError()
    {
        return ($this->status === 'error');
    }

    /**
     * Returns the error type(success/fail/error)
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Returns the message
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Returns the error code
     *
     * @return string
     */
    public function getErrorCode()
    {
        return $this->code;
    }

    /**
     * Returns the data
     *
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Return the following messages depending on the status
     * - success
     *   Empty array
     * - fail
     *   Messages with key that indicate field name
     * - error
     *   A error message
     *
     * @return string
     */
    public function getErrorMessages()
    {
        if ($this->status == 'success') {
            return [];
        } else if ($this->status == 'fail') {
            return $this->data;
        } else {
            return [ $this->message ];
        }
    }
}
