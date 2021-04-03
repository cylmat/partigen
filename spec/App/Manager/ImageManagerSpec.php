<?php

namespace spec\Partigen\Manager;

use Partigen\Manager\ImageManager;
use Partigen\Model\Image;
use Partigen\Service\ImageCreator;
use PhpSpec\ObjectBehavior;

class ImageManagerSpec extends ObjectBehavior
{
    function let(ImageCreator $imageCreator)
    {
        $imageCreator->create(['format'=>'A4'])->willReturn(new Image);
        $this->beConstructedWith($imageCreator);
    }
    
    function it_is_initializable()
    {
        $this->shouldHaveType(ImageManager::class);
    }

    function it_can_call_creator()
    {
        $this->generate()->shouldHaveType(Image::class);
    }
}
