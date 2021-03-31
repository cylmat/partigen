<?php

namespace spec\Partigen\Model;

use Partigen\Model\Image;
use PhpSpec\ObjectBehavior;

class ImageSpec extends ObjectBehavior
{
    function let()
    {
        $this->setFormat('A4');
        $this->setFilepath('/tmp/file.jpg');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Image::class);
    }

    function it_can_be_set()
    {
        $this->setFormat('')->shouldHaveType(Image::class);
        $this->setFilepath('')->shouldHaveType(Image::class);
    }

    function it_can_get_values()
    {
        $this->getFormat()->shouldBeString();
        $this->getFilepath()->shouldBeString();
    }
}
