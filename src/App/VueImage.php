<?php

declare(strict_types=1);

namespace Partigen\App;

use Partigen\Manager\ImageManager;

class VueImage implements VueInterface
{
    private $imageManager;

    public function __construct(ImageManager $imageManager)
    {
        $this->imageManager = $imageManager;
    }

    public function output(): void
    {
        header("Content-type: image/png");
        $this->action();
        $this->imageManager->getImage()->unlink();
        die();
    }

    private function action(): void
    {
        if (PHP_SAPI === 'cli') {
            // Used for github actions
            echo "Generated image: ".$this->imageManager->getImage()->getPath()." [ok]\n";
        } else {
            // From server
            $this->image->readfile();
        }
    }
}