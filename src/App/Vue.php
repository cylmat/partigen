<?php

declare(strict_types=1);

namespace Partigen\App;

use Partigen\Model\Image;

class Vue
{
    public function output(Image $image): void
    {
        header("Content-type: image/png");
        $this->action($image);
        $image->unlink();
        die();
    }

    private function action(Image $image): void
    {
        if (PHP_SAPI === 'cli') {
            // Used for github actions
            echo "Generated image: ".$image->getPath()." [ok]\n";
        } else {
            // From server
            $imgPath->readfile();
        }
    }
}