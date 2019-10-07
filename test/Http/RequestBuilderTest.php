<?php
/**
 * Created by PhpStorm.
 * User: Neoson Lam
 * Date: 10/7/2019
 * Time: 9:44 AM.
 */

namespace EastStore\Test\Http;


use EasyStore\Http\RequestBuilder;
use PHPUnit\Framework\TestCase;

class RequestBuilderTest extends TestCase
{
    protected $requestBuilder;

    protected function setUp(): void
    {
        $this->requestBuilder = new RequestBuilder();
    }

    public function testEndPoint()
    {
        $endpoint = '/example';
        $this->requestBuilder->setEndpoint($endpoint);

        $this->assertEquals($endpoint, $this->requestBuilder->getEndpoint());
    }

    public function testMethod()
    {
        $method = 'post';
        $this->requestBuilder->setMethod($method);

        $this->assertEquals($method, $this->requestBuilder->getMethod());
    }

    public function testHeader()
    {
        $header = ['Content' => 'application/json'];
        $this->requestBuilder->setHeader($header);

        $this->assertEquals($header, $this->requestBuilder->getHeader());
    }

    public function testBody()
    {
        $body = ['shop' => 'shop-name'];
        $this->requestBuilder->setBody($body);

        $this->assertEquals($body, $this->requestBuilder->getBody());
    }
}
