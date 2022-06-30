<?php

namespace spec\Partigen\View;

use Partigen\View\ViewPartitionModel;
use Partigen\View\ViewScopeModel;
use PhpSpec\ObjectBehavior;

class ViewPartitionModelSpec extends ObjectBehavior
{
    function let(ViewScopeModel $viewScopeModel)
    {
        $viewScopeModel->convert(['scope-data'])->willReturn('view-scope-data');
        $this->beConstructedWith($viewScopeModel);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(ViewPartitionModel::class);
    }

    function it_should_convert()
    {
        $this->convert([
            ['scope-data']
        ])->shouldContain('view-scope-');
    }
}
