<?php

namespace Partigen\Service;

use Partigen\Model\Image;
use Partigen\Service\Html2Pdf;
use Partigen\Service\Pdf2Image;

class ImageCreator
{
    const FORMAT = 'format';
    const FORMAT_A4 = 'A4';

    /**
     * @var Html2Pdf
     */
    private $html2pdf;

    /**
     * @var Pdf2Image
     */
    private $pdf2image;

    public function __construct(Html2Pdf $html2pdf, Pdf2Image $pdf2image)
    {
        $this->html2pdf = $html2pdf;
        $this->pdf2image = $pdf2image;
    }

    public function create(array $creationParams): Image
    {
        self::validateParams($creationParams);

        $pdf = $this->html2pdf->generate();
        $image = $this->pdf2image->convert($pdf);

        return $image;
    }

    private static function validateParams(array $creationParams): void
    {
        if (!array_key_exists(self::FORMAT, $creationParams)) {
            throw new \DomainException('No parameters set to create image');
        }
    }
}
