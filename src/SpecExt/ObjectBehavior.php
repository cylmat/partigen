<?php

declare(strict_types=1);

namespace Partigen\SpecExt;

use DG\BypassFinals;
use PhpSpec\ObjectBehavior as PhpSpecObjectBehavior;
use Prophecy\Prophecy\ObjectProphecy;
use Prophecy\Prophet;

class ObjectBehavior extends PhpSpecObjectBehavior
{
    public function __construct()
    {
        BypassFinals::enable();
    }

    protected function prophesize(string $class): ObjectProphecy
    {
        return (new Prophet())->prophesize($class);
    }
}
