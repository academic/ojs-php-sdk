<?php

namespace Ojs;

use Ojs\Exceptions\OjsSDKException;
use GuzzleHttp\Client;

/**
 * Class Ojs
 * @package Ojs
 */
class Ojs
{
    /**
     * @const string Version number of the Facebook PHP SDK.
     */
    const VERSION = '1.0.0';

    /**
     * @const string The name of the environment variable that contains the app ID.
     */
    const APP_ID_ENV_NAME = 'OJS_APP_ID';

    /**
     * @var string
     */
    protected $apiKey = null;

    /**
     * @var string
     */
    protected $apiBaseUri = null;

    /**
     * @var
     */
    protected $guzzleClient;

    /**
     * Ojs constructor.
     * @param $apiKey
     * @param $apiBaseUri
     *
     * @throws OjsSDKException
     */
    public function __construct($apiKey, $apiBaseUri)
    {
        $this->apiKey = $apiKey;
        $this->apiBaseUri = $apiBaseUri;
        if(empty($this->apiKey) || empty($this->apiBaseUri)){
            throw new OjsSDKException;
        }
        $this->guzzleClient = new Client([
            'base_uri' => $this->apiBaseUri,
        ]);

        return $this;
    }

    /**
     * Sends a GET request to Graph and returns the result.
     *
     * @param $endpoint
     * @param array $params
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function get($endpoint, array $params = [])
    {
        return $this->sendRequest(
            'GET',
            $endpoint,
            $params
        );
    }

    /**
     * Sends a POST request to Graph and returns the result.
     *
     * @param $endpoint
     * @param array $params
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function post($endpoint, array $params = [])
    {
        return $this->sendRequest(
            'POST',
            $endpoint,
            $params
        );
    }

    /**
     * Sends a DELETE request to Graph and returns the result.
     *
     * @param $endpoint
     * @param array $params
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function delete($endpoint, array $params = [])
    {
        return $this->sendRequest(
            'DELETE',
            $endpoint,
            $params
        );
    }

    /**
     * Sends a PATCH request to Graph and returns the result.
     *
     * @param $endpoint
     * @param array $params
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function patch($endpoint, array $params = [])
    {
        return $this->sendRequest(
            'PATCH',
            $endpoint,
            $params
        );
    }

    /**
     * Sends a PUT request to Graph and returns the result.
     *
     * @param $endpoint
     * @param array $params
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function put($endpoint, array $params = [])
    {
        return $this->sendRequest(
            'PUT',
            $endpoint,
            $params
        );
    }

    /**
     * Sends a request to Graph and returns the result.
     *
     * @param $method
     * @param $endpoint
     * @param array $params
     * @return mixed|\Psr\Http\Message\ResponseInterface
     */
    public function sendRequest($method, $endpoint, array $params = [])
    {
        return $this->guzzleClient->request(
            $method,
            $endpoint,
            [
                'json' => $params,
                'headers' => [
                    'Content-Type'     => 'application/json',
                ]
            ]
        );
    }
}