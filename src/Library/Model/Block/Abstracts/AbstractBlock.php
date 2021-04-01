<?php

declare(strict_types=1);

namespace Partigen\Library\Model\Block\Abstracts;

use Partigen\Library\Model\Block\Traits\ClassTrait;

abstract class AbstractBlock
{
    use ClassTrait;
    
    abstract public function getHtml(): string;

    public function __toString(): string
    {
        return $this->getHtml();
    }
}