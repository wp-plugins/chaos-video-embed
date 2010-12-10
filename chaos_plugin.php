<?PHP

/*
Plugin Name: Geckon ChAOS Plugin
Plugin URI: http://geckon.com
Description: Geckon MCM Plugin
Version: 0.5.3
Author: Gekcon.com
Author URI: http://gekcon.com
License: GPL2
*/


require_once("chaos_parameter.php");
require_once("chaos_global_parameters.php");

GlobalParameters::getInstance()->set('mcm_path_parameter',new McmParameter("MCM service path", "The start path of the MCM webservice", "MCM_API_PATH"));
GlobalParameters::getInstance()->set('mcm_repositoryid_parameter',new McmParameter("MCM Repository ID", "The repository ID", "MCM_RepositoryID"));

GlobalParameters::getInstance()->set('mcm_clientid_parameter',new McmParameter("Client ID", "The client ID", "MCM_ClientID"));
GlobalParameters::getInstance()->set('mcm_channelId_parameter',new McmParameter("Channel ID", "ID of selected channel", "MCM_CHANNEL_ID"));

GlobalParameters::getInstance()->set('mcm_languageid_parameter',new McmParameter("Language IDs", "ID's of the languages to be shown", "MCM_LANGUAGE_IDS"));
GlobalParameters::getInstance()->set('mcm_metadatas_parameter',new McmParameter("Metadata names", "Names of Metadata to be shown", "MCM_METADATA_NAMES"));
GlobalParameters::getInstance()->set('mcm_active_tab_bg_color_parameter',new McmParameter("Selected tab background color", "Background of the selected language tab", "MCM_ACTIVE_TAB_BG_COLOR"));
GlobalParameters::getInstance()->set('mcm_tabs_bottom_border_color_parameter',new McmParameter("Tabs bottom color", "Language tabs bottom border stroke color", "MCM_TABS_BORDER_BOTTOM_COLOR"));

GlobalParameters::getInstance()->set('mcm_autostart_parameter',new McmParameter("Player autostart", "Define player autostart", "MCM_AUTOSTART"));
GlobalParameters::getInstance()->set('mcm_player_width_parameter',new McmParameter("Player width", "Width of the videoplayer ", "MCM_PLAYER_WIDTH"));
GlobalParameters::getInstance()->set('mcm_player_height_parameter',new McmParameter("Player height", "Height of the videoplayer ", "MCM_PLAYER_HEIGHT"));
GlobalParameters::getInstance()->set('mcm_metadata_width_parameter',new McmParameter("Metadata width", "Width of the metadata field", "MCM_METADATA_WIDTH"));

GlobalParameters::getInstance()->set('mcm_show_metadata_parameter',new McmParameter("Show metadata", "Wether metadata is to be shown or not", "MCM_SHOW_METADATA_WIDTH"));





$mcm_path_parameter =  GlobalParameters::getInstance()->get('mcm_path_parameter');
$mcm_repositoryid_parameter =  GlobalParameters::getInstance()->get('mcm_repositoryid_parameter');
$mcm_clientid_parameter =  GlobalParameters::getInstance()->get('mcm_clientid_parameter');
$mcm_channelid_parameter = GlobalParameters::getInstance()->get('mcm_channelId_parameter');



$mcm_active_tab_bg_color_parameter = GlobalParameters::getInstance()->get('mcm_active_tab_bg_color_parameter');
$mcm_tabs_bottom_border_color_parameter = GlobalParameters::getInstance()->get('mcm_tabs_bottom_border_color_parameter');
$mcm_player_width_parameter = GlobalParameters::getInstance()->get('mcm_player_width_parameter');
$mcm_player_height_parameter = GlobalParameters::getInstance()->get('mcm_player_height_parameter');
$mcm_metadata_width_parameter = GlobalParameters::getInstance()->get('mcm_metadata_width_parameter');

$settingsArray = array($mcm_path_parameter,$mcm_repositoryid_parameter,$mcm_channelid_parameter, $mcm_clientid_parameter, $mcm_active_tab_bg_color_parameter,$mcm_tabs_bottom_border_color_parameter, $mcm_player_width_parameter, $mcm_player_height_parameter,$mcm_metadata_width_parameter);



GlobalParameters::getInstance()->set('settingsArray',$settingsArray);




$prefix = WP_CONTENT_URL;
$pluginFolder = WP_PLUGIN_URL.'/'.str_replace(basename( __FILE__),"",plugin_basename(__FILE__));

GlobalParameters::getInstance()->set('hidden_field_name',"mt_submit_hidden");


GlobalParameters::getInstance()->set('pluginFolder',$pluginFolder);


require_once("Timer.php");

require_once("chaos_update_wp_settings.php");

require_once("chaos_check_setup.php");





require_once("chaos_settins_menu.php");

require_once("chaos_metadata.php");



require_once("chaos_asset_search_box.php");



global $objectID;


global $mcmplayer_counter; 
$mcmplayer_counter = 0;



function StartSession(){
	require_once("chaos_start_session.php");
	
}

function headerfunction(){
	StartSession();
	
	$pluginFolder = GlobalParameters::getInstance()->get('pluginFolder');

	$mcm_active_tab_bg_color_parameter = GlobalParameters::getInstance()->get('mcm_active_tab_bg_color_parameter');
	$mcm_tabs_bottom_border_color_parameter = GlobalParameters::getInstance()->get('mcm_tabs_bottom_border_color_parameter');
	
	$active_tab_bg_color = GlobalParameters::getInstance()->get('mcm_active_tab_bg_color_parameter')->GetValue();
	$border_bottom_color = GlobalParameters::getInstance()->get('mcm_tabs_bottom_border_color_parameter')->GetValue();


	echo "<link rel='stylesheet' href='" . $pluginFolder .  "css/tab_style.css' TYPE='text/css' MEDIA='screen'>";
	echo "<style>


table.tabbernav{
	 border-bottom: 1px solid #$border_bottom_color;
	 margin-top: 3px;
}

table.tabbernav th.tabberactive
{
 background-color: #$active_tab_bg_color;
 border-bottom: 0px solid #fff;

}

</style>";
	 
	/*
	$output = <<<EOB
<script type="text/javascript" src="{$prefix}/plugins/mcm_plugin/swfobject.js"></script>
EOB;
	print $output;
	*/
	
	
}


$languages;


function render_mcm_player($match){
	 
	$mcm_path_parameter =GlobalParameters::getInstance()->get('mcm_path_parameter');
	$mcm_clientid_parameter = GlobalParameters::getInstance()->get('mcm_clientid_parameter');
	$mcm_repositoryid_parameter = GlobalParameters::getInstance()->get('mcm_repositoryid_parameter');
	
	$mcm_autostart_parameter =GlobalParameters::getInstance()->get('mcm_autostart_parameter');
	$mcm_player_width_parameter =GlobalParameters::getInstance()->get('mcm_player_width_parameter');
	$mcm_player_height_parameter =GlobalParameters::getInstance()->get('mcm_player_height_parameter');
	$mcm_metadata_width_parameter =GlobalParameters::getInstance()->get('mcm_metadata_width_parameter');

	$mcm_metadatas_parameter =GlobalParameters::getInstance()->get('mcm_metadatas_parameter');

	$pluginFolder =GlobalParameters::getInstance()->get('pluginFolder');
	$languages = GlobalParameters::getInstance()->get('mcm_languageid_parameter')->GetValue();
	
	$metadatas = $mcm_metadatas_parameter->GetValue();
	
	
	$width = $mcm_player_width_parameter->GetValue();
    $height = $mcm_player_height_parameter->GetValue();
	
	$autoStartSetting = $mcm_autostart_parameter->GetValue();
	

	$metadataWidth = $mcm_metadata_width_parameter->GetValue();

 	$show_metadata = GlobalParameters::getInstance()->get('mcm_show_metadata_parameter')->GetValue();
	
   
   if(preg_match("/objectId=\"(.*?)\"/", $match[1], $args)){
	    $objectID = $args[1];
	};
	 if(preg_match("/width=\"(.*?)\"/", $match[1], $args)){
	    $width = $args[1];
	};
	
	if(preg_match("/height=\"(.*?)\"/", $match[1], $args)){
	    $height = $args[1];
	};
	
	if(preg_match("/languageIds=\"(.*?)\"/", $match[1], $args)){
	    $languages = $args[1];
	};
	
	if(preg_match("/metadataNames=\"(.*?)\"/", $match[1], $args)){
	    $metadatas = $args[1];
	};
	
	
	if(preg_match("/autostart=\"(.*?)\"/", $match[1], $args)){
	    $autoStartSetting = $args[1];
	};
	
	if(preg_match("/showmetadata=\"(.*?)\"/", $match[1], $args)){
	    $show_metadata = $args[1];
	};
	
	
	
	
	$repId = $mcm_repositoryid_parameter->GetValue();
 
   $embedServiceURL = $mcm_path_parameter->GetValue(). "Object_GetEmbedHtmlByID?objectID=" . $objectID . "&sessionID=" . GlobalParameters::getInstance()->get('sessionID') . "&playerSettingID=25658&width=" . $width . "&height=" . $height . "&autoPlay=" . $autoStartSetting . "&startPosition=0";

   $embedCodeXML = file_get_contents($embedServiceURL);
 
   $xml = simplexml_load_string($embedCodeXML); 
   
   echo $xml->EmbedCode;
 
   if($show_metadata == "true"){
   		RenderMetadata($objectID,$metadatas,$languages, $metadataWidth);
   }

 
	
}

function contentfunction($content)
{
	return preg_replace_callback('/\[mcmplayer ([A-Za-z0-9\-_\/\?\&\#\%\"\ \,\.\=@:;]+)\]/', 'render_mcm_player', $content);
}



require_once("chaos_plugin_hooks.php");



?>