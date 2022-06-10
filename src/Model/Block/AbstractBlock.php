<?php

declare(strict_types=1);

namespace Partigen\Model\Block;

use Partigen\Model\BlockFactory;

abstract class AbstractBlock implements BlockInterface
{
    protected BlockFactory $factory;

    public function __construct(BlockFactory $factory)
    {
        $this->factory = $factory;
    }
    
    public function get(string $objectType): self
    {
        return $this->factory->create($objectType);
    }

    abstract public function getData(): array;
}