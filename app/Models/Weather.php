<?php
namespace App\Models;

class Weather
{
    private int|float $temperature;
    private string $temperatureColor;
    private string $conditionIcon;
    private string $windDirectionArrow;
    private int|float $humidity;
    private int|float $windSpeed;

    public function getTemperature(): int
    {
        return round($this->temperature);
    }

    public function setTemperature(float|int $temperature): void
    {
        $this->temperature = $temperature;
    }

    public function getTemperatureColor(): string
    {
        return $this->temperatureColor;
    }

    public function setTemperatureColor(string $temperatureColor): void
    {
        $this->temperatureColor = $temperatureColor;
    }

    public function getConditionIcon(): string
    {
        return $this->conditionIcon;
    }

    public function setConditionIcon(string $conditionIcon): void
    {
        $this->conditionIcon = $conditionIcon;
    }

    public function getWindDirectionArrow(): string
    {
        return $this->windDirectionArrow;
    }

    public function setWindDirectionArrow(string $windDirectionArrow): void
    {
        $this->windDirectionArrow = $windDirectionArrow;
    }

    public function getHumidity(): float|int
    {
        return $this->humidity;
    }

    public function setHumidity(float|int $humidity): void
    {
        $this->humidity = $humidity;
    }

    public function getWindSpeed(): int
    {
        return (int)$this->windSpeed;
    }

    public function setWindSpeed(float|int $windSpeed): void
    {
        $this->windSpeed = $windSpeed;
    }
}