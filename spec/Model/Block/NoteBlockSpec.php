<?php

namespace spec\Partigen\Model\Block;

use Partigen\Model\BlockFactoryInterface;
use Partigen\Model\Block\NoteBlock;
use PhpSpec\ObjectBehavior;

class NoteBlockSpec extends ObjectBehavior
{
    function let(BlockFactoryInterface $factory)
    {
        $this->beConstructedWith($factory);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(NoteBlock::class);
    }

    function it_should_set_num()
    {
        $this->setNum(8)->shouldReturnAnInstanceOf(NoteBlock::class);
    }

    function it_should_return_data()
    {
        $this->setNum(8);
        $this->setInterval(1);

        $this->getData()->shouldBeExactly([
            'left' => 8,
            'top' => 1,
        ]);
    }
}
