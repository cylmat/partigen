<?php

namespace spec\Partigen;

use Partigen\ImageCreator;
use Partigen\Bridge\Html2Pdf;
use Partigen\Bridge\Pdf2Image;
use PhpSpec\ObjectBehavior;

/**
 * @todo all specs !
 */
class ImageCreatorSpec extends ObjectBehavior
{
    function let(Html2Pdf $html2pdf, Pdf2Image $pdf2image)
    {
        $html2pdf->generate()->willReturn('file.pdf');
        $pdf2image->convert('file.pdf')->willReturn(new Image);
        
        $this->beConstructedWith($html2pdf, $pdf2image);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(ImageCreator::class);
    }

    function it_can_create_image()
    {
        $this->create([
            ImageCreator::FORMAT => ImageCreator::FORMAT_A4
        ])->shouldHaveType(Image::class);
    }
}
