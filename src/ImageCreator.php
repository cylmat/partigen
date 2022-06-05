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

    private Partition $partition;
    private Html2Pdf $html2pdf;
    private Pdf2Image $pdf2image;

    public function __construct(Partition $partition, Html2Pdf $html2pdf, Pdf2Image $pdf2image)
    {
        $this->partition = $partition;
        $this->html2pdf = $html2pdf;
        $this->pdf2image = $pdf2image;
    }

    public function create(array $creationParams): string
    {
        self::validateParams($creationParams);

        $html = $this->partition->getHtml();
        $pdf = $this->html2pdf->generate($html);
        return $this->pdf2image->convert($pdf);
    }

    private static function validateParams(array $creationParams): void
    {
        if (!array_key_exists(self::FORMAT, $creationParams)) {
            throw new \DomainException('No parameters set to create image');
        }
    }
}
