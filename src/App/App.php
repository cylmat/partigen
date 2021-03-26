<?php

declare(strict_types=1);

namespace Partigen\App;

use Partigen\Manager\ImageManager;

class App
{
    public function run(): void
    {
        $imageManager = new ImageManager();
        $image = $imageManager->generate();
        
        $vueImage = new VueImage($image);
        $vueImage->output();
    }
}