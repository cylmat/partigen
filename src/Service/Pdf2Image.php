<?php

namespace Partigen\Service;

use Partigen\Model\Image;
use Spatie\PdfToImage\Pdf;

class Pdf2Image
{
    /**
     * @var Image
     */
    private $image;

    public function __construct(Image $image)
    {
        $this->image = $image;
    }

    public function convert(string $pdf): Image
    {
        $pdfConverter = new Pdf($pdf);
        $imgPath = tempnam('/tmp', '') . '.png';

        $image = $this->image
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
