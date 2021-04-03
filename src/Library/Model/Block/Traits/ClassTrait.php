<?php

declare(strict_types=1);

namespace Partigen\Library\Model\Block\Traits;

trait ClassTrait
{
    /**
     * @var string
     */
    protected $class = '';

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
    