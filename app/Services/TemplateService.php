<?php

namespace App\Services;

use App\Models\Weather;


class TemplateService
{
    private Weather $weather;
    private string $template;

    public function prepareTemplate(array $weatherArray): self
    {
        $this->weather = new Weather();

        $this->fillData($weatherArray);
        $this->fillTemplate();

        return $this;
    }

    private function fillData(array $weatherArray): void
    {
        $this->weather->setTemperature(
            $weatherArray['main']['temp']
        );

        $this->weather->setTemperatureColor(
            $this->getColor($weatherArray['main']['temp'])
        );

        $this->weather->setConditionIcon(
            $this->getIcon($weatherArray['weather'][0]['icon'])
        );

        $this->weather->setWindDirectionArrow(
            $this->windDirection($weatherArray['wind']['deg'])
        );

        $this->weather->setHumidity(
            $weatherArray['main']['humidity']
        );

        $this->weather->setWindSpeed(
            $weatherArray['wind']['speed']
        );
    }

    private function getColor(int|float $temperature): string
    {
        $code = match (true) {
            $temperature <= -20 => 'frozen',
            $temperature <= -10 => 'cold',
            $temperature <= 0 => 'zero',
            $temperature >= 30 => 'hot',
            $temperature >= 20 => 'worm',
            $temperature >= 10 => 'normal',
            default => 'zero',
        };

        return config('template.temperature.color.' . $code);
    }

    private function getIcon(string $iconCode): string
    {
        $code = match ($iconCode) {
            '01d' => 'day.clear_sky',
            '02d' => 'day.few_clouds',
            '03d' => 'day.scattered_clouds',
            '04d' => 'day.broken_clouds',
            '09d' => 'day.shower_rain',
            '10d' => 'day.rain',
            '11d' => 'day.thunderstorm',
            '13d' => 'day.snow',
            '50d' => 'day.mist',
            '01n' => 'night.clear_sky',
            '02n' => 'night.few_clouds',
            '03n' => 'night.scattered_clouds',
            '04n' => 'night.broken_clouds',
            '09n' => 'night.shower_rain',
            '10n' => 'night.rain',
            '11n' => 'night.thunderstorm',
            '13n' => 'night.snow',
            '50n' => 'night.mist',
            default => 'night.undefined',
        };

        return config('template.conditions.icons.' . $code);
    }

    private function windDirection(int|float $deg): string
    {
        $direction = match (true) {
            $deg >= 336 || $deg <= 23 => 'N',
            $deg >= 294 => 'NW',
            $deg >= 249 => 'W',
            $deg >= 204 => 'SW',
            $deg >= 159 => 'S',
            $deg >= 114 => 'SE',
            $deg >= 69 => 'E',
            $deg >= 24 => 'NE',
        };

        return config('template.wind.directions.' . $direction);
    }

    private function fillTemplate(): void
    {
        $this->template = sprintf(
            '<fn=1> <fc=%s>%s </fc></fn><fc=%s> %s°C  (<fn=1></fn> %s%%) %s<fn=1>%s </fn></fc>',
            $this->weather->getTemperatureColor(),
            $this->weather->getConditionIcon(),
            $this->weather->getTemperatureColor(),
            $this->weather->getTemperature(),
            $this->weather->getHumidity(),
            $this->weather->getWindSpeed(),
            $this->weather->getWindDirectionArrow(),
        );
    }

    public function write(): void
    {
        $filePath = config('file.output_path');
        file_put_contents($filePath, $this->template);
    }
}