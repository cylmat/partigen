<?php

declare(strict_types=1);

namespace Partigen\Model\Block;

use Partigen\Config\Params;
use Partigen\DataValue\AbstractScope;
use Partigen\DataValue\ScopeDataInterface;
use Partigen\Service\Baseline;
use Partigen\Service\Randomizer;

class NotesBlock implements BlockInterface
{
    // will be overriden and hidden by ViewScopeModel
    private const NUMBERS_ON_A_LINE = 30;

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
        [$min, $max] = $this->getFinalBounds($context);

        for ($i = 0; $i < self::NUMBERS_ON_A_LINE; $i++) {
            $isChord = $this->randomizer->isChord(0);

            if (!$isChord) {
                // Notes
                $notes[] = [
                    'highs' => [$this->randomizer->getNoteHigh($min, $max)],
                ];
            } else {
                // Chords
                 // @todo to implements
                $notes[] = [
                    'highs' => [
                        $base = $this->randomizer->getNoteHigh($min, $max),
                        $base - 2,
                        $base + 2
                    ],
                ];
            }
        }

        return $notes;
    }

    private function getFinalBounds(Params $context): array
    {
        [$minScopeBound, $maxScopeBound] = $this->getScopeBounds($context);
        [$minCustomBound, $maxCustomBound] = $this->getCustomBounds($context);

        $max = min($maxScopeBound, $maxCustomBound);
        $min = max($minScopeBound, $minCustomBound);

        return [$min, $max];
    }

    private function getScopeBounds(Params $context): array
    {
        [$lowerNote, $higherNote] = $this->getScopeVariationDiff();
        $baseline = $this->scopeData->getBaseline();

        if ($context->isPaired()) {
            $pairedLower = $this->scopeData->getPairedLower();
            $pairedUpper = $this->scopeData->getPairedUpper();
            $scopeMinPairedDiff = $this->baselineService::diffLabelWithBaseline($pairedLower, $baseline);
            $scopeMaxPairedDiff = $this->baselineService::diffLabelWithBaseline($pairedUpper, $baseline);

            $lowerNote = max($lowerNote, $scopeMinPairedDiff);
            $higherNote = min($higherNote, $scopeMaxPairedDiff);
        }

        return [$lowerNote, $higherNote];
    }

    /**
     * Give maximum difference for current scope
     */
    private function getScopeVariationDiff(): array
    {
        return [
            0 - AbstractScope::MAX_OUTSIDE_VARIATION, // bottom line
            8 + AbstractScope::MAX_OUTSIDE_VARIATION // top line
        ];
    }

    /**
     * Return min and max from baseline (bottom line of scope)
     *  e.g. in G scope: 0 will be E3 (bottom line), -1 will be D3, etc...
     *
     * $customMinLabelOrDiff Can be a string (e.g. 'C5'), or a difference (e.g. 5)
     * $customMaxLabelOrDiff Can be a string (e.g. 'C2'), or a difference (e.g. -5)
     */
    private function getCustomBounds(Params $context): array
    {
        $customMinLabelOrDiff = $context->getLowerNote();
        $customMaxLabelOrDiff = $context->getHigherNote();
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

        return [$customMinDiff, $customMaxDiff];
    }
}
