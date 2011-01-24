<?PHP

function GetMetadataFromXML($xml, $metadataString, $langId){

	$metadataNamesArray = split(",", $metadataString);
	
	$metadataString;
	
	$returnString;
	
	$langName = GetLanguageName($langId);

	$matadataXML = $xml;
	
	
	
	$returnString .= "<div class=\"tabbertab\" title='$langName'><table style='margin:0px;'>";
	
	
	foreach ($metadataNamesArray as $metadataName) {
		$metadataData = $matadataXML -> $metadataName;
		$returnString .= "<tr><td style='vertical-align: top;'><p><strong>" . $metadataName . "</strong></p></td><td style='vertical-align: top;'><p>" . $metadataData . "</p></td></tr>";
		$metadataString .= $metadataData;
	}
	
	$returnString .= "</table></div>";

	
	
	return 	$returnString;
	
	
}
 


function RenderMetadata($objectID,$metadataString, $languages, $metadataWidth){
	

	
	require_once("chaos_languages.php");

	
	$mcm_path_parameter =GlobalParameters::getInstance()->get('mcm_path_parameter')->GetValue();


	$path =  $mcm_path_parameter . "Object_Get?sessionID=" . GlobalParameters::getInstance()->get('sessionID') .  "&objectID=" . $objectID . "&includeMetadata=true&metadataLanguageIDs=" . $languages . "&channelId=" . GlobalParameters::getInstance()->get('mcm_channelId_parameter')->GetValue();
	
	$returnString = "";
	
	$xml = new SimpleXMLElement($path, NULL, true);
	
	 
	
	$sessionID =GlobalParameters::getInstance()->get('sessionID');

	$pluginFolder = GlobalParameters::getInstance()->get('pluginFolder');

	
	$langArray = split(",", $languages);
	
	$random = md5(uniqid(rand(), true));
	
	$returnString .= "<div class=\"tabber\" style='width:" . $metadataWidth . "px' id='$random'>";
	$metadataAsSignleString;
	
	foreach ($langArray as $id) {	
			$query = "MCM.Data.DTO.ExtendedObjectInfo/Metadata/MCM.Data.DTO.MetadataInfo[LanguageID=" . $id . "]/MetadataXml";
			$result = $xml->xpath($query);
			
			$returnString .=  GetMetadataFromXML(simplexml_load_string($result[0]), $metadataString, $id);
	}
	
	
	
	
	
	$returnString .=  "</div>";
	
	
	$returnString .=  "<script type='text/javascript' src='$pluginFolder/tabber.js'></script>";	
	
	update_post_meta(get_the_ID(), "mcm_search_text", $metadataAsSignleString);
	
	return $returnString;
	



}


?>