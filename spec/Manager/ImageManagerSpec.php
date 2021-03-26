<?php

namespace spec\Partigen\Manager;

use Partigen\Manager\ImageManager;
use PhpSpec\ObjectBehavior;

class ImageManagerSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(ImageManager::class);
    }
}
