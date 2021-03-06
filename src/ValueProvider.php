<?php
namespace Weeble\OO;

class ValueProvider {

	protected $fields = [];

	protected $valueClass;

	function __construct($valueClass, array $fields) {
		$this->setValueClass($valueClass);
		$this->setFields($fields);
	}

	public function setValueClass($valueClass)
	{
		if(is_string($valueClass)){
			$this->valueClass = $valueClass;
		}else if(is_object($valueClass)){
			$this->valueClass = get_class($valueClass);
		}else{
			throw new \Exception("\$valueClass must be a string or object.", 1);
		}
	}

	public function setFields(array $fields, $merge = false)
	{
		if( $merge ){
			$this->fields = array_merge($this->fields, $fields);
		}else{
			$this->fields = $fields;
		}
	}

	public function getValueClass()
	{
		return $this->valueClass;
	}
	
	public function getFields()
	{
		return $this->fields;
	}

	public function provideValue($dbModel)
	{
		return $this->transposeObject($dbModel);
	}

	protected function newValueObject()
	{
		return new $this->valueClass;
	}

	protected function transposeObject($dbModel)
	{
		$valueObject = $this->newValueObject();

		foreach ($this->fields as $field) {
			if (isset($dbModel->$field)) {
				$valueObject->$field = $dbModel->$field;
			}else{
				$valueObject->$field = null;
			}
		}

		return $valueObject;
	}


}