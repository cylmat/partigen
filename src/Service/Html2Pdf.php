<?php

namespace Partigen\Service;

use Spipu\Html2Pdf\Html2Pdf as Spipu_Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;

class Html2Pdf
{
    private const HTML_FILE = 'partition.html';

    /**
     * @var string
     */
    private $format = 'A4';

    /**
     * @var string
     */
    private static $filepath;

    public function __construct()
    {
        self::$filepath = dirname(__FILE__).'/../Resources/' . self::HTML_FILE;
    }

    public function setFormat(string $format): self
    {
        $this->format = $format;

        return $this;
    }

    public function getFormat(): string
    {
        return $this->format;
    }

    public function generate(): string
    {
        try {
            $content = file_get_contents(self::$filepath);

            $html2pdf = new Spipu_Html2Pdf('P', $this->getFormat(), 'fr');
            $html2pdf->setDefaultFont('Arial');
            $html2pdf->writeHTML($content);

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
