<?php

function dd($value)
{
    echo "<pre>";
    var_dump($value);
    die();
    echo "</pre>";
}

function urlIs($value)
{
    return  $_SERVER['REQUEST_URI'] === $value;
}
