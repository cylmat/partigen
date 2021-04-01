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

    /**
     * @var string
     */
    private $higher;

    /**
     * @var string
     */
    private $lower;

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

    public function setHigher(string $higher): self
    {
        $this->higher = $higher;

        return $this;
    }

    public function setLower(string $lower): self
    {
        $this->lower = $lower;

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
        $lower = $this->labelToInterval($this->lower);
        $higher = $this->labelToInterval($this->higher);

        $random = $this->random($lower, $higher);
        $y = $this->intervalToPlacement($random);

        return intval($y);
    }
}
