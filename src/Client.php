<?php
/**
 * Created by PhpStorm.
 * User: Neoson Lam
 * Date: 10/3/2019
 * Time: 4:37 PM.
 */

namespace EasyStore;


use EasyStore\Http\HttpClient;

class Client
{
    use HasOptions;

    protected $httpClient;

    public function __construct($options = [], $httpClient = null)
    {
        $this->setOptions($options);
        Options::validate();

        $this->httpClient = new HttpClient($httpClient);
    }

    public function get($endpoint, $parameter = [])
    {
        return $this->httpClient->send(
            $this->httpClient->makeRequest($endpoint, 'get', $parameter)
        );
    }

    public function post($endpoint, $body)
    {
        return $this->httpClient->send(
            $this->httpClient->makeRequest($endpoint, 'post', $body)
        );
    }

    public function put($endpoint, $body)
    {
        return $this->httpClient->send(
            $this->httpClient->makeRequest($endpoint, 'put', $body)
        );
    }

    public function delete($endpoint, $body = [])
    {
        return $this->httpClient->send(
            $this->httpClient->makeRequest($endpoint, 'delete', $body)
        );
    }

    public function buildAuthUrl()
    {
        return (new AuthHelper())->createAuthRequest();
    }

    public function getAccessToken()
    {
        return (new AuthHelper())->getAccessToken();
    }

    public function getHttpClient()
    {
        return $this->httpClient;
    }
}
