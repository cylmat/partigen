<?php

declare(strict_types=1);

namespace Partigen;

class Display
{
    public function output(string $img): void
    {
        header("Content-type: image/png");
        $this->action($img);
        unlink($img);
        die();
    }

    public function action(string $img)
    {
        if (PHP_SAPI === 'cli') {
            // Used for github actions
            echo "Generated image: $img [ok]\n";
        } else {
            // From server
            readfile($img);
        }
    }
}