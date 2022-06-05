<?php

declare(strict_types=1);

namespace Partigen\Model;

use Partigen\Model\Block\GlobalBlock;

final class Partition
{ 
    private const RESOURCES_PATH = __DIR__.'/../../resources';

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
        file_get_contents(self::RESOURCES_PATH . '/partition.css').
        '</style>'.
        "<page>".

        $globalBlock->g()->addClass("block-first").
        $globalBlock->f().
        $globalBlock->fg().

        "</page>";

        return $output;
    }
}
