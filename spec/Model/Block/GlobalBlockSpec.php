<?php

namespace spec\Partigen\Model\Block;

use Partigen\Model\BlockFactoryInterface;
use Partigen\Model\Block\GlobalBlock;
use PhpSpec\ObjectBehavior;

class GlobalBlockSpec extends ObjectBehavior
{
    function let(BlockFactoryInterface $factory)
    {
        $this->beConstructedWith($factory);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(GlobalBlock::class);
    }

    function it_should_return_data()
    {
        $this->g();

        $this->getData()->shouldHaveKeyWithValue('class', 'block');
        $this->getData()->shouldHaveKey('ins');
    }
}
