<?php

namespace Partigen\Library\Model;

class Partition
{
    public function getHtml()
    {
        include 'blocks.php';

        $output = 
        '<style type="text/css">'.
        file_get_contents('partition.css').
        '</style>'.
        "<page>".

        $block("block block-first").
        //$block().
        //$block().

        "</page>";

        return $output;
    }
}
