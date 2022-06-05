<?php

declare(strict_types=1);

namespace Partigen\Model;

use DI\Container;
use Partigen\Model\Block\BlockInterface;

class BlockFactory
{
    private $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function create(string $blockType): BlockInterface
    {
        return $this->container->get($blockType);
    }
}
