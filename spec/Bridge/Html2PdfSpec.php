<?php

namespace spec\Partigen\Service;

use Partigen\Service\Html2Pdf;
use PhpSpec\ObjectBehavior;

class Html2PdfSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Html2Pdf::class);
    }

    function it_can_generate()
    {
        $this->generate()->shouldBeString();
    }
}