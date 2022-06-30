<?php

namespace Feature;

use App\Services\ApiService;
use GuzzleHttp\Exception\GuzzleException;
use JsonException;
use PHPUnit\Framework\TestCase;

class ApiCallTest extends TestCase
{
    /**
     * @throws GuzzleException
     * @throws JsonException
     */
    public function test_api_call(): void
    {
        $weatherArray = $this->apiService->call();

        self::assertArrayHasKey('main', $weatherArray);
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->apiService = app(ApiService::class);
    }
}