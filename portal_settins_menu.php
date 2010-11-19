<?PHP



include("portal_settings_menu_functions.php");








function mcm_plugin_menu() {
	add_options_page('MCM Options', 'MCM', 'manage_options', 'my-unique-identifier', 'mcm_plugin_options');
}

function mcm_plugin_options() {
	$settingsArray =GlobalParameters::getInstance()->get('settingsArray');
	
	$mcm_path_parameter =GlobalParameters::getInstance()->get('mcm_path_parameter');
	$mcm_metadata_names_opt_name = GlobalParameters::getInstance()->get('mcm_metadata_names_opt_name');
	$mcm_langIDs_opt_name = GlobalParameters::getInstance()->get('mcm_langIDs_opt_name');
	$mcm_autostart_parameter =GlobalParameters::getInstance()->get('mcm_autostart_parameter');
	$mcm_metadatas_parameter =GlobalParameters::getInstance()->get('mcm_metadatas_parameter');
	$mcm_languageid_parameter =GlobalParameters::getInstance()->get('mcm_languageid_parameter');
	$hidden_field_name =GlobalParameters::getInstance()->get('hidden_field_name');


	
	
  	if (!current_user_can('manage_options'))  {
    	wp_die( __('You do not have sufficient permissions to access this page.') );
  	}

	

    // variables for the field and option names 
    
    

    // Read in existing option value from database
   
    // See if the user has posted us some information
    // If they did, this hidden field will be set to 'Y'
    




    // Now display the settings editing screen

    echo '<div class="wrap">';

    // header

    echo "<h2>" . __( 'MCM Plugin Settings', 'menu-test' ) . "</h2>";
	
	
	
	echo "<script type='text/javascript'>
			function getTextFromFlash(str) {
		
				document.form1.langIDs.value = str; 
			} 
			
			function getMetadataNamesFromFlash(str) {
		
				document.form1.metadataNames.value = str; 
			} 
			
		</script>";
    // settings form
    
    echo '<form name="form1" method="post" action=""><table>';
	
	
	echo "<input type='hidden' name='$hidden_field_name' value='Y'>";
	
	
	foreach ($settingsArray as $mcm_parameter) {
		
	
		$inputField = "<input type='text' name='" . $mcm_parameter->wp_option_name . "' value='" . $mcm_parameter->GetValue() . "' size='60'></p>";
		
		RenderSetting($mcm_parameter->name, $inputField, $mcm_parameter->description);
	}
	
	
	$autostart_value = $mcm_autostart_parameter->GetValue();
 	
	$options;
	
	if($autostart_value){
		$options =  "<option value='1' selected>True</option><option value='0'>False</option>";		
	}
	else{
		$options =  "<option value='1'>True</option><option value='0' selected>False</option>";	
	}
	
	
	RenderSetting("Auto start", "<select name='" . $mcm_autostart_parameter->wp_option_name . "'>" . $options .  "</select>");
	
	
	echo "<p><input type='hidden' name='metadataNames'></p>";
	
	
	RenderMetadataSelector();
			
	echo "<p><input type='hidden' name='langIDs'></p>";
	
	
	RenderLanguageSelector();
	
	echo "<hr/>";
	echo "<tr><td><input type='submit' name='Submit' class='button-primary' value='";
	esc_attr_e('Save Changes');
	echo "'/></td></tr>";
	
	
	echo "</table></form></div>";

}

function RenderSetting($name, $inputField, $desc=""){
	

	//echo $mcm_parameter->name;
	
	echo "<tr><td><p><strong>" . $name . "</strong></p></td><td>" . $inputField . "</td><td><span class='description'>" .  $desc .  "</td></p></tr>";
}




?>
