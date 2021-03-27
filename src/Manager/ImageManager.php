<?php

namespace Partigen\Manager;

use Partigen\Model\Image;
use Partigen\Model\ImageCreator;

class ImageManager
{
    public static function factoryImageCreator(): ImageCreator
    {
        return new ImageCreator();
    }

    public function generate(): Image
    {
        $imageCreator = self::factoryImageCreator();
        $params = [
            ImageCreator::FORMAT => ImageCreator::FORMAT_A4
        ];
        return $imageCreator->create($params);
    }
}
