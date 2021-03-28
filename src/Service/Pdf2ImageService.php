<?php

namespace Partigen\Service;

use Partigen\App\Factory;
use Partigen\Model\Image;
use Spatie\PdfToImage\Pdf;

class Pdf2ImageService
{
    public function convert(string $pdf): Image
    {
        $pdfConverter = new Pdf($pdf);
        $imgPath = tempnam('/tmp', '') . '.png';

        $image = (Factory::Image())
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
