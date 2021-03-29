<?php

namespace spec\Partigen\App;

use Partigen\App\VueImage;
use Partigen\Model\Image;
use PhpSpec\ObjectBehavior;

class VueImageSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(VueImage::class);
    }

    function it_can_render(Image $image)
    {
        $image->getFilepath()->willReturn(tempnam('/tmp', ''));
        $this->render($image)->shouldBeString();
    }
}
