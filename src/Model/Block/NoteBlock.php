<?php

declare(strict_types=1);

namespace Partigen\Model\Block;

use Partigen\Model\Block\Abstracts\AbstractBlock;

class NoteBlock extends AbstractBlock
{
    private const X_SPACE_PX = 30;
    private const INIT_LEFT_MARGIN_PX = 40;

    private const Y_SPACE_PX = 15; // space betweeen lines
    private const INIT_TOP_MARGIN_PX = 11 + (3*self::Y_SPACE_PX); // init on bottom line

    // Outlines intervales
    private const TOP_LINE = 8;
    private const BOTTOM_LINE = 0;

    // Class name
    private const BASECLASS = 'note';
    private const LINECLASS = 'split';
    private const OUTCLASS = 'notesplit';

    /**
     * @var int
     */
    protected $num;

    /**
     * @var int
     */
    protected $interval;

    /**
     * @var bool
     */
    private $interlinesEnabled = true;

    public function setNum(int $num): self
    {
        $this->num = $num;
        $this->setClass(self::BASECLASS);

        return $this;
    }

    public function setIsInterline(): self
    {
        $this->setClass(self::LINECLASS);

        return $this;
    }

    public function setIsOutline(): self
    {
        $this->setClass(self::OUTCLASS);

        return $this;
    }

    /**
     * Used to display chords and interline itself
     */
    public function disableOutlines(): self
    {
        $this->interlinesEnabled = false;

        return $this;
    }

    /**
     * Interval between baseline and current
     */
    public function setInterval(int $interval): self
    {
        $this->interval = $interval;

        return $this;
    }
    
    public function getHtml(): string
    {
        $x = $this->getXPlacement();
        $y = $this->getYPlacement();
        $this->initOutlineClass();

        // interlines
        $note = $this->getInterlines();
        
        // note html
        $style = "margin-left: ".$x."px; margin-top: ".$y."px;";
        $note .= '<div class="'.$this->class.'" style="'.$style.'"></div>'."\n";

        return $note;
    }

    private function getXPlacement(): int
    {
        $x = self::INIT_LEFT_MARGIN_PX + (self::X_SPACE_PX * $this->num);

        return $x;
    }

    private function getYPlacement(): int
    {
        $y = self::INIT_TOP_MARGIN_PX + (-$this->interval * self::Y_SPACE_PX / 2);

        return intval($y);
    }

    // set outline note if baseclass
    private function initOutlineClass(): void
    {
        // split note if outline
        if ($this->class === self::BASECLASS) {
            if (0 === $this->interval % 2) {
                $this->setIsOutline();
            }
        }
    }

    // interlines in case of outline note
    private function getInterlines(): string
    {
        if (!$this->interlinesEnabled) {
            return '';
        }
        
        // interlines
        $interlines = '';

       if ($this->interval > self::TOP_LINE) {
            // out up
            for ($i=self::TOP_LINE+2; $i<$this->interval; $i+=2) {
                $interlines .= $this->get(NoteBlock::class)
                    ->setNum($this->num)
                    ->setInterval($i)
                    ->setIsInterline()
                    ->disableOutlines(); //avoir recursive outline
            }
        
        } elseif ($this->interval < self::BOTTOM_LINE) {
            // out down
            for ($i=self::BOTTOM_LINE-2; $i>$this->interval; $i-=2) {
                $interlines .= $this->get(NoteBlock::class)
                    ->setNum($this->num)
                    ->setInterval($i)
                    ->setIsInterline()
                    ->disableOutlines();
            }
        } 

        return $interlines;
    }
}
