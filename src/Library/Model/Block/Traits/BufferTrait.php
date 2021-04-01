<?php

declare(strict_types=1);

namespace Partigen\Library\Model\Block\Traits;

trait BufferTrait
{
    private static $buffer = [];

    private function setBuffer(string $name, string $key, $value): self
    {
        $this->buffer[$name][$key] = $value;

        return $this;
    }

    private function getBuffer(string $name, string $key)
    {
        if (!array_key_exists($name, self::$buffer)) {
            return null;
        }

        if (array_key_exists($key, self::$buffer[$name])) {
            return self::$buffer[$name][$key];
        }

        return null;
    }
}
