<?php

namespace Partigen\Manager;

use Partigen\Model\ImageCreator;

class ImageManager
{
    public function generate(): Image
    {
        $imageCreator = new ImageCreator(new Image);
        return $imageCreator->create();
    }

    public function unlink($argument1)
    {
        // TODO: write logic here
    }
}
