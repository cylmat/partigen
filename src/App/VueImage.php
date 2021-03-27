<?php

declare(strict_types=1);

namespace Partigen\App;

use Partigen\Model\Image;

class VueImage implements VueInterface
{
    private $image;

    public function __construct(Image $image)
    {
        $this->image = $image;
    }

    public function output(): void
    {
        header("Content-type: image/png");
        $this->action();
        unlink($this->image->getFilepath());
        die();
    }

    private function action(): void
    {
        if (PHP_SAPI === 'cli') {
            // Used for github actions
            echo "Generated image: ".$this->image->getFilepath()." [ok]\n";
        } else {
            // From server
            readfile($this->image->getFilepath());
        }
    }
}