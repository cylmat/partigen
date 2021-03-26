<?php

namespace spec\Partigen\App;

use Partigen\App\Vue;
use PhpSpec\ObjectBehavior;

class VueSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Vue::class);
    }
}
