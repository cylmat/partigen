<?php

declare(strict_types=1);

namespace Partigen\Model\Block;

use Partigen\DataValue\ScopeDataInterface;

class ScopeBlock extends AbstractBlock
{
    private ScopeDataInterface $scopeData;

    /* Paired with other scope */
    private bool $isPaired = false;

    public function setScopeData(ScopeDataInterface $scopeData): self
    {
        $this->scopeData = $scopeData;

        return $this;
    }

    public function getType(): string
    {
        return $this->scopeData->getName();
    }

    public function setPaired(): self
    {
        $this->isPaired = true;

        return $this;
    }

    public function isPaired(): bool
    {
        return $this->isPaired;
    }

    public function getData(): array
    {
        return [
            'name' => $this->scopeData->getName(),
            'paired' => $this->isPaired(),
            'notes' => $this->get(NotesBlock::class)->setScopeData($this->scopeData)->getData()
        ];
    }
}
