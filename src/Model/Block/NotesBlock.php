<?php

declare(strict_types=1);

namespace Partigen\Model\Block;

use Partigen\DataValue\ScopeDataInterface;
use Partigen\Model\BaselineService;

class NotesBlock extends AbstractBlock
{
    private const NUMBERS_ON_A_LINE = 8;

    private ScopeDataInterface $scopeData;
    private BaselineService $baselineService;

    public function __construct(BaselineService $baselineService)
    {
        $this->baselineService = $baselineService;
    }

    public function setScopeData(ScopeDataInterface $scopeData): self
    {
        $this->scopeData = $scopeData;

        return $this;
    }

    public function getData(): array
    {
        $notes = [];

        for ($i = 0; $i < self::NUMBERS_ON_A_LINE; $i++) {
            $isNote = 1;

            if ($isNote) {
                // Notes
                $notes[] = [
                    'highs' => $this->getRandomizedNoteFromBaseline('C2', 'C6'),
                ];
            } /*else {
                // Chords
                $randomChordInterval = $this->getRandomizedChord($lowerLabel, $higherLabel);
                $notes[] = [
                    'num' => $i,
                    'high' => $this->get(ChordBlock::class)
                    //->setNum($i)
                    //->setBaseInterval($this->getInterval($randomChordInterval))
                    //->setType(ChordBlock::MAJ)
                    ->getData()
                ];
            }*/
        }

        return $notes;
    }

    /**
     * Return integer from baseline (bottom line of scope)
     *  e.g. in G scope: 0 will be E3 (bottom line), -1 will be D3, etc...
     * 
     * @param string|int $customMaxDiff Can be a string (e.g. 'C5'), or a difference (e.g. 5)
     * @param string|int $customMinDiff Can be a string (e.g. 'C2'), or a difference (e.g. -5)
     */
    private function getRandomizedNoteFromBaseline($customMinDiff, $customMaxDiff): array
    {
        if (\is_string($customMaxDiff)) {
            $customMaxDiff = $this->baselineService::diffLabelWithBaseline($customMaxDiff, $this->scopeData->getBaseline());
        }

        if (\is_string($customMinDiff)) {
            $customMinDiff = $this->baselineService::diffLabelWithBaseline($customMinDiff, $this->scopeData->getBaseline());
        }

        [$scopeMinDiff, $scopeMaxDiff] = $this->getScopeBoundDiff();

        $max = min($scopeMaxDiff, $customMaxDiff);
        $min = max($scopeMinDiff, $customMinDiff);

        return [rand($min, $max)];
    }

    /**
     * Give maximum difference for current scope
     *  e.g. For scope G, baseline is G3, min bound is G2
     *  so min diff will be -7
     */
    private function getScopeBoundDiff(): array
    {
        /*switch ($this->scope->getName()) {
            case ScopeBlock::G:
                $maxLabel = self::G_MAX_NOTE;
                $minLabel = $this->scope->isPaired() ? self::FG_CROSS_G : self::G_MIN_NOTE;
                break;
            case ScopeBlock::F:
                $maxLabel = $this->scope->isPaired() ? self::FG_CROSS_F : self::F_MAX_NOTE;
                $minLabel = self::F_MIN_NOTE;
                break;
            default:
                throw new \RuntimeException("Scope type '".$this->scope->getType() . "' not allowed");
        }*/

        $maxLabel = $this->scopeData->getMaxNote();
        $minLabel = $this->scopeData->getMinNote();

        return [
            $this->baselineService::diffLabelWithBaseline($minLabel, $this->scopeData->getBaseline()),
            $this->baselineService::diffLabelWithBaseline($maxLabel, $this->scopeData->getBaseline()),
        ];
    }
}
