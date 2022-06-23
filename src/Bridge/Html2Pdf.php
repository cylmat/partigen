<?php

declare(strict_types=1);

namespace Partigen\Bridge;

use Spipu\Html2Pdf\Html2Pdf as Spipu_Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;

class Html2Pdf
{
    public const FORMAT_A4 = 'A4';
    public const FORMAT_A5 = 'A5';
    
    private const RESOURCES_PATH = __DIR__.'/../../resources'; // @todo remove this
    private const OUTPUT_STRING = 'S';

    public function setFormat(string $format = self::FORMAT_A4): self
    {
        $this->format = $format;
        return $this;
    }

    public function generateContent(string $htmlContent): string
    {
        try {
            $html2pdf = new Spipu_Html2Pdf('P', $this->format);
            $html2pdf->setDefaultFont('Arial');

            $currentdir = getcwd();
            chdir(self::RESOURCES_PATH); //@todo remove this
            $html2pdf->writeHTML($htmlContent);
            chdir($currentdir);

            return $html2pdf->output(null, self::OUTPUT_STRING);
        } catch (Html2PdfException $e) {
            $html2pdf->clean();
            throw new Html2PdfException($e->getMessage());
        }
    }
}
