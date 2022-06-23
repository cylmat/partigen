<?php

declare(strict_types=1);

namespace Partigen\Bridge;

use Spatie\PdfToImage\Pdf;

class Pdf2Image
{
    public function convertContentToRawData(string $pdfRawContent): string
    {
        file_put_contents($pdfFile = tempnam('/tmp', ''), $pdfRawContent);

        try {
            $image = (string)(new Pdf($pdfFile))->getImageData('php://memory');
            unlink($pdfFile);

            return $image;
        } catch (\Exception $exception) {
            unlink($pdfFile);
            throw $exception;
        }
    }
}
