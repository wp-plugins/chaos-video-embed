<?php

function portal_meta_box() {
	// Display whatever it is you want to show
	
	add_meta_box( 'myplugin_sectionid', __( 'Embed CHAOS video', 'myplugin_textdomain' ), 
                'myplugin_inner_custom_box', 'post', 'side' );
 
} 

// Create the function use in the action hook

function myplugin_inner_custom_box() {
	global $sessionID;
	global $mcm_path_parameter;
	global $pluginFolder;
	
	
	
	echo "<script type='text/javascript' src='$pluginFolder/copytoclipboard.js'></script>";

	
	RenderAssetSearchBox();
		
	// Use nonce for verification
  wp_nonce_field( plugin_basename(__FILE__), 'myplugin_noncename' );

}


function RenderAssetSearchBox(){
	StartSession();
	$mcm_path_parameter =GlobalParameters::getInstance()->get('mcm_path_parameter');
	$sessionID = GlobalParameters::getInstance()->get('sessionID');

	$pluginFolder = GlobalParameters::getInstance()->get('pluginFolder');
	
	$mcm_languageid_parameter =GlobalParameters::getInstance()->get('mcm_languageid_parameter');
	
	
	$langID = $mcm_languageid_parameter->GetValue();
	$langID = split(",", $langID);
	$langID = $langID[0];
	
	$channelId = GlobalParameters::getInstance()->get('mcm_channelId_parameter')->GetValue();
	
	$searchServicePath = $mcm_path_parameter->GetValue();
	if(CheckIfSetupIsDone()){ 
	echo "<object id='' classid='clsid:D27CDB6E-AE6D-11cf-96B8-444553540000' width='270' height='700'> <param name='movie' value='$pluginFolder/AssetSearch.swf'> <param name='wmode' value='Transparent'> <param name='allowfullscreen' value='true'> <param name='allowscriptaccess' value='always'> <param name='flashvars' value='servicePath=$searchServicePath&sessionId=$sessionID&langId=$langID&channelId=$channelId'> <!--[if !IE]>--> <object type='application/x-shockwave-flash' data='$pluginFolder/AssetSearch.swf' width='270' height='700' wmode='Transparent' allowfullscreen='true' allowscriptaccess='always' flashvars='servicePath=$searchServicePath&sessionId=$sessionID&langId=$langID&channelId=$channelId'> <!--<![endif]--> <div id='PlayerAlternative'> <p> This page requires Flash Player 9 and JavaScript.<br> Download Flash Player here: <a href='http://www.adobe.com/go/getflashplayer'>http://www.adobe.com/go/getflashplayer</a>. </p> </div> <!--[if !IE]>--> </object> <!--<![endif]--> </object>";
}
}


?>