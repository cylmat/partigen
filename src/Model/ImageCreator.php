<?php

namespace Partigen\Model;

use Partigen\Model\Image;
use Spatie\PdfToImage\Pdf;
use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;

class ImageCreator
{
    private const HTML_FILE = 'partition.html';

    /**
     * @var Image
     */
    private $image;

    /**
     * @var string
     */
    private $filepath;

    public function __construct(Image $image)
    {
        $this->filepath = dirname(__FILE__).'/../Resources/' . self::HTML_FILE;
        $this->image = $image;
    }

    public function create(): Image
    {
        $pdf = $this->html2pdf();
        $img = $this->pdf2img($pdf);
        return $this->image;
    }

    private function html2pdf(): string
    {
        try {
            $content = file_get_contents($this->filepath);
        
            $html2pdf = new Html2Pdf('P', 'A4', 'fr');
            $html2pdf->setDefaultFont('Arial');
            $html2pdf->writeHTML($content);

            $pdf = tempnam('/tmp', '') . '.pdf';
            $html2pdf->output($pdf, 'F');

            if (false !== $pdf && is_string($pdf)) {
                return $pdf;
            } else {
                throw new DomainException("Temporary file '$pdf' was not created");
            }

        } catch (Html2PdfException $e) {
            echo $e->getMessage();
            unlink($pdf);
            $html2pdf->clean();
        }
    }

    private function pdf2img(string $pdf): string
    {
        $pdfConverter = new Pdf($pdf);
        $img = tempnam('/tmp', '') . '.png';

        try {
            $pdfConverter->setOutputFormat('png')->saveImage($img);
            unlink($pdf);
        } catch (\Exception $e) {
            unlink($pdf);
            unlink($img);
        }

        return $img;
    }
}
