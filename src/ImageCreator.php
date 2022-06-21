<?php

declare(strict_types=1);

namespace Partigen;

use Partigen\Model\Partition;
use Partigen\Bridge\Html2Pdf;
use Partigen\Bridge\Pdf2Image;

class ImageCreator
{
    public const FORMAT = 'format';
    public const FORMAT_A4 = 'A4';

    private Html2Pdf $html2pdf;
    private Pdf2Image $pdf2image;
    private Partition $partition;

    public function __construct(Html2Pdf $html2pdf, Pdf2Image $pdf2image, Partition $partition)
    {
        $this->html2pdf = $html2pdf;
        $this->pdf2image = $pdf2image;
        $this->partition = $partition;
    }

    public function create(array $creationParams): string
    {
        self::validateParams($creationParams);

        $pdf = $this->html2pdf->generate($this->partition->getHtml());
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
