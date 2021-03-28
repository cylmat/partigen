<?php

declare(strict_types=1);

namespace Partigen\App;

use Partigen\Model\Image;

class AppFactory
{
    public static function vueImage(Image $image): VueImage
    {
        return new VueImage($image);
    }
}