<?php

namespace spec\mindofmicah\Filters;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class EqualFormatterSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith('me="whamdonk"');
    }
    public function it_is_initializable()
    {
        $this->shouldHaveType('mindofmicah\Filters\EqualFormatter');
    }
    public function it_should_be_formatable()
    {
        $this->shouldImplement('mindofmicah\Filters\FormatableInterface');
    }
    public function it_should_format_the_rule_when_given_no_spaces()
    {
        $this->beConstructedWith('me="whamdonk"');
        $this->formatAsSQL()->shouldEqual('me="whamdonk"');
    }
    public function it_should_format_the_rule_when_given_leading_spaces()
    {
       $this->beConstructedWith('    me="whamdonk"'); 
       $this->formatAsSQL()->shouldEqual('me="whamdonk"');
    }

    public function it_should_format_the_rule_when_given_tailing_spaces()
    {
        $this->beConstructedWith('me="whamdonk"    ');
        $this->formatAsSQL()->shouldEqual('me="whamdonk"');
    }

    public function it_should_format_the_rule_when_given_interior_spacing()
    {
        $this->beConstructedWith('me     = "whamdonk"');
        $this->formatAsSQL()->shouldEqual('me="whamdonk"');
    }

    public function it_should_allow_spaces_around_equals_signs_in_the_quoted_string()
    {
        $this->beConstructedWith('me = "wham = donk"');
        $this->formatAsSQL()->shouldEqual('me="wham = donk"');
    }
}
