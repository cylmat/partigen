<?php

namespace spec\Partigen\Manager;

use Partigen\Manager\ImageManager;
use Partigen\Model\Image;
use PhpSpec\ObjectBehavior;

class ImageManagerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(ImageManager::class);
    }

    function it_can_call_creator()
    {
        $this->generate()->shouldHaveType(Image::class);
    }
}
