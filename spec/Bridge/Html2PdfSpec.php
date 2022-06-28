<?php

namespace spec\Partigen\Bridge;

use Partigen\Bridge\Html2Pdf;
use Partigen\Factory;
use PhpSpec\ObjectBehavior;
use PhpSpec\Wrapper\Collaborator;
use Spipu\Html2Pdf\Html2Pdf as Spipu_Html2Pdf;

class Html2PdfSpec extends ObjectBehavior
{
    private Collaborator $factory;

    function let(Factory $factory)
    {
        $this->factory = $factory;
        
        $this->beConstructedWith($factory);
        $this->setFormat('A4');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Html2Pdf::class);
    }

    function it_can_generate_content(Spipu_Html2Pdf $html2pdf)
    {
        $html2pdf->setDefaultFont('Arial')->shouldBeCalled();
        $html2pdf->output('', 'S')->willReturn('pdf-content');
        $html2pdf->writeHTML('content')->shouldBeCalled();
        $this->factory->createHtml2Pdf('A4')->willReturn($html2pdf);

        $this->generateContent('content')->shouldBe('pdf-content');
    }
}