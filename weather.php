#!/usr/bin/php
<?php
require __DIR__.'/vendor/autoload.php';

use App\Weather;

try {
    app(Weather::class)->run();
} catch (Throwable $exception) {
    echo 'Error - ' . $exception->getMessage();
}


