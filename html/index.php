<?php

namespace tests\Partigen;

use Partigen\ImageCreator;

\array_map(fn(string $keyValue) => putenv($keyValue), explode("\n", 
    \file_exists($file = __DIR__.'/../.env') ? file_get_contents($file) : []
));

ini_set('display_errors', getenv('DISPLAY_ERRORS') ?: 'off');
error_reporting(getenv('ERROR_REPORTING') ?: 0);

require __DIR__.'/../vendor/autoload.php';

ImageCreator::generate($_GET)->display();