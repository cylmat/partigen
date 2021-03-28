<?php

namespace Partigen\Manager;

use Partigen\Model\ModelFactory;
use Partigen\Model\Image;
use Partigen\Model\ImageCreator;

class ImageManager
{
    public function generate(): Image
    {
        $imageCreator = ModelFactory::imageCreator();
        $params = [
            ImageCreator::FORMAT => ImageCreator::FORMAT_A4
        ];
        
        return $imageCreator->create($params);
    }
}
