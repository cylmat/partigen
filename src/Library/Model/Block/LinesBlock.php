<?php

namespace Partigen\Library\Model\Block;

class LinesBlock extends Abstract\AbstractBlock
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
