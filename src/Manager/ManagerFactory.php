<?php

declare(strict_types=1);

namespace Partigen\Manager;

class ManagerFactory
{
    public static function imageManager(): ImageManager
    {
        return new ImageManager();
    }    
}
