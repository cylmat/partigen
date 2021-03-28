<?php

namespace Partigen\Manager;

use Partigen\App\Factory;
use Partigen\Model\Image;
use Partigen\Service\ImageCreatorService;

class ImageManager
{
    /**
     * @var ImageCreatorService
     */
    private $imageCreatorService;

    public function __construct(ImageCreatorService $imageCreatorService)
    {
        $this->imageCreatorService = $imageCreatorService;
        var_dump('alpha');
    }

    public function generate(): Image
    {
        $params = [
            ImageCreatorService::FORMAT => ImageCreatorService::FORMAT_A4
        ];
        
        return $this->imageCreatorService->create($params);
    }
}
