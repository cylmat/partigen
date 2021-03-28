<?php

declare(strict_types=1);

namespace Partigen\Model;

class ModelFactory
{
    public static function image(): Image
    {
        return new Image();
    }
    
    public static function imageCreator(): ImageCreator
    {
        return new ImageCreator();
    }
}
