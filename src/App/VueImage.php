<?php

declare(strict_types=1);

namespace Partigen\App;

use Partigen\Model\Image;

class VueImage
{
    private $image;

    public function __construct(Image $image)
    {
        $this->image = $image;
    }

    public function render(): string
    {
        header("Content-type: image/png");
        $content =  $this->getContent();
        unlink($this->image->getFilepath());

        return $content;
    }

    private function getContent(): string
    {
        if (PHP_SAPI === 'cli') {
            // Used for github actions
            return "Generated image: ".$this->image->getFilepath()." [ok]\n";
        } else {
            // From server
            if (false !== $content = file_get_contents($this->image->getFilepath())) {
                return $content;
            } else {
                throw new \RuntimeException("Impossible to get '".$this->image->getFilepath()."' content");
            }
        }
    }
}