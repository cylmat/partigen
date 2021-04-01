<?php

namespace Partigen\Library\Model\Block;

class ScopeBlock extends Abstract\AbstractBlock
{
    private $notes;

    private $line;

    public function __construct(NotesBlock $notes, LineBlock $line)
    {
        $this->notes = $notes;
        $this->line = $line;
    }

    public function getHtml(): string
    {
        $scope = '<div class="'.$this->class.'">'.
            $this->notes($this->class).
            $this->line().
        '</div>';

        return $scope;
    }
}
