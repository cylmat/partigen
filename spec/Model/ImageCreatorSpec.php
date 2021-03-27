<?php

namespace spec\Partigen\Model;

use Partigen\Model\Image;
use Partigen\Model\ImageCreator;
use PhpSpec\ObjectBehavior;

class ImageCreatorSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(ImageCreator::class);
    }

    function it_can_create_image()
    {
        $this->create([
            ImageCreator::FORMAT => ImageCreator::FORMAT_A4
        ])->shouldHaveType(Image::class);
    }
}
