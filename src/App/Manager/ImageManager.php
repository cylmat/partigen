<?php

declare(strict_types=1);

namespace Partigen\App\Manager;

use Partigen\App\Model\Image;
use Partigen\Library\ImageCreator;

class ImageManager
{
    /**
     * @var ImageCreator
     */
    private $imageCreator;

    /**
     * @var Image
     */
    private $image;

    public function __construct(ImageCreator $imageCreator, Image $image)
    {
        $this->imageCreator = $imageCreator;
        $this->image = $image;
    }

    public function generate(): Image
    {
        $params = [
            ImageCreator::FORMAT => ImageCreator::FORMAT_A4
        ];
        $imgPath = $this->imageCreator->create($params);
        $image = $this->image->setFilepath($imgPath)->setFormat('A4');

        return $image;
    }
}
