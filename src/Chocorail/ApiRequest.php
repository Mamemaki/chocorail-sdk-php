<?php
namespace Chocorail;

/**
 * Class Request
 *
 * @package Chocorail
 */
class ApiRequest
{
    /**
     * @var string|null The API key to use for this request.
     */
    protected $apikey;

    /**
     * @var string The HTTP method for this request.
     */
    protected $method;

    /**
     * @var string The Api endpoint for this request. Must start with a slash. e.g. "/shoppages/girls"
     */
    protected $endpoint;

    /**
     * @var array The headers to send with this request.
     */
    protected $headers = [];

    /**
     * @var array The parameters to send with this request.
     */
    protected $params = [];

    /**
     * @var string API version to use for this request. e.g. "v1"
     */
    protected $apiVersion;

    /**
     * @var string 'application/json' or 'multipart/form-data'
     */
    protected $contentType;

    /**
     * @var array The default headers that every request should use.
     */
    protected static $defaultHeaders = [
        'User-Agent' => 'chocorail-php-' . Chocorail::VERSION,
    ];

    /**
     * Creates a new Request entity.
     *
     * @param string|null             $apikey
     * @param string|null             $method
     * @param string|null             $endpoint
     * @param array|null              $params
     * @param string|null             $apiVersion
     * @param string|null             $contentType
     */
    public function __construct($apikey = null, $method = null, $endpoint = null, array $params = [], $apiVersion = null, $contentType = null)
    {
        $this->setApikey($apikey);
        $this->setMethod($method);
        $this->setEndpoint($endpoint);
        $this->setParams($params);
        $this->apiVersion = $apiVersion ?: Chochorail::DEFAULT_API_VERSION;
        $this->contentType = $contentType ?: 'application/json';
    }

    /**
     * Set the access token for this request.
     *
     * @param Apikey|string|null
     *
     * @return ApiRequest
     */
    public function setApikey($apikey)
    {
        $this->apikey = $apikey;

        return $this;
    }

    /**
     * Return the access token for this request.
     *
     * @return string|null
     */
    public function getApikey()
    {
        return $this->apikey;
    }

    /**
     * Set the HTTP method for this request.
     *
     * @param string
     */
    public function setMethod($method)
    {
        $this->method = strtoupper($method);
    }

    /**
     * Return the HTTP method for this request.
     *
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * Validate that the HTTP method is set.
     *
     * @throws Exception
     */
    public function validateMethod()
    {
        if (!$this->method) {
            throw new Exception('HTTP method not specified.');
        }

        if (!in_array($this->method, ['GET', 'POST', 'PUT', 'DELETE'])) {
            throw new Exception('Invalid HTTP method specified.');
        }
    }

    /**
     * Set the endpoint for this request.
     *
     * @param string
     *
     * @return ApiRequest
     */
    public function setEndpoint($endpoint)
    {
        $this->endpoint = $endpoint;

        return $this;
    }

    /**
     * Return the endpoint for this request.
     *
     * @return string
     */
    public function getEndpoint()
    {
        return $this->endpoint;
    }

    /**
     * Generate and return the headers for this request.
     *
     * @return array
     */
    public function getHeaders()
    {
        $headers = static::$defaultHeaders;

        $apiKey = $this->getApikey();
        if ($apiKey) {
            $headers['Authorization'] = 'Bearer '.$apiKey;
        }

        return array_merge($this->headers, $headers);
    }

    /**
     * Set the headers for this request.
     *
     * @param array $headers
     */
    public function setHeaders(array $headers)
    {
        $this->headers = array_merge($this->headers, $headers);
    }

    /**
     * Set the params for this request.
     *
     * @param array $params
     *
     * @return ApiRequest
     */
    public function setParams(array $params = [])
    {
        $this->params = array_merge($this->params, $params);

        return $this;
    }

    /**
     * Generate and return the params for this request.
     *
     * @return array
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * The API version used for this request.
     *
     * @return string
     */
    public function getApiVersion()
    {
        return $this->apiVersion;
    }

    /**
     * The content type for this request.
     *
     * @return string
     */
    public function getContentType()
    {
        return $this->contentType;
    }
}
