<?php

namespace spec\Partigen\Bridge;

use Partigen\Bridge\Pdf2Image;
use Partigen\Factory;
use Partigen\SpecExt\ObjectBehavior;
use Prophecy\Argument;
use Spatie\PdfToImage\Pdf;

class Pdf2ImageSpec extends ObjectBehavior
{
    function let(Factory $factory, Pdf $pdf)
    {
        $pdf->getImageData('php://memory')->willReturn(new \Imagick());
        $factory->createPdf2Image(Argument::type('string'))->willReturn($pdf);

        $this->beConstructedWith($factory);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Pdf2Image::class);
    }

    function it_can_convert_content()
    {
        $this->convertContentToRawData('*pdf_raw_content*')->shouldBe('');
    }
}