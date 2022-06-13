<?php

declare(strict_types=1);

namespace Partigen\Bridge;

use Spipu\Html2Pdf\Html2Pdf as Spipu_Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;

final class Html2Pdf
{
    private const DEBUG_OUTPUT_HTML = false;
    private const RESOURCES_PATH = __DIR__.'/../../resources';
    
    public const FORMATS = ['A4', 'A5'];

    public function setFormat(string $format = 'A4'): self
    {
        $this->format = $format;
        return $this;
    }

    public function generate(string $content): string
    {
        try {
            $html2pdf = new Spipu_Html2Pdf('P', $this->format, 'fr');
            $html2pdf->setDefaultFont('Arial');

            $currentdir = getcwd();
            chdir(self::RESOURCES_PATH);
            $html2pdf->writeHTML($content);
            chdir($currentdir);

            if (self::DEBUG_OUTPUT_HTML) {
                header("Content-type: text/html");
                $html2pdf->output();
                die();
            }

            $pdf = tempnam('/tmp', '');

            if (false !== $pdf && is_string($pdf)) {
                $pdfFile = $pdf . '.pdf';
                $html2pdf->output($pdfFile, 'F'); //in file

                return $pdfFile;
            } else {
                throw new \DomainException("Temporary file '$pdf' was not created");
            }

        } catch (Html2PdfException $e) {
            $html2pdf->clean();
            throw new Html2PdfException($e->getMessage());
        }
    }
}
