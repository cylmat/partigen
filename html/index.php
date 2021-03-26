<?php

require __DIR__.'/../vendor/autoload.php';

chdir(__DIR__ . '/../src/Resources/');

(new Partigen\App\App)->run();