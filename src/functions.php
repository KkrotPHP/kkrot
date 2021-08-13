<?php

if (! function_exists('dump')) {
    function dump($var){
        var_dump($var);
        echo PHP_EOL;
    }
}