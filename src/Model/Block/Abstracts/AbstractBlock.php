<?php

declare(strict_types=1);

namespace Partigen\Model\Block\Abstracts;

use Partigen\Container;
use Partigen\Model\Block\Traits\ClassTrait;

abstract class AbstractBlock
{
    use ClassTrait;

    abstract public function getHtml(): string;

    public function get(string $objectName)
    {
        return Container::getInstance()->get($objectName);
    }

    public function __toString(): string
    {
        return $this->getHtml();
    }
}