<?php

namespace spec\Partigen\View;

use Partigen\View\ViewNoteModel;
use Partigen\View\ViewScopeModel;
use PhpSpec\ObjectBehavior;

class ViewScopeModelSpec extends ObjectBehavior
{
    private $viewNoteModel;

    function let(ViewNoteModel $viewNoteModel)
    {
        $this->viewNoteModel = $viewNoteModel;
        $this->beConstructedWith($viewNoteModel);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(ViewScopeModel::class);
    }

    function it_should_convert()
    {
        $this->viewNoteModel->convert([
            'index' => 0,
            'highs' => 2
        ])->willReturn('note-data');

        $this->convert(
            [
                'name' => 'G',
                'notes' => [
                    [
                        'highs' => 2,
                    ],
                ]
            ]
        )->shouldContain("<div class=\"notes\">\nnote-data</div>");
    }
}
