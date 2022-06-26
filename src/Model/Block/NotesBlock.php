<?php

declare(strict_types=1);

namespace Partigen\Model\Block;

use Partigen\Config\Params;
use Partigen\DataValue\AbstractScope;
use Partigen\DataValue\ScopeDataInterface;
use Partigen\Service\Baseline;
use Partigen\Service\Randomizer;

class NotesBlock extends AbstractBlock
{
    private const NUMBERS_ON_A_LINE = 24;

    private ScopeDataInterface $scopeData;
    private Baseline $baselineService;
    private Randomizer $randomizer;

    public function __construct(Baseline $baselineService, Randomizer $randomizer)
    {
        $this->baselineService = $baselineService;
        $this->randomizer = $randomizer;
    }

    public function setScopeData(ScopeDataInterface $scopeData): self
    {
        $this->scopeData = $scopeData;

        return $this;
    }

    public function getData(Params $context): array
    {
        $notes = [];
        $higherNote = $context->getHigherNote() ?? 'B8';
        $lowerNote = $context->getLowerNote() ?? 'C0';

        for ($i = 0; $i < self::NUMBERS_ON_A_LINE; $i++) {
            $isNote = $this->randomizer->isNoteOrChord($context->getChordFreq());

            if ($isNote) {
                // Notes
                $notes[] = [
                    'highs' => [$this->getRandomizedNoteFromBaseline($lowerNote, $higherNote)],
                ];
            } else {
                // Chords
                $notes[] = [
                    'highs' => [
                        /** @todo generate real chords */
                        $base = $this->getRandomizedNoteFromBaseline($lowerNote, $higherNote),
                        $base - 2,
                        $base + 2
                    ],
                ];
            }
        }

        return $notes;
    }

    /**
     * Return integer from baseline (bottom line of scope)
     *  e.g. in G scope: 0 will be E3 (bottom line), -1 will be D3, etc...
     * 
     * @param string|int $customMinLabelOrDiff Can be a string (e.g. 'C5'), or a difference (e.g. 5)
     * @param string|int $customMinDiff Can be a string (e.g. 'C2'), or a difference (e.g. -5)
     */
    private function getRandomizedNoteFromBaseline($customMinLabelOrDiff, $customMaxLabelOrDiff): int
    {
        $scopeLine = $this->baselineService::diffLabelWithBaseline($this->scopeData->getScopeLine(), $this->scopeData->getBaseline());
        
        if (\is_string($customMaxLabelOrDiff)) { // is a label
            $customMaxDiff = $this->baselineService::diffLabelWithBaseline($customMaxLabelOrDiff, $this->scopeData->getBaseline());
        } else { // is a integer
            $customMaxDiff = $customMaxLabelOrDiff + $scopeLine;
        }
        
        if (\is_string($customMinLabelOrDiff)) { // is a label
            $customMinDiff = $this->baselineService::diffLabelWithBaseline($customMinLabelOrDiff, $this->scopeData->getBaseline());
        } else { // is a integer
            $customMinDiff = $customMinLabelOrDiff + $scopeLine;
        }

        [$scopeMinDiff, $scopeMaxDiff] = $this->getScopeBoundDiff();

        // setting bounds
        $max = min($scopeMaxDiff, $customMaxDiff);
        $max = max($scopeMinDiff, $max);

        $min = max($scopeMinDiff, $customMinDiff);
        $min = min($scopeMaxDiff, $min);

        return $this->randomizer->getNoteHigh($min, $max);
    }

    /**
     * Give maximum difference for current scope
     */
    private function getScopeBoundDiff(): array
    {
        return [
            0 - AbstractScope::MAX_OUTSIDE_VARIATION, // bottom line
            8 + AbstractScope::MAX_OUTSIDE_VARIATION // top line
        ];
    }
}
