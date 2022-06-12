<?php

namespace Partigen\DataValue;

abstract class AbstractScope implements ScopeDataInterface
{
    public function getName(): string
    {
        return static::NAME;
    }

    public function getMaxNote(): string
    {
        return static::MAX_NOTE;
    }

    public function getScopeLine(): string
    {
        return static::SCOPE_LINE;
    }

    public function getBaseline(): string
    {
        return static::BASELINE;
    }

    public function getMinNote(): string
    {
        return static::MIN_NOTE;
    }
}