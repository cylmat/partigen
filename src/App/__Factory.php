<?php

declare(strict_types=1);

namespace Partigen\App;

use Partigen\Manager\ImageManager;
use Partigen\Model\Image;
use Partigen\Service\ImageCreatorService;

class Factory
{
    /**
     * App
     */
    public static function vueImage(Image $image): VueImage
    {
        return new VueImage($image);
    }

    /**
     * Manager
     */
    public static function imageManager(): ImageManager
    {
        return new ImageManager();
    }

    /**
     * Model
     */
    public static function image(): Image
    {
        return new Image();
    }
    
    public static function imageCreatorService(): ImageCreatorService
    {
        return new ImageCreatorService();
    }
}