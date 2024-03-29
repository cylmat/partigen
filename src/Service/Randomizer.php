<?php

namespace Partigen\Service;

final class Randomizer
{
    public function getScope(array $scopeChoices): string
    {
        return \array_rand(\array_flip($scopeChoices));
    }

    /**
     * Is chord or simple note
     *
     * For $chordFrequency = 0, return always false
     * For $chordFrequency = 50, return 50% true or false
     * For $chordFrequency = 100, return always true
     */
    public function isChord(int $chordFrequency): bool
    {
        if ($chordFrequency < 0 || 100 < $chordFrequency) {
            throw new \OutOfBoundsException("Chord frequency must be inside 0 and 100");
        }

        return !(rand(0, 99) >= $chordFrequency);
    }

    public function getNoteHigh(int $min, int $max): int
    {
        return rand($min, $max);
    }
}
