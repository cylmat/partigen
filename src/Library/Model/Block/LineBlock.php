<?php

declare(strict_types=1);

namespace Partigen\Library\Model\Block;

use Partigen\Library\Model\Block\Abstracts\AbstractBlock;

class LineBlock extends AbstractBlock
{
    public function __construct()
    {
        $this->setClass('line');
    }

    public function getHtml(): string
    {
        $line = '<div class="'.$this->class.'"></div>';
        
        return $line;
    }
}
