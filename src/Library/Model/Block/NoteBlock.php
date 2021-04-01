<?php

declare(strict_types=1);

namespace Partigen\Library\Model\Block;

use Partigen\Library\Model\Block\Abstracts\AbstractBlock;
use Partigen\Library\Model\Block\Traits\IntervalTrait;

class NoteBlock extends AbstractBlock
{
    use IntervalTrait;

    private const INIT_LEFT_MARGIN_PX = 40;
    private const X_SPACE_PX = 30;

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
    private $customHigher;

    /**
     * @var string
     */
    private $customLower;

    /**
     * @var int
     */
    private $num;

    /**
     * @var string
     */
    private $scopeName;

    public function setNum(int $num): self
    {
        $this->num = $num;
        $this->setClass('note');

        return $this;
    }

    public function setScopeName(string $scopeName): self
    {
        $this->scopeName = $scopeName;

        return $this;
    }

    public function setHigher(string $customHigher): self
    {
        $this->customHigher = $customHigher;

        return $this;
    }

    public function setLower(string $customLower): self
    {
        $this->customLower = $customLower;

        return $this;
    }

    public function getHtml(): string
    {
        $x = $this->getXPlacement();
        $y = $this->getRandomizedHigh();

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

    private function getRandomizedHigh(): int
    {
        switch ($this->scopeName) {
            case self::G:
                $higher = $this->labelToInterval(self::G_MAX_NOTE);
                $lower = $this->labelToInterval(self::G_MIN_NOTE);
                break;
            case self::F:
                $higher = $this->labelToInterval(self::F_MAX_NOTE);
                $lower = $this->labelToInterval(self::F_MIN_NOTE);
                break;
        }
        
        $random = $this->random($lower, $higher);
        $y = $this->intervalToPlacement($random);

        return intval($y);
    }
}
