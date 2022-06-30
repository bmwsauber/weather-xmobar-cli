<?php

namespace App;

use Throwable;

class Config
{
    public function get(string $key, mixed $default = null): mixed
    {
        $explode = explode('.', $key);

        try {
            $file = array_shift($explode);
            $configFile = include('./config/' . $file . '.php');

            return $this->getParam($explode, $configFile);
        } catch (Throwable $exception) {
            return $default;
        }
    }

    private function getParam(mixed $keys, $config): mixed
    {
        $param = array_shift($keys);

        if (is_array($config[$param])) {
            return $this->getParam($keys, $config[$param]);
        }

        return $config[$param];
    }
}