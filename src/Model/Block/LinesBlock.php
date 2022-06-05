<?php

declare(strict_types=1);

namespace Partigen\Model\Block;

use Partigen\Model\Block\AbstractBlock;
use Partigen\Model\BlockFactory;

class LinesBlock extends AbstractBlock
{
    private LineBlock $line;

    public function __construct(BlockFactory $factory, LineBlock $line)
    {
        parent::__construct($factory);
        $this->line = $line;
    }

    public function getHtml(): string
    {
        $lines=[]; 
        foreach(range(0, 4) as $l) {
            $lines[] = $this->line;
        }

        return join('', $lines);
    }
}
