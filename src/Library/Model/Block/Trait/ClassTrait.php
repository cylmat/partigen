<?php

namespace Partigen\Library\Model\Block\Trait;

trait ClassTrait
{
    /**
     * @var string
     */
    private $class = '';

    public function setClass(string $class): self
    {
        $this->class = $class;

        return $this;
    }
}
    