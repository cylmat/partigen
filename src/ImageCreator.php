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

    private string $path;

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
            $html = $this->partition->getHtml($this->params);
            $pdf = $this->html2pdf->setFormat($this->params->getFormat())->generate($html);
            $this->path = $this->pdf2image->convert($pdf);

            return $this;
        } catch (\Exception $exception) {
            throw new \Exception("Image not generated: " . $exception->getMessage());
        }
    }

    public function display(): void
    {
        if (file_exists($this->path)) {
            header('Content-Type: image/' . $this->params->getImageExt());
            readfile($this->path);
            $this->remove();
        } else {
            throw new \Exception("Image not generated!");
        }
    }

    public function remove(): ?bool
    {
        if (file_exists($this->path)) {
            return unlink($this->path);
        }

        return null;
    }

    public function getPath(): string
    {
        if (null === $this->path) {
            throw new \Exception("Image was not created yet!");
        }

        return $this->path;
    }
}
