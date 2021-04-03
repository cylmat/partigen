<?php

use Partigen\Container;
use Partigen\Library\ImageCreator;

require __DIR__.'/../src/bootstrap.php';

$path = Container::getInstance()->get(ImageCreator::class)->create(['format' => 'A4']);

header('Content-Type: image/png');
readfile($path);
unlink($path);
