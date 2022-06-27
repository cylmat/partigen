<?php

declare(strict_types=1);

namespace Partigen\Model\Block;

class ChordBlock extends NoteBlock
{
    const MAJ = 'MAJ';

    private const TYPE_MAJ = [0, 2, 4];
    private string $type;

    /*
     * Chord is like NoteBlock
     * - setLower is the base note label
     * - setType is in (maj)
     */

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function setBaseInterval(int $baseInterval): self
    {
        return $this->setInterval($baseInterval);
    }

    public function getData(array $context = []): array
    {
        $chord = $this->getChordType();

        return $chord;
    }

    private function getChordType()
    {
        $chord = '';

        switch ($this->type) {
            case self::MAJ:
                if ($this->interval > 0) {
                    //display from top
                    foreach (array_reverse(self::TYPE_MAJ) as $inter) {
                        $note = $this->get(NoteBlock::class)
                                ->setNum($this->num)
                                ->setInterval($this->interval + $inter);
                        if ($inter === 0) {
                            $note->disableOutlines();
                        }
                        $chord .= $note;
                    }
                } else {
                    //display from bottom
                    foreach (self::TYPE_MAJ as $inter) {
                        $note = $this->get(NoteBlock::class)
                                ->setNum($this->num)
                                ->setInterval($this->interval + $inter);
                        if ($inter === 0) {
                            $note->disableOutlines();
                        }
                        $chord .= $note;
                    }
                }
                break;
        }

        return $chord;
    }
}
