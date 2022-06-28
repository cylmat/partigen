<?php

declare(strict_types=1);

namespace Partigen\Model;

use Partigen\Config\Params;
use Partigen\Model\Block\PartitionBlock;
use Partigen\View\ViewPartitionModel;

final class PartitionPage
{
    public const RESOURCES_DIRECTORY = __DIR__ . '/../../resources';

    private ViewPartitionModel $view;
    private PartitionBlock $partitionBlock;

    public function __construct(PartitionBlock $partitionBlock, ViewPartitionModel $view)
    {
        $this->view = $view;
        $this->partitionBlock = $partitionBlock;
    }

    public function getHtml(Params $context): string
    {
        $styleHtml = $this->style(
            file_get_contents(self::RESOURCES_DIRECTORY . '/partition.css')
        );

        $data = $this->partitionBlock->getData($context);
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
