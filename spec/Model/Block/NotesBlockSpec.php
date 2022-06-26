<?php

namespace spec\Partigen\Model\Block;

use Partigen\Config\Params;
use Partigen\DataValue\ScopeDataInterface;
use Partigen\Model\Block\NotesBlock;
use Partigen\Service\Baseline;
use Partigen\Service\Randomizer;
use PhpSpec\Exception\Example\FailureException;
use PhpSpec\ObjectBehavior;

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

    function it_should_return_scopeline_for_G(ScopeDataInterface $scopeData)
    {
        $scopeData->getScopeLine()->willReturn('G3');
        $scopeData->getBaseLine()->willReturn('E3');
        $this->setScopeData($scopeData);

        $params = (new Params())
            ->validates([
                'higher_note' => '0',
                'lower_note' => '0'
            ]);

        $this->getData($params)->shouldHaveCount(24);
        $diffBaseScopeG = 2;
        $this->getData($params)->shouldHaveHighsValuesBetween($diffBaseScopeG, $diffBaseScopeG);
    }

    function it_should_return_scopeline_for_F(ScopeDataInterface $scopeData)
    {
        $scopeData->getScopeLine()->willReturn('F2');
        $scopeData->getBaseLine()->willReturn('G1');
        $this->setScopeData($scopeData);

        $params = (new Params())
            ->validates([
                'higher_note' => '0',
                'lower_note' => '0'
            ]);

        $this->getData($params)->shouldHaveCount(24);
        $diffBaseScopeF = 6;
        $this->getData($params)->shouldHaveHighsValuesBetween($diffBaseScopeF, $diffBaseScopeF);
    }

    public function getMatchers(): array
    {
        return [
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
