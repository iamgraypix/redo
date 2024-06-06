<?php

use Illuminate\Support\Collection;

const BASE_PATH = __DIR__ . '../../';
require BASE_PATH . '/vendor/autoload.php';

$numbers = new Collection([1, 2, 3, 4, 5, 6, 7, 7, 9, 10]);

$lessThanFive = $numbers->filter(function ($num) {
    return $num < 5;
});

die($lestThanFive);
