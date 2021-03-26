<?php

namespace Partigen\Manager;

use Partigen\Model\ImageCreator;
use Spatie\PdfToImage\Pdf;
use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;

class ImageManager
{
    private const HTML_FILE = 'partition.html';
    private static $resource;

    public function __construct()
    {
        self::$resource = dirname(__FILE__).'/res/' . self::HTML_FILE;
    }

    public function generate(): Image
    {
        $img = $this->convert();
        return new Image;
    }
}
