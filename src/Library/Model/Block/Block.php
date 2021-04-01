<?php

declare(strict_types=1);

namespace Partigen\Library\Model\Block;

use Partigen\Library\Model\Block\Abstracts\AbstractBlock;

class Block extends AbstractBlock
{
    private $scope;

    public function __construct(ScopeBlock $scope)
    {
        $this->scope = $scope;
        $this->setClass('block');
    }

    public function getHtml(): string
    {
        $block = '<div class="'.$this->class.'">'.
            $this->scope->setName('sol').
            $this->scope->setName('fa').
        '</div>';

        return $block;
    }
}
