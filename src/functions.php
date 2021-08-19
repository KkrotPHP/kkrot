<?php

if (! function_exists('dump')) {
    function dump($data, $key = '')
    {
        echo "<----------------- $key ---------------------->" . PHP_EOL;
        var_dump($data);
    }
}