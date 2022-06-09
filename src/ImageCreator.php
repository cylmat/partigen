<?php

declare(strict_types=1);

namespace Partigen;

use DI\ContainerBuilder;
use Partigen\Model\Partition;
use Partigen\Bridge\Html2Pdf;
use Partigen\Bridge\Pdf2Image;
use Partigen\Model\BlockFactory;
use Partigen\Model\BlockFactoryInterface;

final class ImageCreator
{
    public const FORMAT = 'format';
    public const FORMAT_A4 = 'A4';

    private Partition $partition;
    private Html2Pdf $html2pdf;
    private Pdf2Image $pdf2image;

    private string $path;

    public static function generate(array $creationParams = []): self
    {
        $container = (new ContainerBuilder())
            ->addDefinitions([
                BlockFactoryInterface::class => \DI\autowire(BlockFactory::class),
            ]);
        return $container->build()->get(self::class)->create($creationParams);
    }

    public function __construct(Partition $partition, Html2Pdf $html2pdf, Pdf2Image $pdf2image)
    {
        $this->partition = $partition;
        $this->html2pdf = $html2pdf;
        $this->pdf2image = $pdf2image;
    }

    public function create(array $creationParams = []): self
    {
        self::validateParams($creationParams);

        try {
            $html = $this->partition->getHtml();
            $pdf = $this->html2pdf->generate($html);
            $this->path = $this->pdf2image->convert($pdf);

            return $this;
        } catch (\Exception $exception) {
            throw new \Exception("Image not generated: " . $exception->getMessage());
        }
    }

    private static function validateParams(array $creationParams): void
    {
        if (!array_key_exists(self::FORMAT, $creationParams)) {
            throw new \DomainException('No parameters set to create image');
        }
    }

    public function display($ext = 'png'): void
    {
        if (file_exists($this->path)) {
            header('Content-Type: image/' . $ext);
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
