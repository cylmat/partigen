<?php

declare(strict_types=1);

namespace Partigen\Model\Block;

interface BlockInterface
{
    public function getData(): array;
}