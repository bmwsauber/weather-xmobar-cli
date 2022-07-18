<?php

namespace App;

use App\Services\ApiService;
use App\Services\TemplateService;
use Throwable;

class Weather
{
    public function __construct(
        private ApiService $apiService,
        private TemplateService $templateService,
    )
    {
    }
    public function run(): void
    {
        try {
            $weatherArray = $this->apiService->call();
            $this->templateService
                ->prepareTemplate($weatherArray)
                ->write();

            echo "has been written";
        } catch (Throwable $exception) {
            dd($exception->getMessage());
        }
    }
}