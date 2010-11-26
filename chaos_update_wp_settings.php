<?php

$hidden_field_name = GlobalParameters::getInstance()->get('hidden_field_name');



if( isset($_POST[$hidden_field_name]) && $_POST[$hidden_field_name] == 'Y' ) {
        // Read their posted value
       // $opt_val = $_POST[ $data_field_name ];

        // Save the posted value in the database
        //update_option( $mcm_path_parameter->GetValue()_opt_name, $opt_val );

        // Put an settings updated message on the screen
	
		foreach ($settingsArray as $mcm_parameter) {
				$opt_val = $_POST[$mcm_parameter->wp_option_name];
				$mcm_parameter->SetValue($opt_val);
		}
		
		$mcm_autostart_parameter = GlobalParameters::getInstance()->get('mcm_autostart_parameter');

		
		
		$autostart =  $_POST[$mcm_autostart_parameter->wp_option_name];
		
		$mcm_autostart_parameter->SetValue($autostart);
		
		
		
		$mcm_show_metadata_parameter = GlobalParameters::getInstance()->get('mcm_show_metadata_parameter');
		
		$show_metadata =  $_POST[$mcm_show_metadata_parameter->wp_option_name];
		
		$mcm_show_metadata_parameter->SetValue($show_metadata);
		
		
		
		$langIDs = $_POST['langIDs'];
		
		$mcm_languageid_parameter = GlobalParameters::getInstance()->get('mcm_languageid_parameter');
		$mcm_languageid_parameter->SetValue($langIDs);
		
		
		$metadataNames = $_POST['metadataNames'];
		
		$mcm_metadatas_parameter = GlobalParameters::getInstance()->get('mcm_metadatas_parameter');

		$mcm_metadatas_parameter->SetValue($metadataNames);
		
		
		
		
		
		
	}
?>