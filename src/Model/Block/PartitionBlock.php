<?php

declare(strict_types=1);

namespace Partigen\Model\Block;

use Partigen\Config\Params;
use Partigen\Factory;
use Partigen\Service\Randomizer;

class PartitionBlock implements BlockInterface
{
    private const SCOPES_NUMBER_IN_PAGE = 6;

    private ScopeBlock $scopeBlock;
    private Randomizer $randomizer;
    private Factory $factory;

    public function __construct(
        ScopeBlock $scopeBlock,
        Randomizer $randomizer,
        Factory $factory
    ) {
        $this->randomizer = $randomizer;
        $this->scopeBlock = $scopeBlock;
        $this->factory = $factory;
    }

    public function getData(Params $context): array
    {
        $partitionData = [];
        for ($s = 0; $s < self::SCOPES_NUMBER_IN_PAGE; $s++) {
            $selectedScope = $this->randomizer->getScope($context->getScopes());
            /** @phpstan-ignore-next-line */
            $partitionData[] = $this->scopeBlock
                ->setScopeData($this->factory->createScopeData($selectedScope))
                ->getData($context);
        }

        return $partitionData;
    }
}
