<?php

namespace Partigen\Service;

use Partigen\App\Factory;
use Partigen\Model\Image;
use Partigen\Service\Html2PdfService;
use Partigen\Service\Pdf2ImageService;

class ImageCreatorService
{
    const FORMAT = 'format';
    const FORMAT_A4 = 'A4';

    /**
     * @var array
     */
    private $creationParams;

    /**
     * @var Html2PdfService
     */
    private $html2pdf;

    /**
     * @var Pdf2ImageService
     */
    private $pdf2image;

    public function __construct(Pdf2ImageService $pdf2image)
    {
        $pdf2image = 
    }

    public function create(array $creationParams): Image
    {
        $this->validateParams($creationParams);

        $pdf = $this->html2pdf();
        $image = $this->pdf2img($pdf);

        return $image;
    }

    private function validateParams(array $creationParams): void
    {
        if (!array_key_exists(self::FORMAT, $creationParams)) {
            throw new \DomainException('No parameters set to create image');
        }
        $this->creationParams = $creationParams;
    }
}
