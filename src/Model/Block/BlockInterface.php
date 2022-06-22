<?php

declare(strict_types=1);

namespace Partigen\Model\Block;

use Partigen\Config\Params;

interface BlockInterface
{
    public function getData(Params $context): array;
}
