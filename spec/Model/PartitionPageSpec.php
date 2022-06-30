<?php

namespace spec\Partigen\Model;

use Partigen\Config\Params;
use Partigen\Model\Block\PartitionBlock;
use Partigen\Model\PartitionPage;
use Partigen\SpecExt\ObjectBehavior;
use Partigen\View\ViewPartitionModel;
use PhpSpec\Wrapper\Collaborator;

class PartitionPageSpec extends ObjectBehavior
{
    private Collaborator $partitionBlock;
    private Collaborator $viewPartitionModel;

    function let(PartitionBlock $partitionBlock, ViewPartitionModel $viewPartitionModel)
    {
        $this->partitionBlock = $partitionBlock;
        $this->viewPartitionModel = $viewPartitionModel;

        $this->beConstructedWith($partitionBlock, $viewPartitionModel);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(PartitionPage::class);
    }

    function it_should_get_html(Params $params)
    {
        $this->partitionBlock->getData($params)->willReturn(['partition-data']);
        $this->viewPartitionModel->convert(['partition-data']);
        $this->getHtml($params)->shouldBeString();
    }
}
