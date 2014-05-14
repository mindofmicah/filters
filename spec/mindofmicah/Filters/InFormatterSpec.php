<?php

namespace spec\mindofmicah\Filters;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class InFormatterSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith('title in "apples"');
    }
    function it_is_initializable()
    {
        $this->shouldHaveType('mindofmicah\Filters\InFormatter');
    }
    public function it_needs_to_be_formattable()
    {
        $this->shouldImplement('mindofmicah\Filters\FormatableInterface');
    }
    public function it_should_handle_a_perfect_string_with_a_single_element()
    {
        $this->beConstructedWith('title in "apples"');
        $this->formatAsSQL()->shouldEqual('title IN("apples")');
    }
    public function it_should_not_be_affected_by_leading_spaces()
    {
        $this->beConstructedWith('       title in "apples"');
        $this->formatAsSQL()->shouldEqual('title IN("apples")');
    }
    public function it_should_not_be_affected_by_trailing_spaces()
    {
        $this->beConstructedWith('title in "apples"        ');
        $this->formatAsSQL()->shouldEqual('title IN("apples")');
    }

    public function it_should_handle_multiple_items_in_a_list()
    {
        $this->beConstructedWith('title in "apples", "oranges"');
        $this->formatAsSQL()->shouldEqual('title IN("apples", "oranges")');
    }
}
