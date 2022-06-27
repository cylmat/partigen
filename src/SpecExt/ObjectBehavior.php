<?php

declare(strict_types=1);

namespace Partigen\SpecExt;

use PhpSpec\ObjectBehavior as PhpSpecObjectBehavior;
use Prophecy\Prophecy\ObjectProphecy;
use Prophecy\Prophet;

class ObjectBehavior extends PhpSpecObjectBehavior
{
    protected function prophesize(string $class): ObjectProphecy
    {
        return (new Prophet())->prophesize($class);
    }
}
