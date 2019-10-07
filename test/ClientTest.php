<?php
/**
 * Created by PhpStorm.
 * User: Neoson Lam
 * Date: 10/7/2019
 * Time: 9:33 AM.
 */

namespace EastStore\Test;


use EasyStore\Client;
use EasyStore\Exception\RequiredOptionMissingException;
use EasyStore\Http\HttpClient;
use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
{
    public function testHttpClientInstanceOfHttpClient()
    {
        $client = new Client(['shop' => 'test shop']);

        $this->assertInstanceOf(HttpClient::class, $client->getHttpClient());
    }

    public function testShouldThrowIfShopOptionMissing()
    {
        $this->expectException(RequiredOptionMissingException::class);

        new Client();
    }
}
