<?php

declare(strict_types=1);

namespace Partigen\Model;

use Partigen\Model\BlockFactoryInterface;
use Partigen\Model\Block\ScopesBlock;
use Partigen\View\ViewPartitionModel;

final class Partition
{ 
    private const RESOURCES_PATH = __DIR__.'/../../resources';

    private BlockFactoryInterface $factory;
    private ViewPartitionModel $view;

    public function __construct(BlockFactoryInterface $factory, ViewPartitionModel $view)
    {
        $this->factory = $factory;
        $this->view = $view;
    }

    public function getHtml(array $creationParams): string
    {
        $styleHtml = $this->view->style(
            file_get_contents(self::RESOURCES_PATH . '/partition.css')
        );

        $data = $this->getBlocksData();
        $pageHtml = $this->view->page(
            $this->view->convert($data)
        );

        return $styleHtml . $pageHtml;
    }

    private function getBlocksData(): array
    {
        $scopesBlock = $this->factory->create(ScopesBlock::class);

        $blocks = [
            $scopesBlock->g()->getData(),
            $scopesBlock->f()->getData(),
            $scopesBlock->fg()->getData()
        ];

        return $blocks;
    }
}
