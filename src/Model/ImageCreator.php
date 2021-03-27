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

    const FORMAT = 'format';
    const FORMAT_A4 = 'A4';

    /**
     * @var array
     */
    private $creationParams;

    /**
     * @var string
     */
    private $filepath;

    public static function factoryImage(): Image
    {
        return new Image();
    }

    public function __construct()
    {
        $this->filepath = dirname(__FILE__).'/../Resources/' . self::HTML_FILE;
    }

    public function create(array $creationParams): Image
    {
        $this->validateParams($creationParams);

        $pdf = $this->html2pdf();
        $image = $this->pdf2img($pdf);

        return $image;
    }

    private function validateParams(array $creationParams): void
    {
        if (!array_key_exists(self::FORMAT, $creationParams)) {
            throw new \DomainException('No parameters set to create image');
        }
        $this->creationParams = $creationParams;
    }

    private function html2pdf(): string
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

    private function pdf2img(string $pdf): Image
    {
        $pdfConverter = new Pdf($pdf);
        $imgPath = tempnam('/tmp', '') . '.png';

        $image = (self::factoryImage())
            ->setFormat('A4')
            ->setFilepath($imgPath);

        try {
            $pdfConverter->setOutputFormat('png')->saveImage($imgPath);
            unlink($pdf);
        } catch (\Exception $e) {
            unlink($pdf);
            unlink($imgPath);
        }

        return $image;
    }
}
