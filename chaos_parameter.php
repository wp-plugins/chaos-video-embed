<?php

class McmParameter{
	
	public $description = null;
    public $wp_option_name = null;
	public $name;
	
	public function __construct($na, $desc, $opt_name){
		$this->name = $na;
		$this->description = $desc;
		$this->wp_option_name = $opt_name;
 	}
	
	public function CheckIfItIsSet(){
		if($this->GetValue() != FALSE||$this->GetValue() != ""){
				return true;	  
		}else{
			return false;
		};	
	}
	
	public function GetValue(){
		return get_option($this->wp_option_name);	
	}
	
	public function SetValue($value){
		return update_option($this->wp_option_name, $value);	
	}
}

?>