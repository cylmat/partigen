<?php

declare(strict_types=1);

namespace Partigen\Model;

use Partigen\Model\Block\BlockInterface;

interface BlockFactoryInterface
{
    public function create(string $blockType): BlockInterface;
}
