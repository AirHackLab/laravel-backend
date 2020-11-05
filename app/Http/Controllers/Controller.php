<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $client;

    public function __construct()
    {
    }

    public function api($method, $url, $body = null)
    {
        dd(auth()->user());
        $this->client = new \GuzzleHttp\Client([
            // Base URI is used with relative requests
            'base_uri' => env('APP_URL') . '/api/',
            // You can set any number of default request options.
            'timeout' => 30,
            'headers' => [
                'api_token' => auth()->user()
            ]
        ]);
        $options = $body ? ['form_params' => $body] : [];
        $response = $this->client->request($method, $url, $options);
        $response = $this->client->send($response);
        return $response;
    }
}
