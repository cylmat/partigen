<?php

declare(strict_types=1);

namespace Partigen\Model\Block;

use Partigen\DataValue\ScopeDataValueFactory;
use Partigen\Model\BlockFactory;

class PartitionBlock extends AbstractBlock
{
    private const SCOPES_NUMBER_IN_PAGE = 6;

    private ScopeDataValueFactory $dataValueFactory;
    private string $scopeType;

    public function __construct(BlockFactory $factory, ScopeDataValueFactory $dataValueFactory)
    {
        parent::__construct($factory);
        $this->dataValueFactory = $dataValueFactory;
    }

    public function setScopeType(string $scopeType): self
    {
        $this->scopeType = $scopeType;
        return $this;
    }

    public function getData(array $context = []): array
    {
        $partitionData = [];
        for ($s=0; $s<self::SCOPES_NUMBER_IN_PAGE; $s++) {
            $partitionData[] = $this->get(ScopeBlock::class)
                ->setScopeData($this->dataValueFactory->create($this->scopeType))
                ->getData($context);
        }

        return $partitionData;
    }
}
