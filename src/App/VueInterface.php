<?php

declare(strict_types=1);

namespace Partigen\App;

interface VueInterface
{
    public function render(): string;
}