<?php

namespace spec\mindofmicah\Filters;

use mindofmicah\Filters\Factory;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class FormatterSpec extends ObjectBehavior
{
    public function let(Factory $factory)
    {
        $this->beConstructedWith($factory);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType('mindofmicah\Filters\Formatter');
    }

    public function it_should_trim_the_passed_in_rules()
    {
        $inputs = array('', ' ','    ');
        foreach ($inputs as $input) {
            $this->setRules($input)->getRules()->shouldBe('');
        }

        $inputs = array('    hello','hello   ','  hello  ');
        foreach ($inputs as $input) {
            $this->setRules($input)->getRules()->shouldBe('hello');
        }
    }

    public function it_can_be_constructed_without_rules()
    {
        $this->getRules()->shouldBe('');
    }

    public function it_can_be_constructed_with_rules(Factory $factory)
    {
        $this->beConstructedWith($factory, 'i love brand new carpets');
        $this->getRules()->shouldBe('i love brand new carpets');
    }

    public function it_should_be_able_to_have_rules_set()
    {
        $rules = 'I like tacos';
        $this->setRules($rules);
        $this->getRules()->shouldBe($rules);
    }
    public function it_should_have_setters_that_are_chainable()
    {
        $this->setRules('')->shouldBe($this);
    }

    public function it_should_return_an_empty_string_for_an_empty_ruleset()
    {
        $this->formatAsWhereClause()->shouldBe('');
    }

    public function it_uses_the_factory_to_handle_decisions(Factory $factory)
    {
        $factory->createAsSQL('Any="here"')->willReturn('Any="here"')->shouldBeCalledTimes(1);
        $this->beConstructedWith($factory, 'Any="here"');

        $this->formatAsWhereClause()->shouldEqual('Any="here"');
    }
    public function it_needs_to_handle_ANDd_lines_of_rules(Factory $factory)
    {
        $factory->createAsSQL('this="that"')->willReturn('this="that"')->shouldBeCalledTimes(1);
        $factory->createAsSQL('apples="oranges"')->willReturn('apples="oranges"')->shouldBeCalledTimes(1);
        $this->beConstructedWith($factory, "this=\"that\"\nand apples=\"oranges\"");
        $this->formatAsWhereClause()->shouldEqual('this="that" AND apples="oranges"');
    }

    public function it_should_be_able_to_handle_ORd_lines(Factory $factory)
    {
        $factory->createAsSQL('title contains "the"')->willReturn('title LIKE "%the%"')->shouldBeCalledTimes(1);
        $factory->createAsSQL('apples="oranges"')->willReturn('apples="oranges"')->shouldBeCalledTimes(1);


        $this->setRules("title contains \"the\"\nor apples=\"oranges\"")->formatAsWhereClause()->shouldBe('title LIKE "%the%" OR apples="oranges"');
    }

    public function it_should_ignore_empty_lines_when_processing_rules(Factory $factory)
    {
        $factory->createAsSQL('type = "books"')->willReturn('type="books"')->shouldBeCalledTimes(1);
        $factory->createAsSQL("")->shouldNotBeCalled();
        $this->beConstructedWith($factory, "type = \"books\"\n");
        $this->formatAsWhereClause()->shouldBe('type="books"');
    }
}
