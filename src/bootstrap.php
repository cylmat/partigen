<?php

require __DIR__.'/../vendor/autoload.php';

chdir(__DIR__ . '/Resources/');

function Container() {
    return Partigen\App\Container::getInstance();
}

/*
$file = 'sol.png';
$image = imagecreatefrompng ("orig/$file");
$new = imagescale ( $image, 30, -1, IMG_BILINEAR_FIXED );
imagepng($new, "$file");

$file = 'fa.png';
$image = imagecreatefrompng ("orig/$file");
$new = imagescale ( $image, 33, -1, IMG_BILINEAR_FIXED );
imagepng($new, "$file");
*/
