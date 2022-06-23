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
            return (string)(new Pdf($pdfFile))->getImageData('php://memory');
        } catch (\Exception $exception) {
            unlink($pdfFile);
            throw $exception;
        }
    }
}
