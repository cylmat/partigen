<?php

namespace spec\Partigen\Manager;

use Partigen\Manager\ImageManager;
use Partigen\Model\Image;
use Partigen\Model\ImageCreator;
use PhpSpec\ObjectBehavior;

class ImageManagerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(ImageManager::class);
    }

    function it_can_call_creator(ImageCreator $imageCreator, Image $image)
    {
        $this->generate($imageCreator)->willReturn($image);
    }

    function it_can_manage_images(Image $image)
    {
        $image->getFilepath()->shouldBeCalled();
        $this->unlink($image)->willReturn();
    }
}
