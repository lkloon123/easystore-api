# Easystore Api
[![Latest Stable Version](https://img.shields.io/packagist/v/neoson/easystore-api.svg)](https://packagist.org/packages/neoson/easystore-api)
[![Build Status](https://img.shields.io/travis/com/neoson/easystore-api.svg)](https://travis-ci.com/neoson/easystore-api)
[![StyleCI](https://github.styleci.io/repos/213284724/shield?branch=master)](https://github.styleci.io/repos/213284724)
[![License](https://img.shields.io/packagist/l/neoson/easystore-api.svg)](https://packagist.org/packages/neoson/easystore-api)
[![Total Downloads](https://img.shields.io/packagist/dt/neoson/easystore-api.svg)](https://packagist.org/packages/neoson/easystore-api)

A simple php wrapper for [Easystore Api](https://developers.easystore.co/)
 
## Installation
```bash
composer require neoson/easystore-api
```

## Usage

Setup Options
```php
\EasyStore\Options::setOptions([
    'shop' => 'YOUR SHOP NAME', // required option
    'access_token' => 'YOUR ACCESS TOKEN', // required option for protected endpoint
    'version' => '1.0', // default value
    'timeout' => 15, // default value
]);
```

Create a `\EasyStore\Client` object
```php
$client = new \EasyStore\Client();
```

## Client Method

Get
```php
$client->get($endpoint, $parameter = [])
```

Post
```php
$client->post($endpoint, $body)
```

Put
```php
$client->put($endpoint, $body)
```

Delete
```php
$client->delete($endpoint, $body = [])
```

Arguments

|Params|Type|Description|
|---|---|---|
|`endpoint`|`string`|Easystore API endpoint, refer [Easytore Docs](https://developers.easystore.co/docs/api/getting-started)
|`body`|`array`|body will be converted to JSON
|`parameter`|`array`|parameter will be converted to query string

## Access Token
Create an OAuth Request

```php
// setup required options
\EasyStore\Options::setOptions([
    'shop' => 'YOUR SHOP NAME', 
    'client_id' => 'YOUR CLIENT ID',
    'scopes' => 'YOUR SCOPES', 
    'redirect_uri' => 'YOUR REDIRECT URL', 
]);

$requestUrl = $client->buildAuthUrl();

// if you are using laravel
return response()->redirect($requestUrl);
```

Exchange for permanent access token after oauth completed

```php
// setup required options
\EasyStore\Options::setOptions([
    'shop' => 'YOUR SHOP NAME', 
    'client_id' => 'YOUR CLIENT ID',
    'client_secret' => 'YOUR CLIENT SECRET',
]);

$accessToken = $client->getAccessToken();
//store this access token somewhere
```

## Contributing

If you want to contribute to a project and make it better, your help is very welcome. Just send a pr and you are all set.

## License

This library is released under the [MIT License](LICENSE)
