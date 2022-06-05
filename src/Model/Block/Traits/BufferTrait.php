<?php

declare(strict_types=1);

namespace Partigen\Model\Block\Traits;

trait BufferTrait
{
    private static bool $USE_BUFFER = false;
    private static array $buffer = [];

    private function setBuffer(string $name, string $key, $value): self
    {
        self::$buffer[$name][$key] = $value;

        return $this;
    }

    private function getBuffer(string $name, string $key): ?string
    {
        if (!self::$USE_BUFFER) {
            return null;
        }

        if (!array_key_exists($name, self::$buffer)) {
            return null;
        }

        if (array_key_exists($key, self::$buffer[$name])) {
            return self::$buffer[$name][$key];
        }

        return null;
    }
}
