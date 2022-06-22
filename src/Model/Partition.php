<?php

declare(strict_types=1);

namespace Partigen\Model;

use Partigen\Config\Params;
use Partigen\Model\Block\PartitionBlock;
use Partigen\Model\BlockFactoryInterface;
use Partigen\View\ViewPartitionModel;

final class Partition
{ 
    private const RESOURCES_PATH = __DIR__.'/../../resources';

    private ViewPartitionModel $view;

    public function __construct(BlockFactoryInterface $factory, ViewPartitionModel $view)
    {
        $this->factory = $factory;
        $this->view = $view;
    }

    public function getHtml(Params $context): string
    {
        $styleHtml = $this->view->style(
            file_get_contents(self::RESOURCES_PATH . '/partition.css')
        );

        $data = $this->factory->create(PartitionBlock::class)->getData($context);
        $pageHtml = $this->view->page(
            $this->view->convert($data)
        );

        return $styleHtml . $pageHtml;
    }
}
