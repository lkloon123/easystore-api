<?php
/**
 * Created by PhpStorm.
 * User: Neoson Lam
 * Date: 10/3/2019
 * Time: 4:58 PM.
 */

namespace EasyStore\Http;


class RequestBuilder
{
    protected $endpoint;
    protected $method;
    protected $header;
    protected $body;

    /**
     * @return mixed
     */
    public function getEndpoint()
    {
        return $this->endpoint;
    }

    /**
     * @param mixed $endpoint
     * @return RequestBuilder
     */
    public function setEndpoint($endpoint)
    {
        $this->endpoint = $endpoint;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @param mixed $method
     * @return RequestBuilder
     */
    public function setMethod($method)
    {
        $this->method = $method;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getHeader()
    {
        return $this->header;
    }

    /**
     * @param mixed $header
     * @return RequestBuilder
     */
    public function setHeader($header)
    {
        $this->header = $header;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param mixed $body
     * @return RequestBuilder
     */
    public function setBody($body)
    {
        $this->body = $body;
        return $this;
    }

    public function build()
    {
        $options = [
            'headers' => $this->header
        ];

        if (strtolower($this->method) === 'get') {
            $options['query'] = $this->body;
        } else {
            $options['json'] = $this->body;
        }

        return $options;
    }
}
