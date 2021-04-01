<?php

declare(strict_types=1);

namespace Partigen\Library\Model\Block;

use Partigen\Library\Model\Block\Abstracts\AbstractBlock;

class Block extends AbstractBlock
{
    const F = 'f';
    const G = 'g';
    const FG = 'fg';

    /**
     * @var string
     */
    private $type;

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

    public function f(): self
    {
        $this->type = 'f';

        return $this;
    }

    public function g(): self
    {
        $this->type = 'g';

        return $this;
    }

    public function fg(): self
    {
        $this->type = 'fg';

        return $this;
    }

    public function getHtml(): string
    {
        switch ($this->type) {
            case 'g': 
                $type = $this->scope->setName('g');
                break;
            case 'f': 
                $type = $this->scope->setName('f');
                break;
            case 'fg': 
                $type = $this->scope->setName('g').$this->scope->setName('f');
                break;
        }

        $block = '<div class="'.$this->class.'">'.$type.'</div>'."\n";

        return $block;
    }
}
