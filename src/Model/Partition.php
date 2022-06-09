<?php

declare(strict_types=1);

namespace Partigen\Model;

use Partigen\Model\BlockFactoryInterface;
use Partigen\Model\Block\GlobalBlock;
use Partigen\View\ViewModel;

final class Partition
{ 
    private const RESOURCES_PATH = __DIR__.'/../../resources';

    private BlockFactoryInterface $factory;
    private ViewModel $view;

    public function __construct(BlockFactoryInterface $factory, ViewModel $view)
    {
        $this->factory = $factory;
        $this->view = $view;
    }

    public function getHtml(): string
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
        $globalBlock = $this->factory->create(GlobalBlock::class);

        $g = $globalBlock->g();
        $f = $globalBlock->f();

        $blocks = [
            $g->getData(),
            $f->getData()
        ];

        return $blocks;
    }
}
