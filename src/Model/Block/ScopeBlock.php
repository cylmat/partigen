<?php

declare(strict_types=1);

namespace Partigen\Model\Block;

/**
 * @todo create ScopeDataValue 
 */
class ScopeBlock extends AbstractBlock
{
    public const F = 'F';
    public const G = 'G';
    public const FG = 'FG';

    private string $name;

    /* Paired with other scope */
    private bool $isPaired = false;

    public function setType(string $name): self
    {
        $this->name = strtoupper($name);
        //$this->setClass(strtolower($name));

        return $this;
    }

    public function getType(): string
    {
        return $this->name;
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
            'type' => $this->name,
            'paired' => $this->isPaired(),
            'notes' => $this->get(NotesBlock::class)->setScope($this)->getData()
        ];
    }
}
