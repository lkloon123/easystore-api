<?php
/**
 * Created by PhpStorm.
 * User: Neoson Lam
 * Date: 10/3/2019
 * Time: 5:39 PM.
 */

namespace EasyStore;


use EasyStore\Exception\ApiException;
use EasyStore\Exception\AuthException;
use EasyStore\Exception\RequiredOptionMissingException;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\RequestException;

class AuthHelper
{
    use HasOptions;

    public function createAuthRequest()
    {
        if (!$this->getOptions('client_id')) {
            throw new RequiredOptionMissingException('client_id is required');
        }

        if (!$this->getOptions('scopes')) {
            throw new RequiredOptionMissingException('scopes is required');
        }

        if (!$this->getOptions('redirect_uri')) {
            throw new RequiredOptionMissingException('redirect_uri is required');
        }

        return 'https://admin.easystore.co/oauth/authorize'
            . '?app_id=' . $this->getOptions('client_id')
            . '&scope=' . $this->getOptions('scopes')
            . '&redirect_uri=' . $this->getOptions('redirect_uri');
    }

    public function verifyEasyStoreRequest()
    {
        $data = $_GET;

        if (!isset($data['hmac'])) {
            throw new AuthException('HMAC value not found in url parameters');
        }

        $hmac = $data['hmac'];
        unset($data['hmac']);

        $message = [];
        foreach ($data as $key => $value) {
            $message[] = "$key=$value";
        }
        $message = implode('&', $message);

        $calculatedHmac = hash_hmac('sha256', $message, $this->getOptions('client_secret'));
        return hash_equals($calculatedHmac, $hmac);
    }

    public function getAccessToken()
    {
        if (!$this->getOptions('client_id')) {
            throw new RequiredOptionMissingException('client_id is required');
        }

        if (!$this->getOptions('client_secret')) {
            throw new RequiredOptionMissingException('client_secret is required');
        }

        if (!$this->verifyEasyStoreRequest()) {
            throw new AuthException('this request is not coming from valid easy store');
        }

        try {
            $client = new GuzzleClient();
            $response = $client->post(
                'https://' . $_GET['shop'] . '/api/' . $this->getOptions('version') . '/oauth/access_token',
                [
                    'json' => [
                        'client_id' => $this->getOptions('client_id'),
                        'client_secret' => $this->getOptions('client_secret'),
                        'code' => $_GET['code']
                    ]
                ]
            );

            $response = json_decode($response->getBody(), true);
            return $response['access_token'];
        } catch (RequestException $ex) {
            if ($ex->hasResponse()) {
                throw new ApiException($ex->getResponse()->getBody()->getContents());
            }

            throw new ApiException($ex->getMessage());
        }
    }
}
