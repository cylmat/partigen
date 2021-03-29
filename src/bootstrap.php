<?php

require __DIR__.'/../vendor/autoload.php';

chdir(__DIR__ . '/Resources/');

function Container() {
    return Partigen\App\Container::getInstance();
}