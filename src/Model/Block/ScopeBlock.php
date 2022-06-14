<?php

declare(strict_types=1);

namespace Partigen\Model\Block;

use Partigen\DataValue\ScopeDataInterface;
use Partigen\Model\Params;

class ScopeBlock extends AbstractBlock
{
    private ScopeDataInterface $scopeData;

    public function setScopeData(ScopeDataInterface $scopeData): self
    {
        $this->scopeData = $scopeData;

        return $this;
    }

    public function getType(): string
    {
        return $this->scopeData->getName();
    }

    public function getData(Params $context): array
    {
        return [
            'name' => $this->scopeData->getName(),
            'notes' => $this->get(NotesBlock::class)->setScopeData($this->scopeData)->getData($context)
        ];
    }
}
