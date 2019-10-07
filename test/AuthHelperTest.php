<?php
/**
 * Created by PhpStorm.
 * User: Neoson Lam
 * Date: 10/7/2019
 * Time: 9:53 AM.
 */

namespace EastStore\Test;


use EasyStore\AuthHelper;
use EasyStore\Exception\RequiredOptionMissingException;
use EasyStore\Options;
use PHPUnit\Framework\TestCase;

class AuthHelperTest extends TestCase
{
    protected $authHelper;

    protected function setUp(): void
    {
        $this->authHelper = new AuthHelper();
    }

    public function testShouldThrowIfClientIdOptionMissing()
    {
        $this->expectException(RequiredOptionMissingException::class);

        $this->authHelper->createAuthRequest();
    }

    public function testShouldThrowIfScopeOptionMissing()
    {
        $this->expectException(RequiredOptionMissingException::class);
        Options::setOptions(['client_id' => 'xxxxxxxxx']);

        $this->authHelper->createAuthRequest();
    }

    public function testShouldThrowIfRedirectUriOptionMissing()
    {
        $this->expectException(RequiredOptionMissingException::class);
        Options::setOptions(['client_id' => 'xxxxxxxxx', 'scopes' => 'order/create']);

        $this->authHelper->createAuthRequest();
    }

    public function testAbleToCreateAuthRequest()
    {
        Options::setOptions([
            'client_id' => 'xxxxxxxxx',
            'scopes' => 'order/create',
            'redirect_uri' => 'http://example.com',
        ]);

        $requestUrl = $this->authHelper->createAuthRequest();

        $this->assertEquals('https://admin.easystore.co/oauth/authorize?app_id=xxxxxxxxx&scope=order/create&redirect_uri=http://example.com', $requestUrl);
    }
}
