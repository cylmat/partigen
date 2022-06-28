<?php

declare(strict_types=1);

namespace Partigen\Model\Block;

use Partigen\Config\Params;
use Partigen\DataValue\ScopeDataInterface;

class ScopeBlock implements BlockInterface
{
    private ScopeDataInterface $scopeData;
    private NotesBlock $notesBlock;

    public function __construct(NotesBlock $notesBlock)
    {
        $this->notesBlock = $notesBlock;
    }

    public function setScopeData(ScopeDataInterface $scopeData): self
    {
        $this->scopeData = $scopeData;

        return $this;
    }

    public function getType(): string
    {
        return $this->scopeData->getName();
    }

    public function getData(Params $context): array
    {
        return [
            'name' => $this->scopeData->getName(),
            /** @phpstan-ignore-next-line */
            'notes' => $this->notesBlock
                ->setScopeData($this->scopeData)
                ->getData($context)
        ];
    }
}
