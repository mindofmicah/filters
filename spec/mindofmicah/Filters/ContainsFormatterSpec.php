<?php

namespace spec\mindofmicah\Filters;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ContainsFormatterSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith('title contains "Animorphs"');
    }
    function it_is_initializable()
    {
        $this->shouldHaveType('mindofmicah\Filters\ContainsFormatter');
    }
    public function it_should_be_formattable()
    {
        $this->shouldImplement('mindofmicah\Filters\FormatableInterface');
    }
    public function it_should_handle_a_perfectly_formatted_statement()
    {
        $this->beConstructedWith('title contains "Animorphs"');
        $this->formatAsSQL()->shouldEqual('title LIKE "%Animorphs%"');
    }
    public function it_should_handle_leading_spaces()
    {
        $this->beConstructedWith('      title contains "Animorphs"'); 
        $this->formatAsSQL()->shouldEqual('title LIKE "%Animorphs%"');
    }
    public function it_should_handle_trailing_spaces()
    {
        $this->beConstructedWith('title contains "Animorphs"    ');
        $this->formatAsSQL()->shouldEqual('title LIKE "%Animorphs%"');
    }
}
