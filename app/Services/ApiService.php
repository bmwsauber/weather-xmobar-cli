<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use JsonException;

class ApiService
{
    /**
     * @throws GuzzleException
     * @throws JsonException
     */
    public function call(): array
    {
        $client = new Client();

        $responseJson = $client->get(config('api.endpoint'), [
            'query' => [
                'lat' => config('api.lat'),
                'lon' => config('api.lon'),
                'appid' => config('api.key'),
                'units' => config('api.units'),
            ],
        ])->getBody()->getContents();

        return json_decode($responseJson, true, 512, JSON_THROW_ON_ERROR);
    }
}