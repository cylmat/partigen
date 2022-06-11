<?php

declare(strict_types=1);

namespace Partigen\Model\Block;

class NotesBlock extends AbstractBlock
{
    public const G_BASELINE = 'G3'; //25
    public const F_BASELINE = 'F2'; //17
    
    private const NUMBERS_ON_A_LINE = 8;

    // G
    private const G_MAX_NOTE = 'C5';
    private const G_MIN_NOTE = 'G2';
    
    // F
    private const F_MAX_NOTE = 'E3';
    private const F_MIN_NOTE = 'C1';

    // paired
    private const FG_CROSS_G  = 'D3';
    private const FG_CROSS_F  = 'C3';

    private static $labelTable = [];

    private ScopeBlock $scope;

    public function __construct()
    {
        self::getLabelTable();
    }

    public function setScope(ScopeBlock $scope): self
    {
        $this->scope = $scope;

        return $this;
    }

    public function getData(): array
    {
        $notes = [];

        for ($i = 0; $i < self::NUMBERS_ON_A_LINE; $i++) {
            $isNote = 1;

            if ($isNote) {
                // Notes
                $notes[] = [
                    'highs' => $this->getRandomizedNoteFromBaseline('C2', 'C6'),
                    //$this->get(NoteBlock::class)
                    //->setNum($i)
                    //->setInterval($this->getInterval($randomInterval))
                    //    ->getData()
                ];
            } /*else {
                // Chords
                $randomChordInterval = $this->getRandomizedChord($lowerLabel, $higherLabel);
                $notes[] = [
                    'num' => $i,
                    'high' => $this->get(ChordBlock::class)
                    //->setNum($i)
                    //->setBaseInterval($this->getInterval($randomChordInterval))
                    //->setType(ChordBlock::MAJ)
                    ->getData()
                ];
            }*/
        }

        return $notes;
    }

    /**
     * Return integer from baseline
     *  e.g. in G scope, 0 will be G, -1 will be A#, etc...
     * 
     * @param string|int $customMaxDiff Can be a string (e.g. 'C5'), or a difference (e.g. 5)
     * @param string|int $customMinDiff Can be a string (e.g. 'C2'), or a difference (e.g. -5)
     */
    private function getRandomizedNoteFromBaseline($customMinDiff, $customMaxDiff): array
    {
        if (\is_string($customMaxDiff)) {
            $customMaxDiff = $this->diffLabelWithBaseline($customMaxDiff);
        }

        if (\is_string($customMinDiff)) {
            $customMinDiff = $this->diffLabelWithBaseline($customMinDiff);
        }

        [$scopeMinDiff, $scopeMaxDiff] = $this->getScopeBoundDiff();

        $max = min($scopeMaxDiff, $customMaxDiff);
        $min = max($scopeMinDiff, $customMinDiff);

        return rand($min, $max);
    }

    /**
     * Difference from baseline and label 
     *  (e.g. G3 <=> B3 will be 2)
     */
    private function diffLabelWithBaseline(string $label): int
    {
        switch ($this->scope->getType()) {
            case ScopeBlock::G:
                $baseline = self::$labelTable[self::G_BASELINE];
                break;
            case ScopeBlock::F:
                $baseline = self::$labelTable[self::F_BASELINE];
                break;
            default:
                throw new \RuntimeException("Scope type '".$this->scope->getType() . "' not allowed");
        }

        return -($baseline - self::$labelTable[$label]);
    }

    /**
     * Give maximum difference for current scope
     *  e.g. For scope G, baseline is G3, min bound is G2
     *  so min diff will be -7
     */
    private function getScopeBoundDiff(): array
    {
        switch ($this->scope->getType()) {
            case ScopeBlock::G:
                $maxLabel = self::G_MAX_NOTE;
                $minLabel = $this->scope->isPaired() ? self::FG_CROSS_G : self::G_MIN_NOTE;
                break;
            case ScopeBlock::F:
                $maxLabel = $this->scope->isPaired() ? self::FG_CROSS_F : self::F_MAX_NOTE;
                $minLabel = self::F_MIN_NOTE;
                break;
            default:
                throw new \RuntimeException("Scope type '".$this->scope->getType() . "' not allowed");
        }

        return [
            $this->diffLabelWithBaseline($minLabel),
            $this->diffLabelWithBaseline($maxLabel),
        ];
    }

    /**
     * Return ['A0' => 0, 'A1' => 1, ...]
     */
    private static function getLabelTable(): array
    {
        if (!empty(self::$labelTable)) {
            return self::$labelTable;
        }

        $count = 0;
        for ($h=0; $h<=7; $h++) {
            foreach (['C', 'D', 'E', 'F', 'G', 'A', 'B'] as $a) {
                self::$labelTable[$a.$h] = $count++;
            }
        }

        return self::$labelTable;
    }

    /*private function getRandomizedChord(string $lowerLabel, string $higherLabel): int
    {
        $lower = $this->labelToInterval($lowerLabel);
        $higher = $this->labelToInterval($higherLabel) - 4;
        $randomInterval = $this->random($lower, $higher);

        return $randomInterval;
    }*/
}
