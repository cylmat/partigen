<?php

declare(strict_types=1);

namespace Partigen\Model\Block;

use Partigen\Model\Block\Traits\ClassTrait;
use Partigen\Model\BlockFactory;
use Stringable;

abstract class AbstractBlock implements BlockInterface, Stringable
{
    use ClassTrait;

    protected BlockFactory $factory;

    public function __construct(BlockFactory $factory)
    {
        $this->factory = $factory;
    }

    abstract public function getHtml(): string;

    public function get(string $objectType): self
    {
        return $this->factory->create($objectType);
    }

    public function __toString(): string
    {
        return $this->getHtml();
    }
}