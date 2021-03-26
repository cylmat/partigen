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
}
