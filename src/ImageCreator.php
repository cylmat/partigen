<?php

declare(strict_types=1);

namespace Partigen;

use DI\ContainerBuilder;
use Partigen\Bridge\Html2Pdf;
use Partigen\Bridge\Pdf2Image;
use Partigen\Config\Params;
use Partigen\Model\BlockFactory;
use Partigen\Model\BlockFactoryInterface;
use Partigen\Model\Partition;

final class ImageCreator
{
    private Params $params;
    private Html2Pdf $html2pdf;
    private Pdf2Image $pdf2image;
    private Partition $partition;

    private string $image;

    public static function generate(array $creationParams = []): self
    {
        $container = (new ContainerBuilder())
            ->addDefinitions([
                BlockFactoryInterface::class => \DI\autowire(BlockFactory::class),
            ]);
        return $container->build()->get(self::class)->create($creationParams);
    }

    public function __construct(
        Params $params,
        Partition $partition,
        Html2Pdf $html2pdf,
        Pdf2Image $pdf2image
    ) {
        $this->params = $params;
        $this->partition = $partition;
        $this->html2pdf = $html2pdf;
        $this->pdf2image = $pdf2image;
    }

    public function create(array $creationParams = []): self
    {
        $this->params->validates($creationParams);

        try {
            $htmlContent = $this->partition->getHtml($this->params);
            $pdfContent = $this->html2pdf
                ->setFormat($this->params->getFormat())
                ->generateContent($htmlContent);
            $this->image = $this->pdf2image->convertContentToRawData($pdfContent);

            return $this;
        } catch (\Exception $exception) {
            throw new \Exception("Image not generated: " . $exception->getMessage());
        }
    }

    public function display(): void
    {
        header('Content-Type: image/' . $this->params->getImageExt());
        echo $this->image;
        die();
    }

    public function download()
    {
        $format = "Partigen-" . (new \DateTime())->format('Ymd');

        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header("Content-Disposition: attachment; filename=$format");
        header('Content-Length: '.strlen($this->image));
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Expires: 0');

        echo $this->image;
        die();
    }
}
