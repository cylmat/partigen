<?php

declare(strict_types=1);

namespace Partigen\App;

use Di\Container as Di_Container;

class Container
{
    private static $container;

    private function __construct() {}

    public static function getInstance()
    {
        return self::$container ?? new Di_Container();
    }
}