<?php

namespace spec\Partigen\Model;

use Partigen\Model\ImageCreator;
use PhpSpec\ObjectBehavior;

class ImageCreatorSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(ImageCreator::class);
    }
}
