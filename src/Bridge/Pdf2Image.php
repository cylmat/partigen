<?php

declare(strict_types=1);

namespace Partigen\Bridge;

use Partigen\Factory;

class Pdf2Image
{
    private $factory;

    public function __construct(Factory $factory)
    {
        $this->factory = $factory;
    }

    public function convertContentToRawData(string $pdfRawContent): string
    {
        file_put_contents($pdfFile = tempnam('/tmp', ''), $pdfRawContent);

        try {
            $image = (string)$this->factory->createPdf2Image($pdfFile)->getImageData('php://memory');
            unlink($pdfFile);

            return $image;
        } catch (\Exception $exception) {
            unlink($pdfFile);
            throw $exception;
        }
    }
}
