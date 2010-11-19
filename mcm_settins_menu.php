<?PHP
add_action('admin_menu', 'mcm_plugin_menu');







$settingsArray = array($mcm_path_opt_name, $mcm_player_path_opt_name,$mcm_repositoryID_opt_name, $mcm_clientID_opt_name);



function mcm_plugin_menu() {
	add_options_page('MCM Options', 'MCM', 'manage_options', 'my-unique-identifier', 'mcm_plugin_options');
}

function mcm_plugin_options() {
	global $settingsArray;
	global $mcm_path_opt_name;
	
	global $mcm_langIDs_opt_name;
	
  	if (!current_user_can('manage_options'))  {
    	wp_die( __('You do not have sufficient permissions to access this page.') );
  	}

	

    // variables for the field and option names 
    
    $hidden_field_name = 'mt_submit_hidden';

    // Read in existing option value from database
   
    // See if the user has posted us some information
    // If they did, this hidden field will be set to 'Y'
    if( isset($_POST[ $hidden_field_name ]) && $_POST[ $hidden_field_name ] == 'Y' ) {
        // Read their posted value
       // $opt_val = $_POST[ $data_field_name ];

        // Save the posted value in the database
        //update_option( $mcm_path_opt_name, $opt_val );

        // Put an settings updated message on the screen
		
		foreach ($settingsArray as $value) {
			
			$opt_val = $_POST[$value];
			update_option($value, $opt_val);
			
    		
		
		
		}
		
		$langIDs = $_POST['langIDs'];
		update_option($mcm_langIDs_opt_name, $langIDs);
		
		
		
		
		
		
		
		
	}




    // Now display the settings editing screen

    echo '<div class="wrap">';

    // header

    echo "<h2>" . __( 'MCM Plugin Settings', 'menu-test' ) . "</h2>";
	
	
	
	echo "<script type='text/javascript'>
			function getTextFromFlash(str) {
		
				document.form1.langIDs.value = str; 
			} 
		</script>";
    // settings form
    
    echo '<form name="form1" method="post" action="">';

	
	echo "<input type='hidden' name='$hidden_field_name' value='Y'>";
	
	
	foreach ($settingsArray as $value) {
		echo "<p>$value";
		$option_value = get_option($value);
		echo "<input type='text' name='$value' value='$option_value' size='60'></p>";
	}
	
			
	echo "<p><input type='hidden' name='langIDs'></p>";
	
	
	RenderLanguageSelector();
	
	echo "<hr/><p class='submit'>";
	echo "<input type='submit' name='Submit' class='button-primary' value='";
	esc_attr_e('Save Changes');
	echo "'/></p>";
	
	
	echo "</form></div>";

}


function RenderLanguageSelector(){
	global $mcm_path;
	global $pluginFolder;
	global $sessionID;
	global $mcm_langIDs_opt_name;
	$langIDs = get_option($mcm_langIDs_opt_name);
	$languageServicePath = $mcm_path . "Language_Get?sessionId=" . $sessionID;
	echo "<object id='' classid='clsid:D27CDB6E-AE6D-11cf-96B8-444553540000' width='600' height='3700'> <param name='movie' value='$pluginFolder/LanguageSelector.swf'> <param name='wmode' value='Transparent'> <param name='allowfullscreen' value='true'> <param name='allowscriptaccess' value='always'> <param name='flashvars' value='langIDs=$langIDs&servicePath=$languageServicePath'> <!--[if !IE]>--> <object type='application/x-shockwave-flash' data='$pluginFolder/LanguageSelector.swf' width='600' height='3700' wmode='Transparent' allowfullscreen='true' allowscriptaccess='always' flashvars='langIDs=$langIDs&servicePath=$languageServicePath'> <!--<![endif]--> <div id='PlayerAlternative'> <p> This page requires Flash Player 9 and JavaScript.<br> Download Flash Player here: <a href='http://www.adobe.com/go/getflashplayer'>http://www.adobe.com/go/getflashplayer</a>. </p> </div> <!--[if !IE]>--> </object> <!--<![endif]--> </object>";
}


?>
