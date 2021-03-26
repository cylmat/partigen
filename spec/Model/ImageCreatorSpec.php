<?php

namespace spec\Partigen\Model;

use Partigen\Model\ImageCreator;
use PhpSpec\ObjectBehavior;

class ImageCreatorSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(['A4']);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(ImageCreator::class);
    }

    function it_can_create_image()
    {
        $this->create()->willReturn();
    }
}
