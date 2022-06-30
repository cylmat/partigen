<?php

namespace spec\Partigen\Model\Block;

use Partigen\Config\Params;
use Partigen\DataValue\ScopeF;
use Partigen\Model\Block\NotesBlock;
use Partigen\Model\Block\ScopeBlock;
use Partigen\SpecExt\ObjectBehavior;
use Prophecy\Argument;

class ScopeBlockSpec extends ObjectBehavior
{
    function let(NotesBlock $notesBlock)
    {
        $notesBlock->setScopeData(Argument::any())->willReturn($notesBlock);
        $notesBlock->getData(Argument::any())->willReturn(['notesData']);
        $this->beConstructedWith($notesBlock);
        
        $this->setScopeData(new ScopeF());
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(ScopeBlock::class);
    }

    function it_can_get_data()
    {
        $params = (new Params());
        $this->getData($params)->shouldHaveKey('name');
        $this->getData($params)->shouldIterateLike([
            'name' => 'F',
            'notes' => ['notesData']
        ]);
    }
}
