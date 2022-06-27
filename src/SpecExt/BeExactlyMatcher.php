<?php

declare(strict_types=1);

namespace Partigen\SpecExt;

use PhpSpec\Exception\Example\FailureException;
use PhpSpec\Matcher\BasicMatcher;

class BeExactlyMatcher extends BasicMatcher
{
    public function supports(string $name, $subject, array $arguments): bool
    {
        return "beExactly" === $name;
    }

    protected function matches($subject, array $arguments): bool
    {
        return $subject === $arguments;
    }

    protected function getFailureException(string $name, $subject, $arguments): FailureException
    {
        ob_start();
        var_dump($subject);
        $subject_dump = ob_get_clean();

        return new FailureException(
            sprintf(
                "\nExpected \n'%s'\n\n Doesn't match \n'%s'",
                $subject_dump,
                var_export($arguments[0], true)
            )
        );
    }

    protected function getNegativeFailureException(string $name, $subject, $arguments): FailureException
    {
        /*ob_start();
        var_dump($subject);
        $subject_dump = ob_get_clean();

        return new FailureException(
            sprintf("\nExpected \n'%s'\n\n Doesn't match \n'%s'",
                $subject_dump,
                var_export($arguments, true)
            )
        );*/
    }
}
