<?php

declare(strict_types=1);

namespace Partigen\Library\Model\Block;

use Partigen\Library\Model\Block\Abstracts\AbstractBlock;
use Partigen\Library\Model\Block\Traits\IntervalTrait;

class NotesBlock extends AbstractBlock
{
    use IntervalTrait;

    public const G_BASELINE = 3; //G3
    
    private const NUMBER = 24;

    // G
    private const G_MAX_NOTE = 'C5';
    private const G_MIN_NOTE = 'G2';
    private const G_TOP_LINE = 'F4';
    private const G_BOTTOM_LINE = 'E3';

    // F
    private const F_MAX_NOTE = 'E3';
    private const F_MIN_NOTE = 'C1';
    private const F_TOP_LINE = 'A2';
    private const F_BOTTOM_LINE = 'G1';

    // paired
    private const FG_CROSS_G  = 'D3';
    private const FG_CROSS_F  = 'C3';

    /**
     * @var ScopeBlock
     */
    private $scope;

    public function setScope(ScopeBlock $scope): self
    {
        $this->scope = $scope;
        
        return $this;
    }

    public function getHtml(): string
    {
        $notes = '';
        $count = 0;

        $lower = $this->getHighLowLabels()[0];
        $higher = $this->getHighLowLabels()[1];

        //$random = $this->getRandomizedHigh($lower, $higher);
        $interval = $this->getRandomizedInterval($lower, $higher);
        
        $notes .= $this->get(ChordBlock::class)
            ->setNum($count)
            ->setScopeName($this->scope->getName())
            ->setLower('G3')
            ->setType(ChordBlock::MAJ)
            ->getHtml();
        
        /*for ($i = 0; $i < self::NUMBER; $i++) {
            $notes .= $this->get(NoteBlock::class)
                ->setNum($count++)
                //->setScopeName($this->scope->getName())
                ->setInterval($interval)
                ->getHtml();
        }*/

        return $notes;
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

    private function getRandomizedInterval(string $lowerLabel, string $higherLabel): int
    {
        $lower = $this->labelToInterval($lowerLabel);
        $higher = $this->labelToInterval($higherLabel);
        $interval = $this->random($lower, $higher);
        //$interval = $this->adjustIntervalOnBaseline($interval);

        return $interval;
    }
}
