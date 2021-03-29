<?php

require __DIR__.'/../vendor/autoload.php';

chdir(__DIR__ . '/Resources/');

function Container() {
    return Partigen\App\Container::getInstance();
}

function resize($file, $w, $h=-1)
{
    $file = 'sol.png';
    $image = imagecreatefrompng ("orig/$file");
    $new = imagescale ( $image, 30, -1, IMG_BILINEAR_FIXED );
    imagepng($new, "img/$file");
}

resize("sol.png", 30);
resize("fa.png", 33);
resize("ronde.png", 20);
