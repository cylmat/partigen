<?php

declare(strict_types=1);

namespace Partigen\Model\Block;

use Partigen\Model\Block\AbstractBlock;

class NoteBlock extends AbstractBlock
{
    private const TOP_LINE = 8;
    private const BOTTOM_LINE = 0;

    protected int $num;
    protected int $interval;
    private bool $interlinesEnabled = true;

    public function setNum(int $num): self
    {
        $this->num = $num;
        return $this;
    }

    // Used to display chords and interline itself
    /*public function disableOutlines(): self
    {
        $this->interlinesEnabled = false;
        re*turn $this;
    }*/

    // Interval between baseline and current
    public function setInterval(int $interval): self
    {
        $this->interval = $interval;
        return $this;
    }
    
    public function getData(): array
    {
        $x = $this->num;
        $y = $this->interval;
        //$note = $this->getInterlines();
        
        return [
            'left' => $x,
            'top' => $y,
            //'note' => $note
        ];
    }

    // interlines in case of outline note
    /*private function getInterlines(): string
    {
        $interlines = '';

        if ($this->interval > self::TOP_LINE) {
            // out up
            for ($i=self::TOP_LINE+2; $i<$this->interval; $i+=2) {
                $interlines .= $this->get(NoteBlock::class)
                    ->setNum($this->num)
                    ->disableOutlines(); //avoir recursive outline
            }
        
        } elseif ($this->interval < self::BOTTOM_LINE) {
            // out down
            for ($i=self::BOTTOM_LINE-2; $i>$this->interval; $i-=2) {
                $interlines .= $this->get(NoteBlock::class)
                    ->setNum($this->num)
                    ->disableOutlines();
            }
        } 

        return $interlines;
    }*/
}
