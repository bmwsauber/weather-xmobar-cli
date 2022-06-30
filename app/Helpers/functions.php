<?php

use App\Config;
use Illuminate\Container\Container;
use Illuminate\Contracts\Container\BindingResolutionException;

if (!function_exists('dd')) {
    function dd(...$vars)
    {
        foreach ($vars as $v) {
            print_r($v);
        }

        exit(1);
    }
}

if (!function_exists('dump')) {
    /**
     * @author Nicolas Grekas <p@tchwork.com>
     */
    function dump($var, ...$moreVars)
    {
        print_r($var);

        foreach ($moreVars as $v) {
            print_r($v);
        }

        if (1 < func_num_args()) {
            return func_get_args();
        }

        return $var;
    }
}

if (! function_exists('app')) {
    /**
     * @throws BindingResolutionException
     */
    function app($abstract = null, array $parameters = []): mixed
    {
        if (is_null($abstract)) {
            return Container::getInstance();
        }

        return Container::getInstance()->make($abstract, $parameters);
    }
}


if (!function_exists('config')) {
    function config($key = null, $default = null)
    {
        return app(Config::class)->get($key, $default);
    }
}
