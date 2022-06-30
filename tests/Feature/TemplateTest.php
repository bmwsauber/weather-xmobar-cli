<?php

namespace Feature;

use App\Services\TemplateService;
use PHPUnit\Framework\TestCase;
use ReflectionException;
use ReflectionMethod;

class TemplateTest extends TestCase
{
    /**
     * @throws ReflectionException
     */
    public function test_prepare_color_from_temperature_data(): void
    {
        $method = new ReflectionMethod(TemplateService::class, "getColor");
        $method->setAccessible(true);

        $frozen = $method->invokeArgs(new TemplateService(), [-24]);
        self::assertEquals(config('temperature.color.frozen'), $frozen);

        $cold = $method->invokeArgs(new TemplateService(), [-10]);
        self::assertEquals(config('temperature.color.cold'), $cold);

        $zero = $method->invokeArgs(new TemplateService(), [2]);
        self::assertEquals(config('temperature.color.zero'), $zero);

        $normal = $method->invokeArgs(new TemplateService(), [15]);
        self::assertEquals(config('temperature.color.normal'), $normal);

        $worm = $method->invokeArgs(new TemplateService(), [22]);
        self::assertEquals(config('temperature.color.worm'), $worm);

        $hot = $method->invokeArgs(new TemplateService(), [30]);
        self::assertEquals(config('temperature.color.hot'), $hot);
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->weatherArray = [
            'coord' =>
                [
                    'lon' => 36.2387,
                    'lat' => 49.9951,
                ],
            'weather' =>
                [
                    0 =>
                        [
                            'id' => 500,
                            'main' => 'Rain',
                            'description' => 'light rain',
                            'icon' => '10d',
                        ],
                ],
            'base' => 'stations',
            'main' =>
                [
                    'temp' => 25.62,
                    'feels_like' => 25.49,
                    'temp_min' => 25.62,
                    'temp_max' => 25.62,
                    'pressure' => 1016,
                    'humidity' => 48,
                    'sea_level' => 1016,
                    'grnd_level' => 1001,
                ],
            'visibility' => 10000,
            'wind' =>
                [
                    'speed' => 0.91,
                    'deg' => 51,
                    'gust' => 1.23,
                ],
            'rain' =>
                [
                    '1h' => 0.13,
                ],
            'clouds' =>
                [
                    'all' => 61,
                ],
            'dt' => 1656588234,
            'sys' =>
                [
                    'country' => 'UA',
                    'sunrise' => 1656552553,
                    'sunset' => 1656611270,
                ],
            'timezone' => 10800,
            'id' => 706483,
            'name' => 'Kharkiv',
            'cod' => 200,
        ];
    }
}