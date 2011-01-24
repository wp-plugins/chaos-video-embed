<?php

$mcm_path_parameter = GlobalParameters::getInstance()->get('mcm_path_parameter');
$mcm_clientid_parameter = GlobalParameters::getInstance()->get('mcm_clientid_parameter');
$mcm_repositoryid_parameter = GlobalParameters::getInstance()->get('mcm_repositoryid_parameter');

if(CheckIfSetupIsDone($mcm_path_parameter,$mcm_clientid_parameter,$mcm_repositoryid_parameter)){

	$langXMLPath = $mcm_path_parameter->GetValue(). "Language_Get?sessionID="  . GlobalParameters::getInstance()->get('sessionID') . "&languageIDs=" .  GlobalParameters::getInstance()->get('mcm_languageid_parameter')->GetValue() ;

	$langXML = new SimpleXMLElement($langXMLPath, NULL, true);
	
	GlobalParameters::getInstance()->set('languageXML', $langXML);
}




function GetLanguageName($id){
	if(CheckIfSetupIsDone()){
		$langXML = GlobalParameters::getInstance()->get('languageXML');
		foreach($langXML -> children() as $language){
			if($id == $language -> ID){
				return $language -> Name;
			};
		}
	}
}

?>