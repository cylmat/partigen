<?php

declare(strict_types=1);

namespace Partigen\Model\Block;

use Partigen\Model\Block\Abstracts\AbstractBlock;

class ScopeBlock extends AbstractBlock
{
    const F = 'F';
    const G = 'G';
    const FG = 'FG';

    /**
     * @var string
     */
    private $name;

    /**
     * @var bool
     * 
     * Paired with other scope
     */
    private $isPaired = false;

    public function setName(string $name): self
    {
        $this->name = strtoupper($name);
        $this->setClass(strtolower($name).'-scope');

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

    public function getHtml(): string
    {
        $scope = '<div class="'.$this->class.'">'.
            $this->get(NotesBlock::class)->setScope($this).
            $this->get(LinesBlock::class).
        '</div>'."\n";

        return $scope;
    }
}
