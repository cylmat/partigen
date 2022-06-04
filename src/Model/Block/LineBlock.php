<?php

declare(strict_types=1);

namespace Partigen\Model\Block;

use Partigen\Model\Block\Abstracts\AbstractBlock;

class LineBlock extends AbstractBlock
{
    public function __construct()
    {
        $this->setClass('line');
    }

    public function getHtml(): string
    {
        $line = '<div class="'.$this->class.'"></div>'."\n";
        
        return $line;
    }
}
