<?php

declare(strict_types=1);

namespace Partigen\Model\Block;

use Partigen\Model\Block\AbstractBlock;

class ScopeBlock extends AbstractBlock
{
    const F = 'F';
    const G = 'G';
    const FG = 'FG';

    private string $name;

    /* Paired with other scope */
    private bool $isPaired = false;

    public function setName(string $name): self
    {
        $this->name = strtoupper($name);
        $this->setClass(strtolower($name));

        return $this;
    }

    public function getName(): string
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
            'class' => $this->class,
            'notes' => [
                //$this->get(NotesBlock::class)->setScope($this)->getData()
            ]
        ];
    }
}
