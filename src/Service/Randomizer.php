<?php

namespace Partigen\Service;

class Randomizer
{
    /**
     * For $chordFrequency = 0, return always true
     * For $chordFrequency = 50, return 50% true or false
     * For $chordFrequency = 100, return always false
     */
    public function isNoteOrChord(int $chordFrequency): bool
    {
        if ($chordFrequency < 0 || 100 < $chordFrequency) {
            return \OutOfBoundsException("Chord frequency must be inside 0 and 100");
        }
      
        return rand(0, 99) >= $chordFrequency;
    }
  
    public function getNoteHigh(int $min, int $max): int
    {
        return rand($min, $max);
    }
}
