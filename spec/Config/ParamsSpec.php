<?php

namespace spec\Partigen\Config;

use Partigen\Config\Params;
use Partigen\Exceptions\ParamException;
use Partigen\SpecExt\ObjectBehavior;

class ParamsSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Params::class);
    }

    function it_should_init_default()
    {
        $this->initDefault(['scopes' => 'defaults']);
        $this->getDefaultValues()->shouldBe([
            'format' => 'A4',
            'image_ext' => 'png',
            'scopes' => 'defaults',
            'higher_note' => null,
            'lower_note' => null,
            'paired' => null,
        ]);
    }

    function it_should_validates()
    {
        $this->validates([
            'format' => 'A4',
            'image_ext' => 'png',
            'scopes' => 'G',
            'higher_note' => null,
            'lower_note' => null,
            'paired' => '1',
        ]);
        $this->getFormat()->shouldBe('A4');
        $this->getImageExt()->shouldBe('png');
        $this->getScopes()->shouldBe(['G']);
        $this->getHigherNote()->shouldBe('B8');
        $this->getLowerNote()->shouldBe('C0');
        $this->isPaired()->shouldBe(true);
    }

    function it_should_not_validates_not_exists_param()
    {
        $this->shouldThrow(ParamException::class)->duringValidates([
            'not_exists' => 'params'
        ]);
    }

    function it_should_allow_lower_and_higher_note()
    {
        $this->validates([
            'higher_note' => 5,
            'lower_note' => 1,
        ]);
        $this->getHigherNote()->shouldBe(5);
        $this->getLowerNote()->shouldBe(1);
    }

    function it_should_not_allow_lower_higher_than_higher_note()
    {
        $this->shouldThrow(ParamException::class)->duringValidates([
            'higher_note' => 1,
            'lower_note' => 5,
        ]);
    }

    function it_should_not_allow_higher_than_b8()
    {
        $this->shouldThrow(ParamException::class)->duringValidates([
            'higher_note' => 'B9',
            'lower_note' => 'B9',
        ]);
    }
}
