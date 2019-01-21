<?php
namespace Chocorail;

use Chocorail\Exceptions\ApiClientException;
use Chocorail\Exceptions\ApiResponseException;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Uri;
use GuzzleHttp\Exception\ClientException;

/**
 * Class ApiClient
 *
 * @package Chocorail
 */
class ApiClient
{
    /**
     * @const string Base API URL. Must end with a slash.
     */
    const BASE_API_URL = 'https://api.chocorail.com/';

    /**
     * @const int The timeout in seconds for a request.
     */
    const DEFAULT_REQUEST_TIMEOUT = 60;

    protected $options = [
        'baseApiUrl' => self::BASE_API_URL,
        'defaultRequestTimeout' => self::DEFAULT_REQUEST_TIMEOUT,
    ];

    /**
     * @var Client HTTP client handler.
     */
    protected $client;

    /**
     * @var int The number of calls that have been made to API.
     */
    public static $requestCount = 0;

    /**
     * Instantiates a new ApiClient object.
     */
    public function __construct(array $options = [])
    {
        $this->options = array_merge($this->options, $options);

        $this->client = new Client();
    }

    /**
     * Returns the base API URL.
     *
     * @return string
     */
    public function getBaseApiUrl()
    {
        return $this->options['baseApiUrl'];
    }

    /**
     * Makes the request to Api and returns the result.
     *
     * @param ApiRequest $request
     *
     * @return ApiResponse
     *
     * @throws ChocorailException
     */
    public function sendRequest(ApiRequest $request)
    {
        if (!$request->getApiKey()) {
            throw new Exception('You must provide an Api key.');
        }

        $apiVersion = $request->getApiVersion();
        $endpoint = $request->getEndpoint();
        $endpoint = strpos($endpoint, '/') === 0 ? $endpoint : '/' . $endpoint;
        $url = new Uri($this->getBaseApiUrl() . $apiVersion . $endpoint);
        $method = $request->getMethod();
        $headers = $request->getHeaders();
        if (getenv('APPLICATION_ENV') == 'development') {
            $headers['debug'] = true;
        }
        $headers['timeout'] = $this->options['defaultRequestTimeout'];
        $headers['connect_timeout'] = 10;
        $params = $request->getParams();

        if ($method == 'POST' || $method == 'PUT' || $method == 'DELETE') {
            // send parameters as Form
            // $multipart = [];
            // foreach ($params as $key => $val) {
            //     if (is_array($val)) {
            //         $valArray = (array)$val;
            //         foreach ($valArray as $valArrayItem) {
            //             $multipart[] = ['name' => (string)$key, 'contents' => (string)$valArrayItem];
            //         }
            //     } else {
            //         $multipart[] = ['name' => (string)$key, 'contents' => (string)$val];
            //     }
            // }
            // $ms = new Psr7\MultipartStream($multipart);
            // $request = new Request($method, $url, $headers, $ms);

            // send parameters as JSON
            $headers['Content-Type'] = 'application/json';
            $rawRequest = new Request($method, $url, $headers, json_encode($params));
        } else {
            // send parameters as Query String
            $qs = \GuzzleHttp\Psr7\build_query($params);
            $rawRequest = new Request($method, $url->withQuery($qs), $headers);
        }

        $http_options = array('http_errors' => false);
        if (getenv('APPLICATION_ENV') == 'development') {
            $http_options['verify'] = false;
        }

        try {
            $rawResponse = $this->client->send($rawRequest, $http_options);
        } catch (ClientException $e) {
            $rawResponse = $e->getResponse();
            throw new ApiClientException('Failed to call chocorail api: url=' . $url . ', res=' . Psr7\str($rawResponse));
        }

        static::$requestCount++;

        $returnResponse = new ApiResponse(
            $request,
            $rawResponse->getBody()->getContents(),
            $rawResponse->getStatusCode(),
            $rawResponse->getHeaders()
        );

        if ($returnResponse->isError()) {
            throw new ApiResponseException($returnResponse);
        }

        return $returnResponse;
    }
}
