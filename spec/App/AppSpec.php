<?php

namespace spec\Partigen\App;

use Partigen\App\App;
use Partigen\App\Vue;
use Partigen\Manager\ImageManager;
use PhpSpec\ObjectBehavior;

class AppSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(App::class);
    }

    function it_should_generate_and_display_image(ImageManager $imageManager, Vue $vue)
    {
        $imageManager->generate()->shouldBeCalled();
        $vue->output()->shouldBeCalled();
    }
}
