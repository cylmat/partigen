<?php

namespace spec\Partigen\Model\Block;

use Partigen\Config\Params;
use Partigen\DataValue\ScopeG;
use Partigen\Model\Block\NotesBlock;
use Partigen\Service\Baseline;
use Partigen\Service\Randomizer;
use Partigen\SpecExt\ObjectBehavior;
use PhpSpec\Exception\Example\FailureException;

class NotesBlockSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(new Baseline(), new Randomizer());
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(NotesBlock::class);
    }

    function it_should_return_scopeline_for_G(ScopeG $scopeData)
    {
        $scopeData->getScopeLine()->willReturn('G3');
        $scopeData->getBaseLine()->willReturn('E3');
        $this->setScopeData($scopeData);

        $params = (new Params)->validates([
            'higher_note' => '3',
            'lower_note' => '0',
        ]);

        $diffScopeLineG = 2;
        $this->getData($params)->shouldHaveCount(30);
        $this->getData($params)->shouldHaveHighsValuesBetween($diffScopeLineG, $diffScopeLineG + 3);
    }

    function it_should_return_scopeline_for_F(ScopeG $scopeData)
    {
        $scopeData->getScopeLine()->willReturn('F2');
        $scopeData->getBaseLine()->willReturn('G1');
        $this->setScopeData($scopeData);

        $params = (new Params)->validates([
            'higher_note' => '0',
            'lower_note' => '-3',
        ]);

        $diffScopeLineF = 6;
        $this->getData($params)->shouldHaveCount(30);
        $this->getData($params)->shouldHaveHighsValuesBetween($diffScopeLineF - 3, $diffScopeLineF);
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
