<?php

declare(strict_types=1);

namespace Partigen\Generate;

use Spatie\PdfToImage\Pdf;
use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;

class Image
{
    private const HTML_FILE = 'partition.html';
    private static $resource;

    public static function run() { $img = new Image(); $img->convert(); }

    public function __construct()
    {
       self::$resource = dirname(__FILE__).'/res/' . self::HTML_FILE;
    }

    public function convert()
    {
        $pdf = $this->html2pdf();
        $img = $this->pdf2img($pdf);
        $this->output($img);
    }

    private function html2pdf(): string
    {
        try {
            $content = file_get_contents(self::$resource);
        
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