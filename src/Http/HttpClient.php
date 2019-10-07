<?php
/**
 * Created by PhpStorm.
 * User: Neoson Lam
 * Date: 10/3/2019
 * Time: 4:41 PM.
 */

namespace EasyStore\Http;


use EasyStore\AuthHelper;
use EasyStore\Exception\ApiException;
use EasyStore\Exception\RequiredOptionMissingException;
use EasyStore\HasOptions;
use EasyStore\Options;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\RequestException;

class HttpClient
{
    use HasOptions;

    protected $httpClient;

    public function __construct($httpClient = null)
    {
        if (!$httpClient) {
            $httpClient = new GuzzleClient([
                'base_uri' => $this->buildBaseUrl(),
                'timeout' => $this->getOptions('timeout')
            ]);
        }

        $this->httpClient = $httpClient;
    }

    protected function buildBaseUrl()
    {
        return 'https://' . $this->getOptions('shop');
    }

    public function makeRequest($endpoint, $method, $body = [], $header = [])
    {
        $request = (new RequestBuilder())
            ->setEndpoint($endpoint)
            ->setMethod($method)
            ->setBody($body)
            ->setHeader($header);

        return $this->setupAuth($request);
    }

    public function send(RequestBuilder $request)
    {
        try {
            $response = $this->httpClient->request(
                $request->getMethod(),
                '/api/' . $this->getOptions('version') . $request->getEndpoint(),
                $request->build()
            );

            return json_decode($response->getBody(), true);
        } catch (RequestException $ex) {
            if ($ex->hasResponse()) {
                throw new ApiException($ex->getResponse()->getBody()->getContents());
            }

            throw new ApiException($ex->getMessage());
        }
    }

    protected function setupAuth(RequestBuilder $request)
    {
        if (!$this->getOptions('access_token')) {
            throw new RequiredOptionMissingException('access token is required');
        }

        $request->setHeader(
            array_merge(
                $request->getHeader(),
                ['easystore-access-token' => $this->getOptions('access_token')]
            )
        );

        return $request;
    }
}
