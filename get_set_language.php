<?PHP


include("../../../wp-admin/admin.php");


if(isset($_GET['set_lang_code'])){
	update_option("portal_plugin_metadata_languages", $_GET['lang_code']);	   
};


if(isset($_GET['get_lang_code'])){
	echo get_option("portal_plugin_metadata_languages");	   
};


?>

