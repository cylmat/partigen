<?php

declare(strict_types=1);

namespace Partigen\Library\Bridge;

use Spatie\PdfToImage\Pdf;

class Pdf2Image
{
    public function convert(string $pdf): string
    {
        $pdfConverter = new Pdf($pdf);
        $imgPath = tempnam('/tmp', '') . '.png';

        try {
            $pdfConverter->setOutputFormat('png')->saveImage($imgPath);
            unlink($pdf);
        } catch (\Exception $e) {
            unlink($pdf);
            unlink($imgPath);
        }

        return $imgPath;
    }
}
