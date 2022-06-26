<?php

/*
 * Resize Resources notes images
 */
function resize($file, $w, $h=-1): void
{
    $PATH = __DIR__ . '/../resources';

    $image = imagecreatefrompng("$PATH/orig/$file");
    $new = imagescale($image, $w, $h, IMG_BILINEAR_FIXED);
    imagepng($new, "$PATH/img/$file");
}

//resize("sol.png", 30);
//resize("fa.png", 33);

$note = 21;
resize("ronde.png", $note);
resize("rondesplit.png", $note);
resize("split.png", $note);