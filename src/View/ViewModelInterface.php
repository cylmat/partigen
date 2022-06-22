<?php

declare(strict_types=1);

namespace Partigen\View;

interface ViewModelInterface
{
    public function convert(array $data): string;
}
