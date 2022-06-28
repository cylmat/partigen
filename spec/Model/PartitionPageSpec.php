<?php

namespace spec\Partigen\Model;

use Partigen\Config\Params;
use Partigen\Model\BlockFactoryInterface;
use Partigen\Model\PartitionPage;
use Partigen\SpecExt\ObjectBehavior;
use Partigen\View\ViewPartitionModel;

class PartitionPageSpec extends ObjectBehavior
{
    function let(
    ) {
        $container = $this->getContainer();

        $this->beConstructedWith(
            $container->get(BlockFactoryInterface::class),
            $container->get(ViewPartitionModel::class)
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(PartitionPage::class);
    }

    function it_should_get_html()
    {
        $this->getHtml(new Params())->shouldBeString();
    }
}
