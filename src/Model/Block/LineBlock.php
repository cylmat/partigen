<?php

declare(strict_types=1);

namespace Partigen\Model\Block;

use Partigen\Model\Block\AbstractBlock;
use Partigen\Model\BlockFactory;

class LineBlock extends AbstractBlock
{
    public function __construct(BlockFactory $factory)
    {
        parent::__construct($factory);
        $this->setClass('line');
    }

    public function getHtml(): string
    {
        $line = '<div class="'.$this->class.'"></div>'."\n";
        
        return $line;
    }
}
