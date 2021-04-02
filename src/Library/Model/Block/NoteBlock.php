<?php

declare(strict_types=1);

namespace Partigen\Library\Model\Block;

use Partigen\Library\Model\Block\Abstracts\AbstractBlock;

class NoteBlock extends AbstractBlock
{
    private const INIT_LEFT_MARGIN_PX = 40;
    private const X_SPACE_PX = 30;

    /**
     * @var string
     */
    private $interval;

    /**
     * @var int
     */
    private $num;

    /**
     * @var string
     */
    //private $scopeName;

    public function setNum(int $num): self
    {
        $this->num = $num;
        $this->setClass('note');

        return $this;
    }

    /*public function setScopeName(string $scopeName): self
    {
        $this->scopeName = $scopeName;

        return $this;
    }*/

    public function setInterval(string $interval): self
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
        $x = self::INIT_LEFT_MARGIN_PX + self::X_SPACE_PX * $this->num;

        return $x;
    }

    private function getYPlacement(): int
    {
        $y = self::$INIT_TOP_MARGIN_PX + ($this->interval * self::$Y_SPACE_PX / 2);

        return $y;
    }

    private static $INIT_TOP_MARGIN_PX = 11;
    private static $Y_SPACE_PX = 15; // space betweeen lines
}
