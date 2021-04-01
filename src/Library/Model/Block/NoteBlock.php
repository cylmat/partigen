<?php

namespace Partigen\Library\Model\Block;

class NoteBlock extends Abstract\AbstractBlock
{
    private const INIT_LEFT_MARGIN_PX = 40;
    private const INIT_TOP_MARGIN_PX = 11;
    private const X_SPACE_PX = 30;
    private const Y_SPACE_PX = 15; //-15 to 60

    private const LABEL = ['C', 'D', 'E', 'F', 'G', 'A', 'B'];
    private const higher = 'F5'; //upper line: -2
    private const lower  = 'F1'; //lower line: 8

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

        return $this;
    }

    public function setScopeName(string $scopeName): self
    {
        $this->scopeName = $scopeName;

        return $this;
    }

    public function getHtml(): string
    {
        // X
        $x = self::INIT_LEFT_MARGIN_PX + self::X_SPACE_PX * $this->num;

        // Y
        $higher = $this->labelToInterval(self::higher);
        $lower = $this->labelToInterval(self::lower);

        $level = $this->random($higher, $lower);
        $y = self::INIT_TOP_MARGIN_PX + (self::Y_SPACE_PX * $level / 2);

        // for up and down OUT of lines
        switch($this->scopeName) {
            /**
             * G
             */
            case 'sol': 
                $class = 'note'; 
                $y += self::Y_SPACE_PX * 3; // init on G line

                // outline
                if ($y < -2 * self::Y_SPACE_PX) {
                    //$class = 'notesplit';
                } elseif ($y > self::Y_SPACE_PX * 4) {
                    //$class = ''; //no display
                }
                break;

            /**
             * F
             */
            case 'fa': // already on F line
                $class = 'note'; 
                $y -= self::Y_SPACE_PX / 2; // cause labelToInterval is set on G

                // outline
                if ($y < self::Y_SPACE_PX * 4) {
                    //$class = ''; //no display
                } elseif ($y > self::Y_SPACE_PX * 8) {
                    //$class = 'notesplit';
                }
                break;

            default:
                $class = 'note';
        }

        // return note html
        $style = "margin-left: ".$x."px; margin-top: ".$y."px;";
        $note = '<div class="'.$class.'" style="'.$style.'"></div>';

        return $note;
    }

    private function labelToInterval(string $key) {
        $label = substr($key, 0, 1);
        $num = substr($key, 1, 2);
        $interkey = array_search($label, self::LABEL) - 4; //G
        $internum = ($num-3) * 7;
        return -($interkey + $internum);
    }

    private function random($min, $max) {
        $random_array = [];
        foreach (range(0, mt_rand(300, 500)) as $r) {
            $random_array[] = random_int($min, $max);
        }
        return $random_array[array_rand($random_array)];
    }
}
