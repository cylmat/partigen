<?php

declare(strict_types=1);

namespace Partigen\Model\Block\Traits;

trait ClassTrait
{
    protected string $class = '';

    public function setClass(string $class): self
    {
        $this->class = $class;

        return $this;
    }

    public function addClass(string $class): self
    {
        $this->class .= ' '.$class;

        return $this;
    }
}
    