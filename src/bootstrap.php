<?php

require __DIR__.'/../vendor/autoload.php';

function Container() {
    return Partigen\App\Container::getInstance();
}

function resize($file, $w, $h=-1)
{
    $image = imagecreatefrompng("orig/$file");
    $new = imagescale ( $image, $w, $h, IMG_BILINEAR_FIXED );
    imagepng($new, "img/$file");
}

if ('cli' === PHP_SAPI) {
    resize("sol.png", 30);
    resize("fa.png", 33);
    resize("ronde.png", 22);
    resize("rondesplit.png", 22);
    resize("split.png", 22);
}
