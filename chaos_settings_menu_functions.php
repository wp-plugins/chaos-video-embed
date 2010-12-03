<?php

//MetadataSchema_Get?sessionID=e88b142e-478c-4534-8cd5-db2a2de6dac5&metadataSchemaID=5//


function RenderLanguageSelector(){
	
	
	$mcm_path_parameter =GlobalParameters::getInstance()->get('mcm_path_parameter');
	$pluginFolder = GlobalParameters::getInstance()->get('pluginFolder');
	$sessionID = GlobalParameters::getInstance()->get('sessionID');
	$mcm_languageid_parameter =GlobalParameters::getInstance()->get('mcm_languageid_parameter');
	
	
	$langIDs = $mcm_languageid_parameter->GetValue();
	
	$languageServicePath = $mcm_path_parameter->GetValue(). "Language_Get?sessionId=" . $sessionID;
	if(CheckIfSetupIsDone($mcm_path_parameter,$mcm_clientid_parameter,$mcm_repositoryid_parameter)){ 
	echo "<tr><td colspan='2'><object id='' classid='clsid:D27CDB6E-AE6D-11cf-96B8-444553540000' width='600' height='350'> <param name='movie' value='$pluginFolder/LanguageSelector.swf'> <param name='wmode' value='Transparent'> <param name='allowfullscreen' value='true'> <param name='allowscriptaccess' value='always'> <param name='flashvars' value='langIDs=$langIDs&servicePath=$languageServicePath'> <!--[if !IE]>--> <object type='application/x-shockwave-flash' data='$pluginFolder/LanguageSelector.swf' width='600' height='350' wmode='Transparent' allowfullscreen='true' allowscriptaccess='always' flashvars='langIDs=$langIDs&servicePath=$languageServicePath'> <!--<![endif]--> <div id='PlayerAlternative'> <p> This page requires Flash Player 9 and JavaScript.<br> Download Flash Player here: <a href='http://www.adobe.com/go/getflashplayer'>http://www.adobe.com/go/getflashplayer</a>. </p> </div> <!--[if !IE]>--> </object> <!--<![endif]--> </object></td></tr>";
	}
}


function RenderMetadataSelector(){
	
	$mcm_path_parameter =GlobalParameters::getInstance()->get('mcm_path_parameter');
	$pluginFolder = GlobalParameters::getInstance()->get('pluginFolder');
	$sessionID = GlobalParameters::getInstance()->get('sessionID');
	$mcm_metadatas_parameter =GlobalParameters::getInstance()->get('mcm_metadatas_parameter');
	
	
	$metadataNames = $mcm_metadatas_parameter->GetValue();
	$metadataServicePath = $mcm_path_parameter->GetValue(). "MetadataSchema_Get?sessionId=" . $sessionID . "&metadataSchemaID=5";
	//$metadataServicePath = $pluginFolder . "/MetadataSchema.xml";

	if(CheckIfSetupIsDone($mcm_path_parameter,$mcm_clientid_parameter,$mcm_repositoryid_parameter)){
	echo "<tr><td colspan='2'><object id='' classid='clsid:D27CDB6E-AE6D-11cf-96B8-444553540000' width='600' height='350'> <param name='movie' value='$pluginFolder/MetadataSelector.swf'> <param name='wmode' value='Transparent'> <param name='allowfullscreen' value='true'> <param name='allowscriptaccess' value='always'> <param name='flashvars' value='metadataNames=$metadataNames&servicePath=$metadataServicePath'> <!--[if !IE]>--> <object type='application/x-shockwave-flash' data='$pluginFolder/MetadataSelector.swf' width='600' height='350' wmode='Transparent' allowfullscreen='true' allowscriptaccess='always' flashvars='metadataNames=$metadataNames&servicePath=$metadataServicePath'> <!--<![endif]--> <div id='PlayerAlternative'> <p> This page requires Flash Player 9 and JavaScript.<br> Download Flash Player here: <a href='http://www.adobe.com/go/getflashplayer'>http://www.adobe.com/go/getflashplayer</a>. </p> </div> <!--[if !IE]>--> </object> <!--<![endif]--> </object></td></tr>";
	}
}

?>