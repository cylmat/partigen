<?php

namespace tests\Partigen;

use Partigen\Container;
use Partigen\ImageCreator;

require __DIR__.'/../src/bootstrap.php';

$path = Container::getInstance()->get(ImageCreator::class)->create(['format' => 'A4']);

if (file_exists($path)) {
    unlink($path);
} else {
    throw new \Exception("Image not generated!");
}
