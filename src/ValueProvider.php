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

	public function provide($dbModel)
	{
		return $this->newValueObject($dbModel);
	}

	protected function newValueObject()
	{
		return new $this->valueObject;
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
	}


}