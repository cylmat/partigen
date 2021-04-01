<?php

namespace Partigen\App\Manager;

use Model\Image;
use Partigen\Library\ImageCreator;

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
