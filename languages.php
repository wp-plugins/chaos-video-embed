<?php

if(CheckIfSetupIsDone($mcm_path_parameter,$mcm_clientid_parameter,$mcm_repositoryid_parameter)){

	$langXMLPath = $mcm_path_parameter->GetValue(). "Language_Get?sessionID="  . $sessionID;

	$langXML = new SimpleXMLElement($langXMLPath, NULL, true);
	
}

function GetLanguageName($id){
	if(CheckIfSetupIsDone()){
		global $langXML;
		foreach($langXML -> children() as $language){
			if($id == $language -> ID){
				return $language -> Name;
			};
		}
	}
}

?>