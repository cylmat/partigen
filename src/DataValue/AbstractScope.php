<?php

namespace Partigen\DataValue;

abstract class AbstractScope implements ScopeDataInterface
{
    // max and min notes around scope bottom and top lines
    public const MAX_OUTSIDE_VARIATION = 15; // @todo adjust with params

    protected const NAME = '';
    protected const PAIRED_UPPER = null;
    protected const SCOPELINE = '';
    protected const BASELINE = '';
    protected const PAIRED_LOWER = null;

    public function getName(): string
    {
        return static::NAME;
    }

    public function getPairedUpper(): string
    {
        return static::PAIRED_UPPER ?? 'B8';
    }

    public function getScopeLine(): string
    {
        return static::SCOPELINE;
    }

    public function getBaseline(): string
    {
        return static::BASELINE;
    }

    public function getPairedLower(): string
    {
        return static::PAIRED_LOWER ?? 'C0';
    }
}
