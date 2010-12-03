<?php

if(CheckIfSetupIsDone()){
	
	
	$mcm_path_parameter = GlobalParameters::getInstance()->get('mcm_path_parameter');
	$mcm_clientid_parameter = GlobalParameters::getInstance()->get('mcm_clientid_parameter');
	$mcm_repositoryid_parameter = GlobalParameters::getInstance()->get('mcm_repositoryid_parameter');
	 
	
	$path = $mcm_path_parameter->GetValue() . "Session_Start?repositoryID=" . $mcm_repositoryid_parameter->GetValue() . "&clientSettingID=" . 			$mcm_clientid_parameter->GetValue();
	
	
	
	// $sessionID = "3495414b-481a-4fe4-a77c-dc02abf93a3b";
	 $xml = simplexml_load_file($path);
	 
	$sessionID = $xml -> SessionID;
	GlobalParameters::getInstance()->set('sessionID',$sessionID);
	
	
	
	
}

?>