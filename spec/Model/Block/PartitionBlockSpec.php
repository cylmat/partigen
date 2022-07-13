<?php

namespace spec\Partigen\Model\Block;

use Partigen\Config\Params;
use Partigen\DataValue\ScopeG;
use Partigen\Factory;
use Partigen\Model\Block\PartitionBlock;
use Partigen\Model\Block\ScopeBlock;
use Partigen\Service\Randomizer;
use Partigen\SpecExt\ObjectBehavior;
use Prophecy\Argument;

class PartitionBlockSpec extends ObjectBehavior
{
    function let(
        ScopeBlock $scopeBlock,
        Randomizer $randomizer,
        Factory $factory
    ) {
        $randomizer->getScope(['G'])->willReturn('G');
        $factory->createScopeData('G')->willReturn(new ScopeG());
        
        $scopeBlock->setScopeData(new ScopeG())->willReturn($scopeBlock);
        $scopeBlock->getData(Argument::type(Params::class))->willReturn(['data']);
        $factory->createBlock(ScopeBlock::class)->willReturn($scopeBlock);

        $this->beConstructedWith($scopeBlock, $randomizer, $factory);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(PartitionBlock::class);
    }

    function it_can_get_data(Params $params)
    {
        $params->getScopes()->willReturn(['G']);
        $this->getData($params->getWrappedObject())->shouldBe(\array_fill(0, 10, ['data']));
    }
}
