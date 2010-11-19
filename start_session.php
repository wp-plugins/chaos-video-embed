<?php

if(CheckIfSetupIsDone()){
	
	$path = $mcm_path_parameter->GetValue(). "Session_Start?repositoryID=" . $mcm_repositoryid_parameter->GetValue() . "&clientSettingID=" . $mcm_clientid_parameter->GetValue();
	
	$xml = simplexml_load_file($path);

	$sessionID = $xml -> SessionID;
	
	GlobalParameters::getInstance()->set('sessionID',$sessionID);
	
}

?>