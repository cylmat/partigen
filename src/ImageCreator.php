<?php

declare(strict_types=1);

namespace Partigen;

use DI\Container;
use Partigen\Model\Partition;
use Partigen\Bridge\Html2Pdf;
use Partigen\Bridge\Pdf2Image;

final class ImageCreator
{
    public const FORMAT = 'format';
    public const FORMAT_A4 = 'A4';

    private Partition $partition;
    private Html2Pdf $html2pdf;
    private Pdf2Image $pdf2image;

    public static function generate(array $creationParams = []): string
    {
        $path = (new Container())->get(self::class)->create($creationParams);

        if (file_exists($path)) {
            header('Content-Type: image/png');
            readfile($path);
            unlink($path);
        } else {
            throw new \Exception("Image not generated!");
        }

        return $path;
    }

    public function create(array $creationParams = []): string
    {
        self::validateParams($creationParams);

        $html = $this->partition->getHtml();
        $pdf = $this->html2pdf->generate($html);
        return $this->pdf2image->convert($pdf);
    }

    public function __construct(Partition $partition, Html2Pdf $html2pdf, Pdf2Image $pdf2image)
    {
        $this->partition = $partition;
        $this->html2pdf = $html2pdf;
        $this->pdf2image = $pdf2image;
    }

    private static function validateParams(array $creationParams): void
    {
        if (!array_key_exists(self::FORMAT, $creationParams)) {
            throw new \DomainException('No parameters set to create image');
        }
    }
}
