<?php

namespace spec\Partigen\View;

use Partigen\SpecExt\ObjectBehavior;
use Partigen\View\ViewNoteModel;
use Partigen\View\ViewScopeModel;

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
            'highs' => [2]
        ])->willReturn('note-data');

        $this->convert(
            [
                'name' => 'G',
                'notes' => [
                    [
                        'highs' => [2],
                    ],
                ]
            ]
        )->shouldContain("<div class=\"notes\">\nnote-data</div>");
    }

    function it_should_convert_outscope()
    {
        $this->viewNoteModel->convert([
            'index' => 0,
            'highs' => [20]
        ])->willReturn('note-data');

        $this->convert(
            [
                'name' => 'G',
                'notes' => [
                    [
                        'highs' => [20],
                    ],
                ]
            ]
        )->shouldContain('style="margin-top: 72px; margin-bottom: 0px;"');

        // bottom
        $this->viewNoteModel->convert([
            'index' => 0,
            'highs' => [-20]
        ])->willReturn('note-data');

        $this->convert(
            [
                'name' => 'G',
                'notes' => [
                    [
                        'highs' => [-20],
                    ],
                ]
            ]
        )->shouldContain('style="margin-top: 0px; margin-bottom: 120px;"');
    }
}
