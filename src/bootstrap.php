<?php

require __DIR__.'/../vendor/autoload.php';

function resize($file, $w, $h=-1)
{
    $image = imagecreatefrompng(__DIR__."/Resources/orig/$file");
    $new = imagescale ( $image, $w, $h, IMG_BILINEAR_FIXED );
    imagepng($new, __DIR__."/Resources/img/$file");
}

if ('cli' === PHP_SAPI) {
    resize("sol.png", 30);
    resize("fa.png", 33);
    resize("ronde.png", 22);
    resize("rondesplit.png", 22);
    resize("split.png", 22);
}
