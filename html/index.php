<?php

namespace tests\Partigen;

use DI\Container;
use Partigen\ImageCreator;

require __DIR__.'/../src/bootstrap.php';

$path = (new Container())->get(ImageCreator::class)->create(['format' => 'A4']);

if (file_exists($path)) {
    header('Content-Type: image/png');
    readfile($path);
    unlink($path);
} else {
    throw new \Exception("Image not generated!");
}
