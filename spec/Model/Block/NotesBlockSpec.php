<?php

namespace spec\Partigen\Model\Block;

use Partigen\Model\Block\NotesBlock;
use Partigen\Model\Block\ScopeBlock;
use PhpSpec\ObjectBehavior;

class NotesBlockSpec extends ObjectBehavior
{
    function let(ScopeBlock $scope)
    {
        $scope->getType()->willReturn('G');
        $scope->isPaired()->willReturn(false);
        $this->setScope($scope);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(NotesBlock::class);
    }

    function it_should_return_data()
    {
        $this->getData()->shouldBeExactly([
            ['high' => 0],
            ['high' => 0],
            ['high' => 0],
            ['high' => 0],
            ['high' => 0],
            ['high' => 0],
            ['high' => 0],
            ['high' => 0],
        ]);
    }
}
