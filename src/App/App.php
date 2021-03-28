<?php

declare(strict_types=1);

namespace Partigen\App;

use Partigen\Manager\ManagerFactory;

class App
{
    public function run(): void
    {
        $imageManager = ManagerFactory::imageManager();
        $image = $imageManager->generate();
        
        $vueImage = AppFactory::vueImage($image);
        $content = $vueImage->render();

        $this->output($content);
    }

    public function output(string $content)
    {
        echo $content;
    }
}