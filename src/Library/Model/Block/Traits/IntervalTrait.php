<?php

declare(strict_types=1);

namespace Partigen\Library\Model\Block\Traits;

use Partigen\Library\Model\Block\NotesBlock;
use Partigen\Library\Model\Block\ScopeBlock;

trait IntervalTrait
{
    use BufferTrait;

    private static $LABEL = ['C', 'D', 'E', 'F', 'G', 'A', 'B'];

    //private static $INIT_TOP_MARGIN_PX = 11;
    //private static $Y_SPACE_PX = 15; // space betweeen lines

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
        $BUFFER_KEY  = $this->scope->getName().'int';
        if ($buffer = $this->getBuffer($BUFFER_KEY, $labelnum)) {
            return $buffer;
        } 

        $G_PLACE = 4;
        $label = substr($labelnum, 0, 1);
        $num = substr($labelnum, 1, 2);
        $interkey = array_search($label, self::$LABEL) - $G_PLACE;

        switch ($this->scope->getName()) {
            case ScopeBlock::F: 
                $interkey += 8; //F2 to G3 is 8
        }

        $internum = ($num - NotesBlock::G_BASELINE) * 7;
        $interval = $interkey + $internum;
        $this->setBuffer($BUFFER_KEY, $labelnum, $interval);
        return $interval;
    }

    /**
     * ex: -1 will be => -7px
     */
    private function adjustIntervalOnBaseline(int $interval): int
    {
        $BUFFER_KEY  = $this->scope.'place';
        if ($buffer = $this->getBuffer($BUFFER_KEY, strval($interval))) {
            return $buffer;
        }

        $interval = -$interval;

        if (!$this->scopeName) {
            throw new \Exception("Scope name must be set");
        }

        // set pixel baseline
        switch ($this->scopeName) { 
            case ScopeBlock::G: 
                $interval += 4; // G pixel lines is on default at 4th line
                break;
        }

        // set pixel placement
        //$y = self::$INIT_TOP_MARGIN_PX + ($interval * self::$Y_SPACE_PX / 2);

        $this->setBuffer($BUFFER_KEY, 'interval', strval($interval)); //, $y);
        return $interval;
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