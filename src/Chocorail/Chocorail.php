<?php
namespace Chocorail;

class Chocorail
{
    /**
     * @const string Version number of the Chocorail PHP SDK.
     */
    const VERSION = '1.0.0';

    /**
     * @const string Default API version for requests.
     */
    const DEFAULT_API_VERSION = 'v1';

    protected $options = [
        'baseApiUrl' => ApiClient::BASE_API_URL,
        'defaultRequestTimeout' => ApiClient::DEFAULT_REQUEST_TIMEOUT,
		'defaultApiKey' => '',
		'defaultApiVersion' => self::DEFAULT_API_VERSION,
		'originSlug' => '',
		'urlSignatureKey' => '',
		'urlSignatureKeyVersion' => 1,
        'debug_mode' => true,
    ];

    /**
     * @var ApiClient The Http client
     */
    protected $client;

    /**
     * @var ShopPages The ShopPages interface
     */
    public $shopPages;

    /**
     * @var ShopPages The Images interface
     */
    public $images;

    public function __construct(array $options = [])
    {
        $this->options = array_merge($this->options, $options);

        $this->client = new ApiClient([
            'baseApiUrl' => $this->options['baseApiUrl'],
            'defaultRequestTimeout' => $this->options['defaultRequestTimeout'],
        ]);

        $this->defaultApiVersion = $this->options['defaultApiVersion'];

        $this->shopPages = new ShopPages($this);
        $this->images = new Images($this, $this->options);
    }

    /**
     * Sends a GET request to API and returns the result.
     *
     * @param string                  $endpoint
     * @param array                   $params
     *
     * @return ApiResponse
     *
     * @throws ChocorailException
     */
    public function get(string $endpoint, array $params = [])
    {
        return $this->sendRequest(
            'GET',
            $endpoint,
            $params);
    }

    /**
     * Sends a POST request to API and returns the result.
     *
     * @param string                  $endpoint
     * @param array                   $params
     *
     * @return ApiResponse
     *
     * @throws ChocorailException
     */
    public function post($endpoint, array $params = [])
    {
        return $this->sendRequest(
            'POST',
            $endpoint,
            $params);
    }

    /**
     * Sends a PUT request to API and returns the result.
     *
     * @param string                  $endpoint
     * @param array                   $params
     *
     * @return ApiResponse
     *
     * @throws ChocorailException
     */
    public function put($endpoint, array $params = [])
    {
        return $this->sendRequest(
            'PUT',
            $endpoint,
            $params);
    }

    /**
     * Sends a DELETE request to API and returns the result.
     *
     * @param string                  $endpoint
     * @param array                   $params
     *
     * @return ApiResponse
     *
     * @throws ChocorailException
     */
    public function delete($endpoint, array $params = [])
    {
        return $this->sendRequest(
            'DELETE',
            $endpoint,
            $params);
    }

    /**
     * Sends a request to API and returns the result.
     *
     * @param string                  $method
     * @param string                  $endpoint
     * @param array                   $params
     * @param string|null             $apikey
     * @param string|null             $apiVersion
     *
     * @return ApiResponse
     *
     * @throws ChocorailException
     */
    public function sendRequest($method, $endpoint, array $params = [], string $apikey = null, $apiVersion = null)
    {
        $apikey = $apikey ?: $this->options['defaultApiKey'];
        $apiVersion = $apiVersion ?: $this->defaultApiVersion;
        $request = new ApiRequest(
            $apikey,
            $method,
            $endpoint,
            $params,
            $apiVersion
        );
        return $this->lastResponse = $this->client->sendRequest($request);
    }
}
