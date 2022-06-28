<?php

declare(strict_types=1);

namespace Partigen\Model\Block;

use Partigen\Config\Params;

class ChordBlock implements BlockInterface
{
    public const MAJ = 'MAJ';

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
        /** @todo to implements */
        return $this;
    }

    public function getData(Params $context): array
    {
        $chord = $this->getChordType();

        return $chord;
    }

    private function getChordType(): array
    {
        /** @todo to implements */
        $chord = [];

        switch ($this->type) {
            case self::MAJ:
                foreach (self::TYPE_MAJ as $inter) {
                    $note = [];
                }
                break;
        }

        return $chord;
    }
}
