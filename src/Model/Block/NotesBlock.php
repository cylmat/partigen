<?php

declare(strict_types=1);

namespace Partigen\Model\Block;

use Partigen\Model\Block\AbstractBlock;
use Partigen\Model\Block\Traits\IntervalTrait;

class NotesBlock extends AbstractBlock
{
    use IntervalTrait;

    public const G_BASELINE = 3; //G3
    
    private const NUMBER = 24;

    // G
    private const G_MAX_NOTE = 'C5';
    private const G_MIN_NOTE = 'G2';
    
    // F
    private const F_MAX_NOTE = 'E3';
    private const F_MIN_NOTE = 'C1';

    // paired
    private const FG_CROSS_G  = 'D3';
    private const FG_CROSS_F  = 'C3';

    private ScopeBlock $scope;

    public function setScope(ScopeBlock $scope): self
    {
        $this->scope = $scope;
        $this->scopeName = $scope->getName();
        
        return $this;
    }

    public function getData(): array
    {
        $notes = '';

        $lowerLabel = $this->getHighLowLabels()[0];
        $higherLabel = $this->getHighLowLabels()[1];
        
        for ($i = 0; $i < self::NUMBER; $i++) {
            $isNote = rand(0, 10);

            if ($isNote) {
                // Notes
                $randomInterval = $this->getRandomized($lowerLabel, $higherLabel);
                $notes[] = $this->get(NoteBlock::class)
                    ->setNum($i)
                    ->setInterval($this->getInterval($randomInterval))
                    ->getData();
            } else {
                // Chords
                $randomChordInterval = $this->getRandomizedChord($lowerLabel, $higherLabel);
                $notes[] = $this->get(ChordBlock::class)
                    ->setNum($i)
                    ->setBaseInterval($this->getInterval($randomChordInterval))
                    ->setType(ChordBlock::MAJ)
                    ->getData();
            }
        }

        return [
            $notes
        ];
    }

    private function getHighLowLabels(): array
    {
        switch ($this->scope->getName()) {
            case ScopeBlock::G:
                return [
                    $this->scope->isPaired() ? self::FG_CROSS_G : self::G_MIN_NOTE,
                    self::G_MAX_NOTE
                ];
                
            case ScopeBlock::F:
                return [
                    self::F_MIN_NOTE,
                    $this->scope->isPaired() ? self::FG_CROSS_F : self::F_MAX_NOTE
                ];
        }
    }

    private function getRandomized(string $lowerLabel, string $higherLabel): int
    {
        $lower = $this->labelToInterval($lowerLabel);
        $higher = $this->labelToInterval($higherLabel);
        $randomInterval = $this->random($lower, $higher);

        return $randomInterval;
    }

    private function getRandomizedChord(string $lowerLabel, string $higherLabel): int
    {
        $lower = $this->labelToInterval($lowerLabel);
        $higher = $this->labelToInterval($higherLabel) - 4;
        $randomInterval = $this->random($lower, $higher);

        return $randomInterval;
    }

    private function getInterval(int $interval): int
    {
        return $this->adjustIntervalOnBaseline($interval);
    }
}
