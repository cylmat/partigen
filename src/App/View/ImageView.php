<?php

declare(strict_types=1);

namespace Partigen\App\View;

use Partigen\App\AppModel\Image;

class ImageView
{
    public function render($image): string
    {
        header("Content-type: image/png");
        $content =  $this->getContent($image);
        unlink($image->getFilepath());

        return $content;
    }

    private function getContent($image): string
    {
        if (PHP_SAPI === 'cli') {
            // Used for github actions
            return "Generated image: ".$image->getFilepath()." [ok]\n";
        } else {
            // From server
            if (false !== $content = file_get_contents($image->getFilepath())) {
                return $content;
            } else {
                throw new \RuntimeException("Impossible to get '".$image->getFilepath()."' content");
            }
        }
    }
}