<?php

class GlobalParameters
{
 	private static $_instance = null;
  	
	private $_data = array();

  	private function __construct()
  	{
  	}

  	public static function getInstance()
  	{
    	if(self::$_instance == null)
      		self::$_instance = new self;

   		return self::$_instance;
  	}
  	public function set($name,$value)
	{
	  $this->_data[$name] = $value;
	}
	
	public function get($name)
	{
	  	if(isset($this->_data[$name])){
			return $this->_data[$name];
		}
	  	else{
			return null;
		}
	}
}

?>