<?php

declare(strict_types=1);

namespace Partigen\Library\Model\Block\Traits;

trait BufferTrait
{
    private $buffer = [];

    private function setBuffer(string $name, string $key, string $value)
    {
        // Buffer
        switch ($this->scopeName) {
            case 'sol': 
                if (array_key_exists($this->bufferInt['labelnum']))
        }
    }

    private function getBuffer(string $name, string $key)
    {

    }
}
