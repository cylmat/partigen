<?php

namespace spec\Partigen\View;

use Partigen\View\ViewModel;
use Partigen\View\ViewScopeModel;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ViewModelSpec extends ObjectBehavior
{
    function let(ViewScopeModel $viewScope)
    {
        $viewScope->convert(Argument::type('array'))->will(function ($args) {
            return 's:'.$args[0]['type'];
        });
        $this->beConstructedWith($viewScope);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(ViewModel::class);
    }

    function it_should_convert()
    {
        $data = [
            [
                [
                    'type' => 'f',
                    'notes' => [
                        1,2,3
                    ]
                ],
                [
                    'type' => 'g',
                    'notes' => [
                        1,2,3
                    ]
                ]
            ],
            [
                [
                    'type' => 'f',
                    'notes' => [
                        1,2,3
                    ]
                ],
            ],
        ];

        $expectHtml = '<div class="scopes">s:f</div>';
        $this->convert($data)->shouldContain($expectHtml);
    }
}
