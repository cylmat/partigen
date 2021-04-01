<?php

namespace Partigen\Library\Model\Block;

class NotesBlock extends Abstract\AbstractBlock
{
    private $note;

    private const NUMBER = 24;

    /**
     * @var string
     */
    private $scopeName;

    function __construct(NoteBlock $note)
    {
        $this->note = $note;
    }

    public function setScopeName(string $scopeName): self
    {
        $this->scopeName = $scopeName;
        
        return $this;
    }

    public function getHtml(): string
    {
        $notes = '';
        $count = 0;
        
        for ($i=0; $i<self::NUMBER; $i++) {
            $notes .= $this->note
                ->setNum($count++)
                ->setScopeName($this->scopeName)
                ->getHtml();
        }

        return $notes;
    }
}
