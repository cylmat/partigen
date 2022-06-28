<?php

declare(strict_types=1);

namespace Partigen\Model\Block;

use Partigen\Config\Params;
use Partigen\DataValue\ScopeDataValueFactory;
use Partigen\Model\BlockFactory;
use Partigen\Service\Randomizer;

class PartitionBlock extends AbstractBlock
{
    private const SCOPES_NUMBER_IN_PAGE = 6;

    private ScopeDataValueFactory $dataValueFactory;
    private Randomizer $randomizer;

    public function __construct(
        BlockFactory $factory,
        ScopeDataValueFactory $dataValueFactory,
        Randomizer $randomizer
    ) {
        parent::__construct($factory);

        $this->dataValueFactory = $dataValueFactory;
        $this->randomizer = $randomizer;
    }

    public function getData(Params $context): array
    {
        $partitionData = [];
        for ($s = 0; $s < self::SCOPES_NUMBER_IN_PAGE; $s++) {
            $selectedScope = $this->randomizer->getScope($context->getScopes());
            /** @phpstan-ignore-next-line */
            $partitionData[] = $this->get(ScopeBlock::class)
                ->setScopeData($this->dataValueFactory->create($selectedScope))
                ->getData($context);
        }

        return $partitionData;
    }
}
