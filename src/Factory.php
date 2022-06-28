<?php

namespace Partigen;

use DI\Container;
use Partigen\DataValue\ScopeDataInterface;
use Partigen\Model\Block\BlockInterface;
use Spatie\PdfToImage\Pdf;
use Spipu\Html2Pdf\Html2Pdf;

final class Factory
{
    private Container $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function createHtml2Pdf(string $format): Html2Pdf
    {
        return new Html2Pdf('P', $format);
    }

    public function createPdf2Image(string $pdfFile): Pdf
    {
        return new Pdf($pdfFile);
    }

    public function createBlock(string $blockType): BlockInterface
    {
        return $this->container->get($blockType);
    }

    public function createScopeData(string $scopeType): ScopeDataInterface
    {
        $class = __NAMESPACE__ . '\\DataValue\\Scope' . $scopeType;
        return new $class();
    }
}
