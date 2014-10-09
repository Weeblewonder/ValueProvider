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

    function it_provides_value_object_from_db_model()
    {
    	$dbModel = new DbModel;
    	$this->provideValue($dbModel)->shouldReturnAnInstanceOf('spec\Weeble\OO\ValueObject');
    }

    function it_transposes_db_to_value_correctly()
    {
    	$dbModel = new DbModel;
    	$dbModel->firstName = "Shaun";
    	$dbModel->age = 23;

    	$value = $this->provideValue($dbModel);

    	$value->firstName->shouldEqual("Shaun");
    	$value->age->shouldEqual(23);
    }
}


class ValueObject {
	public $firstName;
	public $age;
}

class DbModel {
	public $firstName;
	public $age;
}