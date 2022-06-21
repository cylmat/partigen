<?php

declare(strict_types=1);

namespace Partigen\Model\Block;

use Partigen\Model\Block\Abstracts\AbstractBlock;

class Block extends AbstractBlock
{
    private string $type;

    public function __construct()
    {
        $this->setClass('block');
    }

    public function g(): self
    {
        $this->type = ScopeBlock::G;

        return $this;
    }

    public function f(): self
    {
        $this->type = ScopeBlock::F;

        return $this;
    }

    public function fg(): self
    {
        $this->type = ScopeBlock::F.ScopeBlock::G;

        return $this;
    }

    public function getHtml(): string
    {
        switch ($this->type) {
            case ScopeBlock::G: 
                $type = $this->get(ScopeBlock::class)->setName(ScopeBlock::G);
                break;
            case ScopeBlock::F: 
                $type = $this->get(ScopeBlock::class)->setName(ScopeBlock::F);
                break;
            case ScopeBlock::F.ScopeBlock::G: 
                $type = $this->get(ScopeBlock::class)->setName(ScopeBlock::G)->setPaired().
                    $this->get(ScopeBlock::class)->setName(ScopeBlock::F)->setPaired();
                break;
        }

        $block = '<div class="'.$this->class.'">'.$type.'</div>'."\n";

        return $block;
    }
}
