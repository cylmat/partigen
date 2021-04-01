<?php

declare(strict_types=1);

namespace Partigen\Library\Model\Block;

use Partigen\Library\Model\Block\Abstracts\AbstractBlock;

class ScopeBlock extends AbstractBlock
{
    private $notes;
    private $lines;

    private $name;

    public function __construct(NotesBlock $notes, LinesBlock $lines)
    {
        $this->notes = $notes;
        $this->lines = $lines;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        $this->setClass($name);

        return $this;
    }

    public function getHtml(): string
    {
        $scope = '<div class="'.$this->class.'">'.
            $this->notes->setScopeName($this->name).
            $this->lines.
        '</div>'."\n";

        return $scope;
    }
}
