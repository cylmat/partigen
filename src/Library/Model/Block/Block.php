<?php

declare(strict_types=1);

namespace Partigen\Library\Model\Block;

use Partigen\Library\Model\Block\Abstracts\AbstractBlock;

class Block extends AbstractBlock
{
    private $F = true;
    private $G = true;

    private $scope;

    /**
     * @var string
     */
    private $content;

    public function __construct(ScopeBlock $scope)
    {
        $this->scope = $scope;
        $this->setClass('block');
    }

    public function onlyG(): self
    {
        $this->F = false;

        return $this;
    }

    public function onlyF(): self
    {
        $this->G = false;

        return $this;
    }

    public function getHtml(): string
    {
        $block = '<div class="'.$this->class.'">'.
            ($this->G ? $this->scope->setName('sol') : '').
            ($this->F ? $this->scope->setName('fa') : '').
        '</div>'."\n";

        return $block;
    }
}
