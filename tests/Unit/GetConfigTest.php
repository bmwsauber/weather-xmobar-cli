<?php

namespace Unit;

use PHPUnit\Framework\TestCase;

class GetConfigTest extends TestCase
{
    public function test_get_config_from_file_by_key(): void
    {
        $result = config('api.lat');

        self::assertNotNull($result);
    }

    public function test_get_config_default_value(): void
    {
        $result = config('api.lat', 'test_value');

        self::assertNotNull($result);
        self::assertNotEquals('test_value', $result);

        $result = config('api.wrong_param', 'test_value');

        self::assertNotNull($result);
        self::assertEquals('test_value', $result);

        $result = config('wrong_file.wrong_param', 'test_value');

        self::assertNotNull($result);
        self::assertEquals('test_value', $result);
    }
}