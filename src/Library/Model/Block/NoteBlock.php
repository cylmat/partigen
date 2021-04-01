<?php

declare(strict_types=1);

namespace Partigen\Library\Model\Block;

use Partigen\Library\Model\Block\Abstracts\AbstractBlock;

class NoteBlock extends AbstractBlock
{
    private const INIT_LEFT_MARGIN_PX = 40;
    private const INIT_TOP_MARGIN_PX = 11;
    private const X_SPACE_PX = 30;
    private const Y_SPACE_PX = 15; // space betweeen lines

    private const LABEL = ['C', 'D', 'E', 'F', 'G', 'A', 'B'];
    private const G_HIGHER_LINE = 'F4';
    private const G_LOWER_LINE = 'E3';
    private const F_HIGHER_LINE = 'A2';
    private const F_LOWER_LINE = 'F1';

    private const HIGHER = 'F5'; 
    private const LOWER  = 'F1';

    /**
     * @var int
     */
    private $num;

    /**
     * @var string
     */
    private $scopeName;

    public function __construct()
    {
        $this->setClass('note'); //default
    }

    public function setNum(int $num): self
    {
        $this->num = $num;

        return $this;
    }

    public function setScopeName(string $scopeName): self
    {
        $this->scopeName = $scopeName;

        return $this;
    }

    public function getHtml(): string
    {
        $x = $this->getXPlacement();
        $y = $this->getYBaseline();
        $this->setClassFromYPlace($y);

        // return note html
        $style = "margin-left: ".$x."px; margin-top: ".$y."px;";
        $note = '<div class="'.$this->class.'" style="'.$style.'"></div>';

        return $note;
    }

    private function getXPlacement(): int
    {
        $x = self::INIT_LEFT_MARGIN_PX + self::X_SPACE_PX * $this->num;

        return $x;
    }

    private function getYBaseline(): int
    {
        $higher = $this->labelToInterval(self::HIGHER);
        $lower = $this->labelToInterval(self::LOWER);
        //$level = $this->labelToInterval('G3'); //$this->random($higher, $lower);
        $y = $this->labelToPlacement('F2');

        return intval($y);
    }

    private function setClassFromYPlace(int $y): void
    {
        // for up and down OUT of lines
        switch($this->scopeName) {
            /* G */
            case 'sol': 
                if ($y < self::Y_SPACE_PX * $this->labelToInterval('C3')) {
                    // outline up
                    //$this->class = 'split';
                } elseif ($y > $this->labelToInterval(self::G_LOWER_LINE)) {
                    // outline down
                    //$this->class = ''; //no display
                }
                break;

            /* F */
            case 'fa': // already on F line
                if ($y < self::Y_SPACE_PX * 4) {
                    // outline up
                    //$class = ''; //no display
                } elseif ($y > self::Y_SPACE_PX * 8) {
                    // outline down
                    //$class = 'notesplit';
                }
                break;
        }
    }

    /**
     * Interval from G3 for scope G
     *   ex: A3 => 1
     * Interval from F2 for scope F
     *   ex: A2 => 2
     */
    private function labelToInterval(string $labelnum): int
    {
        $G_PLACE = 4;

        $label = substr($labelnum, 0, 1);
        $num = substr($labelnum, 1, 2);
        $interkey = array_search($label, self::LABEL) - $G_PLACE;

        switch ($this->scopeName) {
            case 'fa': 
                $interkey += 8;
        }

        $internum = ($num-3) * 7;
        return $interkey + $internum;
    }

    /**
     * ex: G3 to A3 => -7px
     */
    private function labelToPlacement(string $labelnum): int
    {
        $interval = -$this->labelToInterval($labelnum); //interval-style to pixels-style
        
        // set baseline
        switch ($this->scopeName) { 
            case 'sol': 
                $interval += 6; 
                break;
        }
        $y = self::INIT_TOP_MARGIN_PX + ($interval * self::Y_SPACE_PX / 2);

        return intval($y);
    }

    private function random($min, $max): int 
    {
        $random_array = [];
        foreach (range(0, mt_rand(300, 500)) as $r) {
            $random_array[] = random_int($min, $max);
        }
        return $random_array[array_rand($random_array)];
    }
}
