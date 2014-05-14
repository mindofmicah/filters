<?php

namespace spec\mindofmicah\Filters;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class FactorySpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('mindofmicah\Filters\Factory');
    }

    public function it_should_throw_an_exception_when_an_undefined_filter_is_passed()
    {
        $this->shouldThrow('Exception')->duringCreate('This is not an allowed rule');
    }

    public function it_should_return_an_equals_formatter_when_there_is_an_equals()
    {
        $this->create('i="tacos"')->shouldHaveType('mindofmicah\Filters\EqualFormatter');
    }
    public function it_should_return_a_contains_formatter_when_there_is_contains()
    {
        $this->create('title contains "animorphs"')->shouldHaveType('mindofmicah\Filters\ContainsFormatter');
    }
    public function it_should_return_a_begins_with_formatter_when_necessary()
    {
        $this->create('title begins with "the"')->shouldHaveType('mindofmicah\Filters\BeginsWithFormatter');
    }
    public function it_should_return_an_in_formatter_when_necessary()
    {
        $this->create('title in "apples", "oranges"')->shouldHaveType('mindofmicah\Filters\InFormatter');
    }
    public function it_should_return_an_sql_string_for_create_as_sql()
    {
        $this->createAsSQL('my=rulestring')->shouldEqual('my=rulestring');
    }
}
