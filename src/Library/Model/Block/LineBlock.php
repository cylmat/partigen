<?php

namespace Partigen\Library\Model\Block;

class LineBlock extends Abstract\AbstractBlock
{
    public function getHtml(): string
    {
        $line = '<div class="'.$this->class.'"></div>';
        
        return $line;
    }
}
