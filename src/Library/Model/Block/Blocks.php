<?php

namespace Partigen\Library\Model\Block;

class Blocks extends Abstract\AbstractBlock
{
    private $scope;

    public function __construct(ScopeBlock $scope)
    {
        $this->scope = $scope;
        $this->setClass('block');
    }

    public function getHtml(): string
    {
        $block = '<div class="'.$this->class.'">'.
            $this->scope('sol').
            //$scope('fa').
        '</div>';

        return $block;
    }

    private function labelToInterval(string $key) {
        $label = substr($key, 0, 1);
        $num = substr($key, 1, 2);
        $interkey = array_search($label, LABEL) - 4; //G
        $internum = ($num-3) * 7;
        return -($interkey + $internum);
    }

    private function params() {
        return [
            'number' => 24, // number of notes
            'higher' => 'F5', //upper line: -2
            'lower'  => 'F1' //lower line: 8
        ];
    }

    private function random($min, $max) {
        $random_array = [];
        foreach (range(0, mt_rand(300, 500)) as $r) {
            $random_array[] = random_int($min, $max);
        }
        return $random_array[array_rand($random_array)];
    }
}
