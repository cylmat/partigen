<?php

declare(strict_types=1);

namespace Partigen\Library\Model\Block\Abstracts;

use Partigen\App\Container;
use Partigen\Library\Model\Block\Traits\ClassTrait;

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