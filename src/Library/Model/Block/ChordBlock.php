<?php

declare(strict_types=1);

namespace Partigen\Library\Model\Block;

use Partigen\Library\Model\Block\Abstracts\AbstractBlock;

class ChordBlock extends NoteBlock
{
    const MAJ = 'MAJ';

    const OUTLINE_UP = 'OUTLINE_UP';
    const OUTLINE_DOWN = 'OUTLINE_DOWN';

    /**
     * Chord is like NoteBlock
     * - setLower is the base note label
     * - setType is in (maj)
     */

    /**
     * @var string
     */
    private $type;

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function setBaseInterval(int $baseInterval): self
    {
        return $this->setInterval($baseInterval);
    }

    public function getHtml(): string
    {
        $chord = '';

        $chord .= $this->getOutlineType();

        return $chord;
    }

    private function getChordType()
    {
        $chord = '';

        for ($i = 0; $i < 3; $i++) {
            $chord .= $this->get(NoteBlock::class)
                ->setNum($this->num)
                ->setInterval($this->interval-2*$i);
        }

        return $chord;
    }

    private function getOutlineType()
    {
        $chord = '';

        // note splitted or not
        $note = $this->get(NoteBlock::class)
            ->setNum($this->num)
            ->setInterval($this->interval);
            
        if (0 === $this->interval % 2) {
            $note->setIsOutline();
        }

        // interlines
        $interlines = '';

        if ($this->interval < -2) {
            // out down
            for ($i=-4; $i>$this->interval; $i-=2) {
                $interlines .= $this->get(NoteBlock::class)
                    ->setNum($this->num)
                    ->setInterval($i)
                    ->setIsInterline();
            }
        } elseif ($this->interval > 8) {
            // out up
            for ($i=8; $i<$this->interval; $i+=2) {
                $interlines .= $this->get(NoteBlock::class)
                    ->setNum($this->num)
                    ->setInterval($i)
                    ->setIsInterline();
            }
        }

        $chord .= $interlines;
        $chord .= $note;

        return $chord;
    }
}
