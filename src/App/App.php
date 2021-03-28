<?php

declare(strict_types=1);

namespace Partigen\App;

use Partigen\Manager\ImageManager;

class App
{
    /**
     * @var ImageManager
     */
    private $imageManager;

    /**
     * @var VueImage
     */
    private $vueImage;

    /*public function __construct(ImageManager $imageManager, VueImage $vueImage)
    {
        $this->imageManager = $imageManager;
        $this->vueImage = $vueImage;
    }*/

    public function __construct()
    {
        Container::getInstance()->get(ImageManager::class);
    }

    public function run(): void
    {
        Container::getInstance()->get(ImageManager::class);

        /*$image = $this->imageManager->generate();
        $content = $this->vueImage->render();

        $this->output($content);*/
    }

    public function output(string $content)
    {
        echo $content;
    }
}