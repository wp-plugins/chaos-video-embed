<?PHP

 
function GetMetadata($objectId, $langID, $metadataString){

	$mcm_path_parameter =GlobalParameters::getInstance()->get('mcm_path_parameter');

	$sessionID =GlobalParameters::getInstance()->get('sessionID');
	$channelID = GlobalParameters::getInstance()->get('mcm_channelId_parameter');
	
	$metadataNamesArray = split(",", $metadataString);
	
	$path = $mcm_path_parameter->GetValue(). "Metadata_Get?sessionID=" . $sessionID . "&objectIDs=" . $objectId . "&languageID=" . $langID . "&channelid=" . $channelID->GetValue();
	
	
	$metadataString;
	
	$xml = new SimpleXMLElement($path, NULL, true);
	
	foreach($xml -> children() as $MetadataInfo){
   		//print_r($MetadataInfo -> ObjectID);
		$langName = GetLanguageName($langID);
		
		$matadataXML = simplexml_load_string($MetadataInfo -> MetadataXml);
		echo "<div class=\"tabbertab\" title='$langName'><table>";
		
		
		foreach ($metadataNamesArray as $metadataName) {
   			$metadataData = $matadataXML -> $metadataName;
	 		echo "<tr><td style='vertical-align: top;'><p><strong>" . $metadataName . "</strong></p></td><td style='vertical-align: top;'><p>" . $metadataData . "</p></td></tr>";
			$metadataString .= $metadataData;
		}
		
		echo "</table></div>";
		/*
		$matadataXML = simplexml_load_string($MetadataInfo -> MetadataXml);
		$lngId = $MetadataInfo -> LanguageID;
		$title =  $matadataXML -> Title;
		$description =  $matadataXML -> Abstract;
		
		echo 	"<div class=\"tabbertab\" title='$langName'>
						<p><strong>$title</strong></p>
						<p>$description</p>
						
						
					
				</div>";
		
		*/
		
	}
	
	return 	$metadataString;
	
	//echo $xml->MCM.Data.DTO.MetadataInfo->ObjectID";
}


function RenderMetadata($objectID,$metadataString, $languages, $metadataWidth){

	
	$mcm_path_parameter =GlobalParameters::getInstance()->get('mcm_path_parameter');

	$sessionID =GlobalParameters::getInstance()->get('sessionID');

	$pluginFolder = GlobalParameters::getInstance()->get('pluginFolder');

	
	$langArray = split(",", $languages);
	
	
	
	
	$random = md5(uniqid(rand(), true));
	echo "<div class=\"tabber\" style='width:" . $metadataWidth . "px' id='$random'>";
	$metadataAsSignleString;
	
	foreach ($langArray as $id) {
   		if($id){	
			$metadataAsSignleString .= GetMetadata($objectID, $id, $metadataString);
		}
	}
	
	
	
	
	
	echo "</div>";
	
	
	echo "<script type='text/javascript' src='$pluginFolder/tabber.js'></script>";	
	
	update_post_meta(get_the_ID(), "mcm_search_text", $metadataAsSignleString);
																	
	/*
	echo "<div class=\"tabber\">

     <div class=\"tabbertab\">
	  <h2>Tab 1</h2>
	  <p>Tab 1 content.</p>
     </div>


     <div class=\"tabbertab\">
	  <h2>Tab 2</h2>
	  <p>Tab 2 content.</p>
     </div>


     <div class=\"tabbertab\">
	  <h2>Tab 3</h2>
	  <p>Tab 3 content.</p>
     </div>

</div>";
*/
}


?>