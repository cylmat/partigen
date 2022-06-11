<?php

namespace Partigen\DataValue;

class ScopeF implements ScopeInterface
{
    public const MAX_NOTE = 'E3'; // upper displayable note
    public const UPPER_CROSS = 'C3'; // max note when other scope is upper it

    public const BASELINE = 'F2'; //17
    public const BOTTOM_LINE = 'G1'; // used to calculate bottomline - baseline

    public const MIN_NOTE = 'C1'; // lower displayable note
}