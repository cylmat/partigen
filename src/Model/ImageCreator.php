<?php

namespace Partigen\Model;

use Partigen\Model\Image;

class ImageCreator
{
    public function convert(): Image
    {
        $pdf = $this->html2pdf();
        $img = $this->pdf2img($pdf);
        $image = new Image($img);
        return $this->getImage($img);
    }

    private function html2pdf(): string
    {
        try {
            $content = file_get_contents(self::$resource);
        
            $html2pdf = new Html2Pdf('P', 'A4', 'fr');
            $html2pdf->setDefaultFont('Arial');
            $html2pdf->writeHTML($content);

            $pdf = tempnam('/tmp', '') . '.pdf';
            $html2pdf->output($pdf, 'F');

            if (false !== $pdf && is_string($pdf)) {
                return $pdf;
            } else {
                throw new DomainException("Temporary file '$pdf' was not created");
            }

        } catch (Html2PdfException $e) {
            echo $e->getMessage();
            unlink($pdf);
            $html2pdf->clean();
        }
    }

    private function pdf2img(string $pdf): string
    {
        $pdfConverter = new Pdf($pdf);
        $img = tempnam('/tmp', '') . '.png';

        try {
            $pdfConverter->setOutputFormat('png')->saveImage($img);
            unlink($pdf);
        } catch (\Exception $e) {
            unlink($pdf);
            unlink($img);
        }

        return $img;
    }
}
