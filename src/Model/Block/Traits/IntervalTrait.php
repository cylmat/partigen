<?php

declare(strict_types=1);

namespace Partigen\Model\Block\Traits;

use Partigen\Model\Block\NotesBlock;
use Partigen\Model\Block\ScopeBlock;

trait IntervalTrait
{
    use BufferTrait;

    private static $LABEL = ['C', 'D', 'E', 'F', 'G', 'A', 'B'];

    /**
     * @var string
     */
    private $scopeName;

    public function setScopeName(string $scopeName): self
    {
        $this->scopeName = $scopeName;

        return $this;
    }

    /**
     * Interval from G3 for scope G
     *   ex: A3 => 1
     * Interval from F2 for scope F
     *   ex: A2 => 2
     */
    private function labelToInterval(string $labelnum): int
    {
        $BUFFER_KEY  = $this->scopeName.'int';
        if ($buffer = $this->getBuffer($BUFFER_KEY, $labelnum)) {
            return $buffer;
        } 

        $this->checkScopeName();

        $G_PLACE = 4;
        $label = substr($labelnum, 0, 1);
        $num = substr($labelnum, 1, 2);
        $interkey = array_search($label, self::$LABEL) - $G_PLACE;

        switch ($this->scopeName) {
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
        $this->checkScopeName();

        // set pixel baseline
        switch ($this->scopeName) { 
            case ScopeBlock::G:
                $interval += 2; // G pixel lines is on default at 2th line
                break;
            case ScopeBlock::F:
                $interval += 6; // G pixel lines is on default at 4th line
                break;
        }

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

    private function checkScopeName()
    {
        if (!$this->scopeName) {
            throw new \Exception("Scope name must be set");
        }
    }
}