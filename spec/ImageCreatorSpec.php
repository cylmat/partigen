<?php

namespace spec\Partigen;

use Partigen\ImageCreator;
use Partigen\Bridge\Html2Pdf;
use Partigen\Bridge\Pdf2Image;
use Partigen\Config\Params;
use Partigen\Model\PartitionPage;
use Partigen\SpecExt\ObjectBehavior;
use Prophecy\Argument;

class ImageCreatorSpec extends ObjectBehavior
{
    function let(Html2Pdf $html2pdf, Pdf2Image $pdf2image)
    {
        $container = $this->getContainer();

        $html2pdf->setFormat(Argument::type('string'))->willReturn($html2pdf);
        $html2pdf->generateContent(Argument::type('string'))->willReturn('');
        $pdf2image->convertContentToRawData(Argument::type('string'))->willReturn('');
        
        $this->beConstructedWith(
            $container->get(Params::class),
            $container->get(PartitionPage::class),
            $html2pdf,
            $pdf2image
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(ImageCreator::class);
    }

    function it_can_create()
    {
        $this->create();
    }
}
