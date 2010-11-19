<?php
add_action('admin_menu', 'mcm_plugin_menu');


if(CheckIfSetupIsDone($mcm_path_parameter,$mcm_clientid_parameter,$mcm_repositoryid_parameter)){	
	add_action('wp_head', 'headerfunction');
	
	add_filter('the_content', 'contentfunction');
	add_filter('comment_text', 'contentfunction');
	
	add_action('add_meta_boxes', 'portal_meta_box');
	

}
else{
	add_action('admin_notices' , 'admin_error_function', 10);
	add_action('the_content', 'admin_error_function');
}

function admin_error_function($content){

	echo "<div id='message' class='updated below-h2'>MCM plugin settings needs to be updated</div>$content";

}



?>