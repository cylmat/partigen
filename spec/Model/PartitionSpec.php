<?php

namespace spec\Partigen\Model;

use Partigen\Model\BlockFactoryInterface;
use Partigen\Model\Block\GlobalBlock;
use Partigen\Model\Partition;
use Partigen\View\ViewModel;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class PartitionSpec extends ObjectBehavior
{
    function let(
        BlockFactoryInterface $factory,
        ViewModel $view,
        GlobalBlock $globalBlock
    ) {
        $globalBlock->g()->willReturn($globalBlock);
        $globalBlock->f()->willReturn($globalBlock);
        $globalBlock->getData()->willReturn(['scopesdata']);

        $view->style(Argument::type('string'))->willReturn('<style>css</style>');
        $view->convert(Argument::type('array'))->willReturn('global-data');
        $view->page('global-data')->willReturn('<page>content</page>');

        $factory->create(GlobalBlock::class)->willReturn($globalBlock);
        $this->beConstructedWith($factory, $view);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Partition::class);
    }

    function it_should_get_html()
    {
        $expect = '<style>css</style><page>content</page>';
        $this->getHtml()->shouldContain($expect);
    }
}
