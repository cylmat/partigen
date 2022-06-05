<?php

declare(strict_types=1);

namespace Partigen\Model;

use Partigen\Model\Block\GlobalBlock;

class Partition
{ 
    private $factory;

    public function __construct(BlockFactory $factory)
    {
        $this->factory = $factory;
    }

    public function getHtml()
    {
        $globalBlock = $this->factory->create(GlobalBlock::class);

        $output = 
        '<style type="text/css">'.
        file_get_contents(__DIR__.'/../Resources/partition.css').
        '</style>'.
        "<page>".

        $globalBlock->g()->addClass("block-first").
        $globalBlock->f().
        $globalBlock->fg().

        "</page>";

        return $output;
    }
}
