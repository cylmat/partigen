<?php

declare(strict_types=1);

namespace Partigen\Library\Model\Block;

use Partigen\Library\Model\Block\Abstracts\AbstractBlock;

class NoteBlock extends AbstractBlock
{
    private const INIT_LEFT_MARGIN_PX = 40;
    private const X_SPACE_PX = 30;

    private const INIT_TOP_MARGIN_PX = 11;
    private const Y_SPACE_PX = 15; // space betweeen lines

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

        // return note html
        $style = "margin-left: ".$x."px; margin-top: ".$y."px;";
        $note = '<div class="'.$this->class.'" style="'.$style.'"></div>'."\n";

        return $note;
    }

    private function getXPlacement(): int
    {
        $x = self::INIT_LEFT_MARGIN_PX + (self::X_SPACE_PX * $this->num);

        return $x;
    }

    private function getYPlacement(): int
    {
        $y = self::INIT_TOP_MARGIN_PX + ($this->interval * self::Y_SPACE_PX / 2);

        return intval($y);
    }
}
