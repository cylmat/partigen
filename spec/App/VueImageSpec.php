<?php

namespace spec\Partigen\App;

use Partigen\App\VueImage;
use Partigen\Manager\ImageManager;
use PhpSpec\ObjectBehavior;

class VueImageSpec extends ObjectBehavior
{
    function let(ImageManager $imageManager)
    {
        $this->beConstructedWith([$imageManager]);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(VueImage::class);
    }

    function it_can_output()
    {

    }
}
