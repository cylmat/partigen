<?php

declare(strict_types=1);

namespace Partigen\Service;

/**
 * Baseline is the bottom line of scope
 */
final class Baseline
{
    private static $labelTable = [];

    /**
     * Difference from baseline and label
     *  (e.g. G3 <=> B3 will be 2)
     */
    public static function diffLabelWithBaseline(string $label, string $baseline): int
    {
        self::initOnceLabelTable();
        return -(self::$labelTable[$baseline] - self::$labelTable[$label]);
    }

    /**
     * Init ['A0' => 0, 'A1' => 1, ...]
     */
    private static function initOnceLabelTable(): void
    {
        $count = 0;
        for ($h = 0; $h <= 8; $h++) {
            foreach (['C', 'D', 'E', 'F', 'G', 'A', 'B'] as $a) {
                self::$labelTable[$a . $h] = $count++;
            }
        }
    }
}
