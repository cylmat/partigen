<?php

namespace Partigen\Service;

use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;

class Html2PdfService
{
    private const HTML_FILE = 'partition.html';

    /**
     * @var string
     */
    private $filepath;

    public function __construct()
    {
        $this->filepath = dirname(__FILE__).'/../Resources/' . self::HTML_FILE;
    }

    public function convert(): string
    {
        try {
            $content = file_get_contents($this->filepath);

            $html2pdf = new Html2Pdf('P', $this->creationParams[self::FORMAT], 'fr');
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