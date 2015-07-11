<?php

// Timezone Settings
if ( !function_exists('getTimezoneByOffset') ) {
	function getTimezoneByOffset($offset){
	
	 	$offset *= 3600; // convert hour offset to seconds
        $abbrarray = timezone_abbreviations_list();
        foreach ($abbrarray as $abbr)
        {
                foreach ($abbr as $city)
                {
                        if ($city['offset'] == $offset)
                        {
                                return $city['timezone_id'];
                        }
                }
        }

        return false;
	
	}

	$timezone_setting = get_option('timezone_string');
	$offset_setting = get_option('gmt_offset');
	if (!$timezone_setting) { $timezone_setting = getTimezoneByOffset($offset_setting); }
	
	date_default_timezone_set($timezone_setting);

}
// END Timezone Settings


// Add allowed <script> tag for Google Analytics code
add_action('init', 'my_html_tags_code', 10);
function my_html_tags_code() {
  	global $allowedtags;
    $allowedtags = array(
  		'script' => array(),
  		'b' => array(),
  		'i' => array(),
  		'p' => array(),
  		'h1' => array(),
  		'h2' => array(),
  		'h3' => array(),
  		'h4' => array(),
  		'h5' => array(),
  		'h6' => array(),
      	'ul' => array(),
      	'ol' => array(),
      	'li' => array(),
      	'strong' => array(),
      	'em' => array(),
      	'pre' => array(),
      	'code' => array(),
      	'a' => array(
      	'href' => array (),
      	'title' => array ())
    );
}


// Add RSS links to <head> section
add_theme_support( 'automatic-feed-links' );

// Load jQuery
if ( !function_exists('core_mods') ) {
	function core_mods() {
		if ( !is_admin() ) {
			wp_deregister_script('jquery');
			wp_register_script('jquery', ("https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"), false);
			wp_enqueue_script('jquery');
		}
	}
	add_action('init','core_mods');
}

// New Requirement for WP 3.3, Loading Scripts the Proper Way
if ( !function_exists('js_admin_script_loader')){
	function js_admin_script_loader() {
		// Date Field for Custom Meta Boxes
		wp_enqueue_script('jqueryui-datepicker', get_stylesheet_directory_uri() . '/_framework/enhanced-custom-fields/tpls/jqueryui/jquery-ui-1.8.16.custom.min.js');
		wp_enqueue_script('jqueryui-timepicker', get_stylesheet_directory_uri() . '/_framework/enhanced-custom-fields/tpls/jqueryui/jquery.timepicker.js');
		wp_enqueue_style('jqueryui-datepicker', get_stylesheet_directory_uri() . '/_framework/enhanced-custom-fields/tpls/jqueryui/smoothness/jquery-ui-1.8.16.custom.css');
		
		if (of_get_option('js_time_format') && of_get_option('js_time_format') == '24h'){
			wp_enqueue_script('jqueryui-initiate', get_stylesheet_directory_uri() . '/_framework/enhanced-custom-fields/tpls/jqueryui/datepicker_24h.js');
		} else {
			wp_enqueue_script('jqueryui-initiate', get_stylesheet_directory_uri() . '/_framework/enhanced-custom-fields/tpls/jqueryui/datepicker_12h.js');
		}
		
	}
	add_action('admin_init','js_admin_script_loader');
}

// Clean up the <head>
function removeHeadLinks() {
	remove_action('wp_head', 'rsd_link');
	remove_action('wp_head', 'wlwmanifest_link');
}
add_action('init', 'removeHeadLinks');

// Remove the auto-formatters to prevent unwanted <br> and <p> tags around the column shortcodes.
function js_formatter($content) {
	$new_content = '';

	/* Matches the contents and the open and closing tags */
	$pattern_full = '{(\[raw\].*?\[/raw\])}is';

	/* Matches just the contents */
	$pattern_contents = '{\[raw\](.*?)\[/raw\]}is';

	/* Divide content into pieces */
	$pieces = preg_split($pattern_full, $content, -1, PREG_SPLIT_DELIM_CAPTURE);

	/* Loop over pieces */
	foreach ($pieces as $piece) {
		/* Look for presence of the shortcode */
		if (preg_match($pattern_contents, $piece, $matches)) {

			/* Append to content (no formatting) */
			$new_content .= $matches[1];
		} else {

			/* Format and append to content */
			$new_content .= wptexturize(wpautop($piece));
		}
	}

	return $new_content;
}

// Remove the 2 main auto-formatters
remove_filter('the_content', 'wpautop');
remove_filter('the_content', 'wptexturize');

// Before displaying for viewing, apply this function
add_filter('the_content', 'js_formatter', 99);
add_filter('widget_text', 'js_formatter', 99);

// Uncomment to remove the WordPress version number from the <head> section
//remove_action('wp_head', 'wp_generator');



// Theme Update Script - Coming Soon...
set_site_transient( 'update_themes', null ); // Force update check for testing purposes.
include_once('class-custom-theme-updater.php');
$theme_updater = new Custom_Theme_Updater('http://demo.scheetzdesigns.com/_theme_updates/rebirth/api/', 'rebirth');
?>