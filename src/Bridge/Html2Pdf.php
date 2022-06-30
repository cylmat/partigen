<?php

declare(strict_types=1);

namespace Partigen\Bridge;

use Partigen\Factory;
use Partigen\Model\PartitionPage;
use Spipu\Html2Pdf\Exception\Html2PdfException;

class Html2Pdf
{
    public const FORMAT_A4 = 'A4';
    public const FORMAT_A5 = 'A5';

    private const OUTPUT_STRING = 'S';

    private Factory $factory;
    private string $format;

    public function __construct(Factory $factory)
    {
        $this->factory = $factory;
    }

    public function setFormat(string $format = self::FORMAT_A4): self
    {
        $this->format = $format;
        return $this;
    }

    public function generateContent(string $htmlContent): string
    {
        try {
            $html2pdf = $this->factory->createHtml2Pdf($this->format);
            $html2pdf->setDefaultFont('Arial');

            $currentdir = getcwd();
            chdir(PartitionPage::RESOURCES_DIRECTORY); // used to load images
            $html2pdf->writeHTML($htmlContent);
            chdir($currentdir);

            return $html2pdf->output('', self::OUTPUT_STRING);
        } catch (Html2PdfException $e) {
            $html2pdf->clean();
            throw new Html2PdfException($e->getMessage());
        }
    }
}
