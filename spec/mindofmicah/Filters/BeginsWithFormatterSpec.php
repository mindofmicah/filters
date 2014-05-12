<?php

namespace spec\mindofmicah\Filters;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class BeginsWithFormatterSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith('title begins with "the"');
    }
    function it_is_initializable()
    {
        $this->shouldHaveType('mindofmicah\Filters\BeginsWithFormatter');
    }
    public function it_should_be_formatable()
    {
        $this->shouldImplement('mindofmicah\Filters\FormatableInterface');
    }
    public function it_should_format_on_a_perfect_string()
    {
        $this->formatAsSQL()->shouldEqual('title LIKE "the%"');
    }
    public function it_should_ignore_leading_spaces()
    {
        $this->beConstructedWith('        title begins with "the"');
        $this->formatAsSQL()->shouldEqual('title LIKE "the%"');
    }
    public function it_should_ignore_trailing_spaces()
    {
        $this->beConstructedWith('title begins with "the"     ');
        $this->formatAsSQL()->shouldEqual('title LIKE "the%"');
    }

    public function it_should_ignore_internal_spaces()
    {
        $this->beConstructedWith('title   begins with  "the"');
        $this->formatAsSQL()->shouldEqual('title LIKE "the%"');

    }
}
