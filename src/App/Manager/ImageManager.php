<?php

namespace Partigen\App\Manager;

use Partigen\App\Factory;
use Partigen\Model\Image;
use Partigen\Service\ImageCreator;

class ImageManager
{
    /**
     * @var ImageCreator
     */
    private $imageCreator;

    public function __construct(ImageCreator $imageCreator)
    {
        $this->imageCreator = $imageCreator;
    }

    public function generate(): Image
    {
        $params = [
            ImageCreator::FORMAT => ImageCreator::FORMAT_A4
        ];

        return $this->imageCreator->create($params);
    }
}
