<?php

namespace spec\Partigen\Service;

use Partigen\Model\Image;
use Partigen\Service\Pdf2Image;
use PhpSpec\ObjectBehavior;

class Pdf2ImageSpec extends ObjectBehavior
{
    function let(Image $image)
    {
        $this->beConstructedWith($image);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Pdf2Image::class);
    }

    function it_can_convert()
    {
        //$this->convert('/tmp/file.pdf')->shouldHaveType(Image::class);
    }
}