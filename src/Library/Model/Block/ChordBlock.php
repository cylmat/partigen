<?php

declare(strict_types=1);

namespace Partigen\Library\Model\Block;

use Partigen\Library\Model\Block\Abstracts\AbstractBlock;

class ChordBlock extends NoteBlock
{
    const MAJ = 'MAJ';

    private const OUTLINE_UP = 'OUTLINE_UP';
    private const OUTLINE_DOWN = 'OUTLINE_DOWN';

    /**
     * Chord is like NoteBlock
     * - setLower is the base note label
     * - setType is in (maj)
     */

    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $outline;

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function isOutlineUp()
    {
        $this->outline = self::OUTLINE_UP;
    }

    public function isOutlineDown()
    {
        $this->outline = self::OUTLINE_DOWN;
    }

    public function getHtml(): string
    {
        $chord = '';

        //for ($i = 0; $i < 3; $i++) {
            $chord .= $this->get(NoteBlock::class)
                ->setNum(0)
                ->setScopeName(ScopeBlock::G)
                ->setLower($this->lower)
                ->getHtml();
        //}
        $chord .= $this->get(NoteBlock::class)
                ->setNum(0)
                ->setScopeName(ScopeBlock::G)
                ->setLower($this->lower)
                ->getHtml();

                $chord .= $this->get(NoteBlock::class)
                ->setNum(0)
                ->setScopeName(ScopeBlock::G)
                ->setLower($this->lower)
                ->getHtml();

        return $chord;
    }
}
