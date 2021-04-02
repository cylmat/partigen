<?php

declare(strict_types=1);

namespace Partigen\Library;

use Partigen\Library\Model\Partition;
use Partigen\Library\Bridge\Html2Pdf;
use Partigen\Library\Bridge\Pdf2Image;

class ImageCreator
{
    public const FORMAT = 'format';
    public const FORMAT_A4 = 'A4';

    private const DEBUG_OUTPUT_HTML = false;

    /**
     * @var Html2Pdf
     */
    private $html2pdf;

    /**
     * @var Pdf2Image
     */
    private $pdf2image;

    /**
     * @var Partition
     */
    private $partition;

    public function __construct(Html2Pdf $html2pdf, Pdf2Image $pdf2image, Partition $partition)
    {
        $this->html2pdf = $html2pdf;
        $this->pdf2image = $pdf2image;
        $this->partition = $partition;
    }

    public function create(array $creationParams): string
    {
        self::validateParams($creationParams);

        if (self::DEBUG_OUTPUT_HTML) {
            header("Content-type: text/html");
            echo $this->partition->getHtml();
            die();
        }

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
