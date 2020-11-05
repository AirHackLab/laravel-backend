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
        $this->client = new \GuzzleHttp\Client([
            // Base URI is used with relative requests
            'base_uri' => env('APP_URL') . '/api/',
            // You can set any number of default request options.
            'timeout' => 30,
            'headers' => [
                'Authorization' => 'Bearer '.auth()->user()->api_token
            ]
        ]);
        $options = $body ? ['form_params' => $body] : [];
        $response = $this->client->request($method, $url, $options);
        dd((string) $response->getBody());
        return json_encode($response->getBody());
    }
}
