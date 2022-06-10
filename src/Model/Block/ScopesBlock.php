<?php

declare(strict_types=1);

namespace Partigen\Model\Block;

use Partigen\Model\BlockFactory;

class ScopesBlock extends AbstractBlock
{
    private string $type;

    public function __construct(BlockFactory $factory)
    {
        parent::__construct($factory);
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
        $this->type = ScopeBlock::FG;
        return $this;
    }

    public function getData(): array
    {
        switch ($this->type) {
            case ScopeBlock::G: 
                $scopeData = [$this->get(ScopeBlock::class)->setType(ScopeBlock::G)->getData()];
                break;
            case ScopeBlock::F: 
                $scopeData = [$this->get(ScopeBlock::class)->setType(ScopeBlock::F)->getData()];
                break;
            case ScopeBlock::FG:
                $scopeData = [
                    $this->get(ScopeBlock::class)->setType(ScopeBlock::G)->setPaired()->getData(),
                    $this->get(ScopeBlock::class)->setType(ScopeBlock::F)->setPaired()->getData()
                ];
                break;
            default:
                throw new \DomainException("Type " . $this->type . " not handled");
        }

        return $scopeData;
    }
}
