<?php

declare(strict_types=1);

namespace Partigen\App;

use Partigen\Manager\ImageManager;

class App
{
    public function run(): void
    {
        $imageManager = Container()->get(ImageManager::class);
        $vueImage = Container()->get(VueImage::class);

        $image = $imageManager->generate();
        $content = $vueImage->render($image);

        $this->output($content);
    }

    public function output(string $content)
    {
        echo $content;
    }
}