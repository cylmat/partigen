<?php

namespace spec\Partigen\Model;

use Partigen\Model\Image;
use PhpSpec\ObjectBehavior;

class ImageSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Image::class);
    }
}
