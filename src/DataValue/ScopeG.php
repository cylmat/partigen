<?php

namespace Partigen\DataValue;

class ScopeG implements ScopeInterface
{
    public const MAX_NOTE = 'C5'; // upper displayable note

    public const BASELINE = 'G3'; //25
    public const BOTTOM_LINE = 'E3';  // used to calculate bottomline - baseline

    public const BOTTOM_CROSS = 'D3'; // min note when other scope is under it
    public const MIN_NOTE = 'G2'; // lower displayable note
}