<?php

declare(strict_types=1);

namespace Partigen\Library\Model\Block;

use Partigen\Library\Model\Block\Abstracts\AbstractBlock;

class ChordBlock extends NoteBlock
{
    const MAJ = 'MAJ';

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

        //$chord .= $this->getOutlineType();

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
}
