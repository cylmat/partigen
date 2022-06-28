<?php

namespace spec\Partigen\Model\Block;

use Partigen\Config\Params;
use Partigen\DataValue\ScopeDataValueFactory;
use Partigen\DataValue\ScopeG;
use Partigen\Model\Block\PartitionBlock;
use Partigen\Model\Block\ScopeBlock;
use Partigen\Model\BlockFactory;
use Partigen\Service\Randomizer;
use Partigen\SpecExt\ObjectBehavior;
use Prophecy\Argument;

class PartitionBlockSpec extends ObjectBehavior
{
    function let(
        BlockFactory $factory,
        ScopeDataValueFactory $dataValueFactory,
        Randomizer $randomizer,
        ScopeBlock $scopeBlock
    ) {
        $randomizer->getScope(['G'])->willReturn('G');
        $dataValueFactory->create('G')->willReturn(new ScopeG());
        
        $scopeBlock->setScopeData(new ScopeG())->willReturn($scopeBlock);
        $scopeBlock->getData(Argument::type(Params::class))->willReturn(['data']);
        $factory->create(ScopeBlock::class)->willReturn($scopeBlock);

        $this->beConstructedWith($factory, $dataValueFactory, $randomizer);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(PartitionBlock::class);
    }

    function it_can_get_data(Params $params)
    {
        $params->getScopes()->willReturn(['G']);
        $this->getData($params->getWrappedObject())->shouldBe([
            ['data'],
            ['data'],
            ['data'],
            ['data'],
            ['data'],
            ['data'],
        ]);
    }
}
