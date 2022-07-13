<?php

namespace spec\Partigen\Model\Block;

use Partigen\Config\Params;
use Partigen\DataValue\ScopeF;
use Partigen\DataValue\ScopeG;
use Partigen\Model\Block\NotesBlock;
use Partigen\Service\Baseline;
use Partigen\Service\Randomizer;
use Partigen\SpecExt\ObjectBehavior;
use PhpSpec\Exception\Example\FailureException;

class NotesBlockSpec extends ObjectBehavior
{
    private static $diffScopeLineG = 2;
    private static $diffScopeLineF = 6;

    function let()
    {
        $this->beConstructedWith(new Baseline(), new Randomizer());
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(NotesBlock::class);
    }

    function it_should_return_G_higher_bound()
    {
        $this->setScopeData(new ScopeG());
        $params = (new Params)->validates([
            'higher_note' => '3',
            'lower_note' => '0',
        ]);

        $this->getData($params)->shouldHaveCount(30);
        $this->getData($params)->shouldHaveHighsValuesBetween(static::$diffScopeLineG, static::$diffScopeLineG + 3);
    }

    function it_should_return_F_lower_bound()
    {
        $this->setScopeData(new ScopeF());
        $params = (new Params)->validates([
            'higher_note' => '0',
            'lower_note' => '-3',
        ]);

        $this->getData($params)->shouldHaveCount(30);
        $this->getData($params)->shouldHaveHighsValuesBetween(static::$diffScopeLineF - 3, static::$diffScopeLineF);
    }

    function it_should_not_be_out_of_paired()
    {
        $params = (new Params)->validates([
            'paired' => '1',
        ]);

        $this->setScopeData(new ScopeG());
        $this->getData($params)->shouldHaveHighsValuesBetween(-2, static::$diffScopeLineG + 50);

        $this->setScopeData(new ScopeF());
        $this->getData($params)->shouldHaveHighsValuesBetween(static::$diffScopeLineF - 50, (8) + 2);
    }

    public function getMatchers(): array
    {
        return [
            // use should
            'haveHighsValuesBetween' => function($subject, int $min, int $max) {
                foreach ($subject as $value) {
                    $diffNote = $value['highs'][0];
                    if ($diffNote < $min || $max < $diffNote) {
                        throw new FailureException(sprintf(
                            'Value %d not between %d and %d',
                            $diffNote, $min, $max
                        ));
                    }
                }
                return true;
            }
        ];
    }
}
