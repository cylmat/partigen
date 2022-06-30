<?php

namespace Partigen\DataValue;

abstract class AbstractScope implements ScopeDataInterface
{
    // max and min notes around scope bottom and top lines
    public const MAX_OUTSIDE_VARIATION = 4;

    protected const NAME = '';
    protected const SCOPELINE = '';
    protected const BASELINE = '';

    public function getName(): string
    {
        return static::NAME;
    }

    public function getScopeLine(): string
    {
        return static::SCOPELINE;
    }

    public function getBaseline(): string
    {
        return static::BASELINE;
    }
}
