<?php

declare(strict_types=1);

namespace Partigen\Model\Block;

use Partigen\DataValue\ScopeDataValueFactory;
use Partigen\Model\BlockFactory;
use Partigen\Model\Params;

class PartitionBlock extends AbstractBlock
{
    private const SCOPES_NUMBER_IN_PAGE = 6;

    private ScopeDataValueFactory $dataValueFactory;

    public function __construct(BlockFactory $factory, ScopeDataValueFactory $dataValueFactory)
    {
        parent::__construct($factory);
        $this->dataValueFactory = $dataValueFactory;
    }

    public function getData(Params $context): array
    {
        $partitionData = [];
        for ($s=0; $s<self::SCOPES_NUMBER_IN_PAGE; $s++) {
            $partitionData[] = $this->get(ScopeBlock::class)
                ->setScopeData($this->dataValueFactory->create($context->getScope()))
                ->getData($context);
        }

        return $partitionData;
    }
}