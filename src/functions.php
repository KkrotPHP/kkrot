<?php

if (! function_exists('dump')) {
    function dump($data, $key = '')
    {
        echo "<----------------- $key ---------------------->" . PHP_EOL;
        var_dump($data);
    }
}

if (! function_exists('make')) {
    function make(string $name, array $parameters = [])
    {
        $parameters = array_values($parameters);
        return new $name(...$parameters);
    }
}