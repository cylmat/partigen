<?php

namespace Partigen\Library\Model\Block\Abstract;

use Partigen\Library\Model\Block\Trait\ClassTrait;

abstract class AbstractBlock
{
    use ClassTrait;
    
    abstract public function getHtml(): string;
}