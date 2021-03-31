<?php

declare(strict_types=1);

namespace Partigen\App\Model;

class Image
{
    /**
     * @var string
     */
    private $filepath;

    /**
     * @var string
     */
    private $format;

    public function setFilepath(string $filepath): self
    {
        $this->filepath = $filepath;

        return $this;
    }

    public function getFilepath(): string
    {
        return $this->filepath;
    }
    
    public function setFormat(string $format): self
    {
        $this->format = $format;

        return $this;
    }

    public function getFormat(): string
    {
        return $this->format;
    }
}
