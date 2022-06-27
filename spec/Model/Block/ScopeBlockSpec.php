<?php

namespace spec\Partigen\Model\Block;

use DI\Container;
use Partigen\Config\Params;
use Partigen\DataValue\ScopeDataInterface;
use Partigen\Model\Block\NotesBlock;
use Partigen\Model\Block\ScopeBlock;
use Partigen\Model\BlockFactory;
use Partigen\SpecExt\ObjectBehavior;
use Prophecy\Argument;

class ScopeBlockSpec extends ObjectBehavior
{
    function let(
        Container $container,
        ScopeDataInterface $scopeData
    ) {
        $notesBlock = $this->prophesize(NotesBlock::class);
        $notesBlock->setScopeData(Argument::any())->willReturn($notesBlock);
        $notesBlock->getData(Argument::any())->willReturn(['notesData']);
        $container->get(NotesBlock::class)->willReturn($notesBlock->reveal());
        $this->beConstructedWith(new BlockFactory($container->getWrappedObject()));
        
        $scopeData->getName()->willReturn('F');
        $this->setScopeData($scopeData);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(ScopeBlock::class);
    }

    function it_can_get_data(ScopeDataInterface $scopeData)
    {
        $params = (new Params());
        $this->getData($params)->shouldHaveKey('name');
        $this->getData($params)->shouldIterateLike([
            'name' => 'F',
            'notes' => ['notesData']
        ]);
    }
}
