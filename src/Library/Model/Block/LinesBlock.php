<?php

declare(strict_types=1);

namespace Partigen\Library\Model\Block;

use Partigen\Library\Model\Block\Abstracts\AbstractBlock;

class LinesBlock extends AbstractBlock
{
    private $line;

    public function __construct(LineBlock $line)
    {
        $this->line = $line;
    }

    public function getHtml(): string
    {
        $lines=[]; 
        foreach(range(0, 5) as $l) {
            $lines[] = $this->line;
        }

        return join('', $lines);
    }
}
