<?php

declare(strict_types=1);

namespace Partigen\Library\Model;

use Partigen\App\Container;
use Partigen\Library\Model\Block\Block;

class Partition
{
    public function getHtml()
    {
        $block = Container::getInstance()->get(Block::class);

        $output = 
        '<style type="text/css">'.
        file_get_contents(__DIR__.'/../Resources/partition.css').
        '</style>'.
        "<page>".

        $block->setClass("block block-first")->g().
        $block->g().
        $block->g().

        "</page>";

        return $output;
    }
}
