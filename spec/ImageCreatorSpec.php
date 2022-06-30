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
    private $params;
    private $partition;
    private $html2pdf;
    private $pdf2image;

    function let(
        Params $params,
        PartitionPage $partition,
        Html2Pdf $html2pdf,
        Pdf2Image $pdf2image
    ) {
        $this->params = $params;
        $this->partition = $partition;
        $this->html2pdf = $html2pdf;
        $this->pdf2image = $pdf2image;

        $this->beConstructedWith(
            $this->params,
            $this->partition,
            $this->html2pdf,
            $this->pdf2image
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(ImageCreator::class);
    }

    function it_can_create()
    {
        $this->params->getFormat()->willReturn('A4');
        $this->params->validates(Argument::any())->shouldBeCalled();
        $this->partition->getHtml($this->params)->willReturn('partition-html');

        $this->html2pdf->setFormat('A4')->willReturn($this->html2pdf);
        $this->html2pdf->generateContent('partition-html')->willReturn('pdf-content');
        $this->pdf2image->convertContentToRawData('pdf-content')->willReturn('image-content');

        $this->create()->shouldImplement($this);
    }
}
