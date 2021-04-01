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

    private const HIGHER = 'G5'; 
    private const LOWER  = 'G3';

    private static $buffer = [];

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
        $y = $this->getRandomizedHigh();
        $this->setClassFromYPlace($y);

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
        $higher = $this->labelToInterval(self::HIGHER);
        $lower = $this->labelToInterval(self::LOWER);
        $random = $this->random($lower, $higher);
        $y = $this->intervalToPlacement($random);

        return intval($y);
    }

    private function setClassFromYPlace(int $y): void
    {
        // for up and down OUT of lines
        switch($this->scopeName) {
            /* G */
            case 'sol': 
                if ($y < $this->labelToPlacement('C3')) {
                    // outline up
                    $this->class = 'split';
                } elseif ($y > $this->labelToInterval(self::G_LOWER_LINE)) {
                    // outline down
                    //$this->class = ''; //no display
                }
                break;

            /* F */
            case 'fa': // already on F line
                $this->class = 'split';
                if ($y < self::Y_SPACE_PX * 4) {
                    // outline up
                    //$this->class = ''; //no display
                } elseif ($y > self::Y_SPACE_PX * 8) {
                    // outline down
                    //$this->class = 'notesplit';
                }
                break;
        }
    }

    private function labelToPlacement(string $labelnum): int
    {
        return $this->intervalToPlacement($this->labelToInterval($labelnum));
    }
    
    /**
     * Interval from G3 for scope G
     *   ex: A3 => 1
     * Interval from F2 for scope F
     *   ex: A2 => 2
     */
    private function labelToInterval(string $labelnum): int
    {
        $BUFFER_KEY  = $this->scope.'int';
        if ($buffer = $this->getBuffer($BUFFER_KEY, $labelnum)) {
            return $buffer;
        } 

        $G_PLACE = 4;
        $label = substr($labelnum, 0, 1);
        $num = substr($labelnum, 1, 2);
        $interkey = array_search($label, self::LABEL) - $G_PLACE;

        switch ($this->scopeName) {
            case 'fa': 
                $interkey += 8;
        }

        $internum = ($num-3) * 7;
        $interval = $interkey + $internum;
        $this->setBuffer($BUFFER_KEY, $labelnum, $interval);
        return $interval;
    }

    /**
     * ex: -1 will be => -7px
     */
    private function intervalToPlacement(int $interval): int
    {
        $BUFFER_KEY  = $this->scope.'place';
        if ($buffer = $this->getBuffer($BUFFER_KEY, strval($interval))) {
            return $buffer;
        } 

        $interval = -$interval;

        // set pixel baseline
        switch ($this->scopeName) { 
            case 'sol': 
                $interval += 6;
                break;
        }

        // set pixel placement
        $y = self::INIT_TOP_MARGIN_PX + ($interval * self::Y_SPACE_PX / 2);

        $this->setBuffer($BUFFER_KEY, strval($interval), $y);
        return intval($y);
    }

    private function random($min, $max): int 
    {
        $random_array = [];
        foreach (range(0, mt_rand(300, 500)) as $r) {
            $random_array[] = random_int($min, $max);
        }
        return $this->a++;
        return $random_array[array_rand($random_array)];
    }
    private $a=-10;

    /**
     * BUFFER
     */
    private function setBuffer(string $name, string $key, $value): self
    {
        $this->buffer[$name][$key] = $value;

        return $this;
    }

    private function getBuffer(string $name, string $key)
    {
        if (!array_key_exists($name, self::$buffer)) {
            return null;
        }

        if (array_key_exists($key, self::$buffer[$name])) {
            return self::$buffer[$name][$key];
        }

        return null;
    }
}
