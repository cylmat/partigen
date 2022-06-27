<?php

declare(strict_types=1);

namespace Partigen\Model;

use Partigen\Config\Params;
use Partigen\Model\Block\PartitionBlock;
use Partigen\Model\BlockFactoryInterface;
use Partigen\View\ViewPartitionModel;

final class PartitionPage
{
    public const RESOURCES_DIRECTORY = __DIR__ . '/../../resources';

    private ViewPartitionModel $view;

    public function __construct(BlockFactoryInterface $factory, ViewPartitionModel $view)
    {
        $this->factory = $factory;
        $this->view = $view;
    }

    public function getHtml(Params $context): string
    {
        $styleHtml = $this->style(
            file_get_contents(self::RESOURCES_DIRECTORY . '/partition.css')
        );

        $data = $this->factory->create(PartitionBlock::class)->getData($context);
        $pageHtml = $this->page(
            $this->view->convert($data)
        );

        return $styleHtml . $pageHtml;
    }

    public function style(string $styleContent): string
    {
        return "<style type=\"text/css\">$styleContent</style>";
    }

    public function page(string $pageContent): string
    {
        return "<page>\n$pageContent</page>";
    }
}
