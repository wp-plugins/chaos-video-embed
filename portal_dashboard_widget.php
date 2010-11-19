<?php

function example_dashboard_widget_function() {
	// Display whatever it is you want to show
	echo "Hello World, I'm a great Dashboard Widget";
} 

// Create the function use in the action hook

function example_add_dashboard_widgets() {

	wp_add_dashboard_widget('example_dashboard_widget', 'Example Dashboard Widget', 'example_dashboard_widget_function');	
} 

?>