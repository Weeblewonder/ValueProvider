<?php

namespace spec\Weeble\OO;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

use Weeble\OO\ValueProvider;

class ValueProviderSpec extends ObjectBehavior
{
	function let(ValueProvider $vP)
	{
		$this->beConstructedWith('spec\Weeble\OO\ValueObject', ['firstName', 'age']);
	}
    function it_is_initializable()
    {
        $this->shouldHaveType('Weeble\OO\ValueProvider');
    }

    function it_constructs_correctly()
    {
    	$this->getValueClass()->shouldEqual('spec\Weeble\OO\ValueObject');
    	$this->getFields()->shouldHaveCount(2);
    }

    function it_sets_the_value_class_from_string()
    {
    	$this->setValueClass('ValueObject');

    	$this->getValueClass()->shouldEqual('ValueObject');
    }

    function it_sets_the_value_class_from_object()
    {
    	$object = new ValueObject;
    	$this->setValueClass($object);

    	$this->getValueClass()->shouldEqual('spec\Weeble\OO\ValueObject');
    }
}


class ValueObject {

}