<?php

namespace spec\Partigen\View;

use Partigen\View\ViewNoteModel;
use PhpSpec\ObjectBehavior;

class ViewNoteModelSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(ViewNoteModel::class);
    }

    function it_should_convert()
    {
        $data = [
            'index' => $index = 0,
            'highs' => [
                $high = 1
            ]
        ];
        $left = 40 + ($index * (22+10));
        $top = 55 - ($high * 6);
        $this->convert($data)->shouldContain("left: {$left}px; top: {$top}px;");

        $data = [
            'index' => $index = 0,
            'highs' => [
                $high = 2
            ]
        ];
        $left = 40 + ($index * (22+10));
        $top = 55 - ($high * 6);
        $this->convert($data)->shouldContain("left: {$left}px; top: {$top}px;");
    }
}
