<?php

declare(strict_types=1);

namespace Partigen\Library\Model\Block;

use Partigen\Library\Model\Block\Abstracts\AbstractBlock;
use Partigen\Library\Model\Block\Traits\IntervalTrait;

class NotesBlock extends AbstractBlock
{
    private $note;

    private const NUMBER = 24;

    private const F = 'F';
    private const G = 'G';
    private const FG = 'FG';

    private const G_BASELINE = 'G3';
    private const G_TOP_LINE = 'F4';
    private const G_BOTTOM_LINE = 'E3';
    private const G_MAX_NOTE = 'C5';
    private const G_MIN_NOTE = 'C2';

    private const F_BASELINE = 'F2';
    private const F_TOP_LINE = 'A2';
    private const F_BOTTOM_LINE = 'G1';
    private const F_MAX_NOTE = 'F4';
    private const F_MIN_NOTE = 'C1';

    private const FG_CROSS  = 'C2';

    /**
     * @var string
     */
    private $scopeName;

    function __construct(NoteBlock $note)
    {
        $this->note = $note;
    }

    public function setScopeName(string $scopeName): self
    {
        $this->scopeName = strtoupper($scopeName);
        
        return $this;
    }

    public function getHtml(): string
    {
        $notes = '';
        $count = 0;

        $low = $this->getHighLowLabels()[0];
        $high = $this->getHighLowLabels()[1];
        
        for ($i = 0; $i < self::NUMBER; $i++) {
            $notes .= (clone $this->note)
                ->setNum($count++)
                ->setScopeName($this->scopeName)
                ->setLower($low)
                ->setHigher($high)
                ->getHtml();
        }

        return $notes;
    }

    private function getHighLowLabels(): array
    {
        switch ($this->scopeName) {
            case self::G:
                return [
                    self::G_MIN_NOTE,
                    self::G_MAX_NOTE
                ];
                
            case self::F:
                return [
                    self::F_MIN_NOTE,
                    self::F_MAX_NOTE
                ];
        }
    }
}
