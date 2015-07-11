<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 * 
 */

function optionsframework_option_name() {

	// This gets the theme name from the stylesheet (lowercase and without spaces)
	if (function_exists('wp_get_theme')){
		$themename = wp_get_theme();
	} else {
		$themename = get_theme_data(STYLESHEETPATH . '/style.css');
	}
	$themename = $themename['Name'];
	$themename = preg_replace("/\W/", "", strtolower($themename) );
	
	$optionsframework_settings = get_option('optionsframework');
	$optionsframework_settings['id'] = $themename;
	update_option('optionsframework', $optionsframework_settings);
	
	// echo $themename;
}

/* 
 * This is an example of how to add custom scripts to the options panel.
 * This one shows/hides the an option when a checkbox is clicked.
 */

add_action('optionsframework_custom_scripts', 'optionsframework_custom_scripts');

function optionsframework_custom_scripts() { ?>

<script type="text/javascript">
jQuery(document).ready(function() {
	
	jQuery( ".homepageBlockBuilder" ).sortable({
		items: "div:not(.no-sorting)",
		create: function() {
			
			jQuery('input#js_homepage_block_order').val();
			
			var sortOrder = jQuery( ".homepageBlockBuilder" ).sortable("serialize");
			sortOrder = sortOrder.split('&');
			var newArray = new Array();
			for (var i = 0; i < sortOrder.length; i++) {
			    var currentItem = sortOrder[i];
			    currentItem = currentItem.split('=');
			    currentItem = currentItem[1];
			    newArray.push(currentItem);
			}
			
			var sortList = newArray.join(",")
		},
		update: function() {
			var sortOrder = jQuery( ".homepageBlockBuilder" ).sortable("serialize");
			sortOrder = sortOrder.split('&');
			var newArray = new Array();
			for (var i = 0; i < sortOrder.length; i++) {
			    var currentItem = sortOrder[i];
			    currentItem = currentItem.split('=');
			    currentItem = currentItem[1];
			    newArray.push(currentItem);
			}
			
			var sortList = newArray.join(",")
			jQuery('input#js_homepage_block_order').val(sortList);
        }
	}).disableSelection();
	
	// Hide/Show Homepage Blocks
	jQuery('#rebirth-js_homepage_blocks-js_homepage_slider').change(function() {
		var thisValue = jQuery(this).attr('checked');
		if (thisValue == 'checked'){
			jQuery('#of-option-homepageslider-tab').parent().slideUp();
			jQuery('.rebirth-js_homepage_blocks-js_homepage_slider').css({'background':'#f5f5f5','color':'#ccc'});
		} else {
			jQuery('#of-option-homepageslider-tab').parent().slideDown();
			jQuery('.rebirth-js_homepage_blocks-js_homepage_slider').css({'background':'#eee','color':'#333'});
		}
	});
	
	jQuery('#rebirth-js_homepage_blocks-js_homepage_introblock').change(function() {
		var thisValue = jQuery(this).attr('checked');
		if (thisValue == 'checked'){
			jQuery('#of-option-homepageintroblock-tab').parent().slideUp();
			jQuery('.rebirth-js_homepage_blocks-js_homepage_introblock').css({'background':'#f5f5f5','color':'#ccc'});
		} else {
			jQuery('#of-option-homepageintroblock-tab').parent().slideDown();
			jQuery('.rebirth-js_homepage_blocks-js_homepage_introblock').css({'background':'#eee','color':'#333'});
		}
	});
	
	jQuery('#rebirth-js_homepage_blocks-js_footer_mapblock').change(function() {
		var thisValue = jQuery(this).attr('checked');
		if (thisValue == 'checked'){
			jQuery('.rebirth-js_homepage_blocks-js_footer_mapblock').css({'background':'#f5f5f5','color':'#ccc'});
		} else {
			jQuery('.rebirth-js_homepage_blocks-js_footer_mapblock').css({'background':'#eee','color':'#333'});
		}
	});
	
	jQuery('#rebirth-js_homepage_blocks-js_event_countdown').change(function() {
		var thisValue = jQuery(this).attr('checked');
		if (thisValue == 'checked'){
			jQuery('.rebirth-js_homepage_blocks-js_event_countdown').css({'background':'#f5f5f5','color':'#ccc'});
		} else {
			jQuery('.rebirth-js_homepage_blocks-js_event_countdown').css({'background':'#eee','color':'#333'});
		}
	});
	
	var thisValue = jQuery('#rebirth-js_homepage_blocks-js_homepage_slider').attr('checked');
	if (thisValue == 'checked'){
		jQuery('#of-option-homepageslider-tab').parent().hide();
		jQuery('.rebirth-js_homepage_blocks-js_homepage_slider').css({'background':'#f5f5f5','color':'#ccc'});
	} else {
		jQuery('#of-option-homepageslider-tab').parent().show();
		jQuery('.rebirth-js_homepage_blocks-js_homepage_slider').css({'background':'#eee','color':'#333'});
	}
	
	var thisValue = jQuery('#rebirth-js_homepage_blocks-js_homepage_introblock').attr('checked');
	if (thisValue == 'checked'){
		jQuery('#of-option-homepageintroblock-tab').parent().hide();
		jQuery('.rebirth-js_homepage_blocks-js_homepage_introblock').css({'background':'#f5f5f5','color':'#ccc'});
	} else {
		jQuery('#of-option-homepageintroblock-tab').parent().show();
		jQuery('.rebirth-js_homepage_blocks-js_homepage_introblock').css({'background':'#eee','color':'#333'});
	}
	
	var thisValue = jQuery('#rebirth-js_homepage_blocks-js_footer_mapblock').attr('checked');
	if (thisValue == 'checked'){
		jQuery('.rebirth-js_homepage_blocks-js_footer_mapblock').css({'background':'#f5f5f5','color':'#ccc'});
	} else {
		jQuery('.rebirth-js_homepage_blocks-js_footer_mapblock').css({'background':'#eee','color':'#333'});
	}
	
	var thisValue = jQuery('#rebirth-js_homepage_blocks-js_event_countdown').attr('checked');
	if (thisValue == 'checked'){
		jQuery('.rebirth-js_homepage_blocks-js_event_countdown').css({'background':'#f5f5f5','color':'#ccc'});
	} else {
		jQuery('.rebirth-js_homepage_blocks-js_event_countdown').css({'background':'#eee','color':'#333'});
	}
	// END Hide/Show Homepage Blocks
	
});
</script>

<style type="text/css">	
	.homepage-block {
		cursor:move;
		font-size:12px;
		display:block;
		text-shadow:1px 1px 0 #fff;
		background:#CCE6F7 !important;
		border:1px solid #fff;
		padding:10px;
		height:100px;
	}
	
	.homepage-block:hover { opacity:0.6; }
	
	.homepage-block.no-sorting { cursor:default; background:#eee !important; }
	.homepage-block.no-sorting:hover { opacity:1; }
	
	.homepage-block.header,
	.homepage-block.footer {
		background:#ddd;
		padding:10px 20px;
		height:auto;
	}
	
	.homepage-block.widget-block {
		padding:10px 20px;
		height:auto;
	}
	
	.homepage-block.header {
		-moz-border-radius:10px 10px 0 0; -webkit-border-radius:10px 10px 0 0; border-radius:10px 10px 0 0; 
	}
	
	.homepage-block.footer {
		-moz-border-radius:0 0 10px 10px; -webkit-border-radius:0 0 10px 10px; border-radius:0 0 10px 10px; 
	}
</style>

<?php }

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the "id" fields, make sure to use all lowercase and no spaces.
 *  
 */

function optionsframework_options() {

	// Pull all the categories into an array
	$options_categories = array();  
	$options_categories_obj = get_categories();
	$options_categories[0] = __('All','rebirth');
	foreach ($options_categories_obj as $category) {
		$options_categories[$category->cat_ID] = $category->cat_name;
	}
	
	// Pull all the Gallery Item categories into an array
	$gallery_categories = array();  
	$gallery_categories_obj = get_categories(array('taxonomy' => 'galleries'));
	$gallery_categories[0] = __('All','rebirth');
	foreach ($gallery_categories_obj as $gallery_category) {
		$gallery_categories[$gallery_category->cat_ID] = $gallery_category->cat_name;
	}
	
	// Pull all the pages into an array
	$options_pages = array();  
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages[''] = __('None (use widgets)','rebirth');
	foreach ($options_pages_obj as $page) {
    	$options_pages[$page->ID] = $page->post_title;
	}
	
	// If using image radio buttons, define a directory path
	$imagepath =  get_stylesheet_directory_uri() . '/_theme_settings/images/';
		
	$options = array();

	
	$options[] = array( "name" => __("Styling","rebirth"),
						"type" => "heading");
						
	$options[] = array( "name" => __("Custom Color","rebirth"),
						"desc" => __("You can change the custom color. (default is #DB2A07)","rebirth"),
						"id" => "js_highlight_color",
						"std" => "#DB2A07",
						"type" => "color");
	
	$options[] = array( "name" => __("Logo Replacement","rebirth"),
						"desc" => __("Upload your own logo. Keep it at 380px x 70px or smaller.","rebirth"),
						"id" => "js_logo",
						"type" => "upload");
						
	$options[] = array( "name" => __("Logo Height (optional)","rebirth"),
						"desc" => __("The default height for logos is \"70\". You can change this here by entering a new height.","rebirth"),
						"id" => "js_logo_height",
						"std" => "55",
						"type" => "text");
						
	$options[] = array( "name" => __("Background Color","rebirth"),
						"desc" => __("Choose a custom background color. (default is #EBEBEB)","rebirth"),
						"id" => "js_background_color",
						"std" => "#EBEBEB",
						"type" => "color");
						
	$options[] = array( "name" => __("Background Image","rebirth"),
						"desc" => __("Upload your own background image.","rebirth"),
						"id" => "js_background_image",
						"type" => "upload");
												
	$option_array = array('top left' => "Top Left", 'top center' => "Top Center", 'top right' => "Top Right", 'bottom left' => "Bottom Left", 'bottom center' => "Bottom Center", 'bottom right' => "Bottom Right", 'center center' => "Center Center");
		
	$options[] = array( "name" => __("Background Image Alignment","rebirth"),
						"desc" => '',
						"id" => "js_background_image_alignment",
						"std" => false,
						"type" => "radio",
						"options" => $option_array);
						
	$option_array = array('no-repeat' => 'No Repeat', 'repeat-x' => "Repeat-X", 'repeat-y' => "Repeat-Y", 'repeat' => "Repeat");
		
	$options[] = array( "name" => __("Background Repeat?","rebirth"),
						"desc" => '',
						"id" => "js_background_image_repeat",
						"std" => false,
						"type" => "radio",
						"options" => $option_array);
						
	$option_array = array('light' => 'Light', 'dark' => "Dark");
		
	$options[] = array( "name" => __("Footer Text Style","rebirth"),
						"desc" => __("Use \"Light\" for light backgrounds and \"Dark\" for dark backgrounds.","rebirth"),
						"id" => "js_footer_text_style",
						"std" => 'light',
						"type" => "radio",
						"options" => $option_array);
						
	$options[] = array( "name" => __("Sticky Background?","rebirth"),
						"desc" => __("Check this to make the background sticky when scrolling (fixed)","rebirth"),
						"id" => "js_background_image_fixed",
						"std" => "0",
						"label" => "Make background sticky (fixed)",
						"type" => "checkbox");
						
	$options[] = array( "name" => __("Favicon Replacement","rebirth"),
						"desc" => __("Upload your own favicon. Be sure it's a 16px x 16px \"ico\" or \"png\" file.","rebirth"),
						"id" => "js_favicon",
						"type" => "upload");
						
	
	
	$options[] = array( "name" => __("Custom Fonts","rebirth"),
						"type" => "heading");
						
	$options[] = array( "name" => __("Custom Font","rebirth"),
						"desc" => __("Which custom font would you like to use?","rebirth"),
						"id" => "js_custom_font",
						"std" => "Architects+Daughter",
						"type" => "images",
						"options" => array(
							'sans-serif' => $imagepath .'font_sansserif.jpg',
							'Architects+Daughter' => $imagepath . 'font_ad.jpg',
							'Alice' => $imagepath . 'font_alice.jpg',
							'Bitter' => $imagepath . 'font_bitter.jpg',
							'Lancelot' => $imagepath . 'font_lancelot.jpg',
							'Lobster+Two:400italic' => $imagepath . 'font_lobster.jpg',
							'Yanone+Kaffeesatz' => $imagepath .'font_yanone.jpg',
							'Alegreya:700' => $imagepath .'font_alegreya.jpg',
							'Open+Sans' => $imagepath . 'font_os.jpg')
						);
						
	
	
	$options[] = array( "name" => __("Comment Disabling","rebirth"),
						"type" => "heading");
			
	$option_array = array('yes' => "Yes",'no' => "No");
		
	$options[] = array( "name" => __("Disable comments on pages?","rebirth"),
						"desc" => __("Select 'yes' if you want to hide the commenting for all pages.","rebirth"),
						"id" => "js_disable_page_comments",
						"std" => false,
						"type" => "radio",
						"options" => $option_array);
		
	$options[] = array( "name" => __("Disable comments on posts?","rebirth"),
						"desc" => __("Select 'yes' if you want to hide the commenting for all posts.","rebirth"),
						"id" => "js_disable_post_comments",
						"std" => false,
						"type" => "radio",
						"options" => $option_array);
						
	$options[] = array( "name" => __("Disable comments on events?","rebirth"),
						"desc" => __("Select 'yes' if you want to hide the commenting for all audio posts.","rebirth"),
						"id" => "js_disable_event_comments",
						"std" => false,
						"type" => "radio",
						"options" => $option_array);
		
	$options[] = array( "name" => __("Disable comments on photo galleries?","rebirth"),
						"desc" => __("Select 'yes' if you want to hide the commenting for all gallery posts.","rebirth"),
						"id" => "js_disable_gallery_comments",
						"std" => false,
						"type" => "radio",
						"options" => $option_array);
						
	$options[] = array( "name" => __("Disable comments on video posts?","rebirth"),
						"desc" => __("Select 'yes' if you want to hide the commenting for all video posts.","rebirth"),
						"id" => "js_disable_video_comments",
						"std" => false,
						"type" => "radio",
						"options" => $option_array);
						
	$options[] = array( "name" => __("Disable comments on audio posts?","rebirth"),
						"desc" => __("Select 'yes' if you want to hide the commenting for all audio posts.","rebirth"),
						"id" => "js_disable_audio_comments",
						"std" => false,
						"type" => "radio",
						"options" => $option_array);
						
						
	
	$options[] = array( "name" => __("Homepage Blocks","rebirth"),
						"type" => "heading");
			
	$options[] = array( "name" => __("Use a Page instead of the \"Horizontal Widgets\" on the Homepage.","rebirth"),
						"desc" => __("Optionally, you can choose a page to display in place of the horizontal widget area.","rebirth"),
						"id" => "js_homepage_page_display",
						"std" => "",
						"type" => "select",
						"options" => $options_pages);
						
	$sort_order = of_get_option('js_homepage_block_order');
	if (isset($sort_order) && $sort_order){
		$option_array = array();
		$sort_order = explode(',',$sort_order);
		foreach($sort_order as $item){
			if ($item == 'countdown'){
				$option_array['js_event_countdown'] = __('Hide Event Countdown','rebirth');
			} else if ($item == 'slider'){
				$option_array['js_homepage_slider'] = __('Hide Homepage Slider','rebirth');
			} else if ($item == 'introblock'){
				$option_array['js_homepage_introblock'] = __('Hide Homepage Intro Block','rebirth');
			} else if ($item == 'mapblock'){
				$option_array['js_footer_mapblock'] = __('Hide Footer Contact/Map Block','rebirth');
			} else if ($item == 'block'){
				if (of_get_option('js_homepage_page_display')){ $homepage_mainsection_text = '"Page - '.get_the_title(of_get_option('js_homepage_page_display')).'"'; } else { $homepage_mainsection_text = __('"Homepage Horizontal Widget Blocks"','rebirth'); }
				$option_array['widget_block'] = $homepage_mainsection_text;
			}
		}
		$option_array['js_footer_mapblock'] = __('Hide Footer Contact/Map Block','rebirth');
	} else {
		$option_array = array('js_event_countdown' => __('Hide Event Countdown','rebirth'),'js_homepage_slider' => __('Hide Homepage Slider','rebirth'),'js_homepage_introblock' => __('Hide Homepage Intro Block','rebirth'),'widget_block' => __('"Homepage Horizontal Widget Blocks"','rebirth'), 'js_footer_mapblock' => __('Hide Footer Contact/Map Block','rebirth'));
	}
		
	$options[] = array( "name" => __("Homepage Blocks","rebirth"),
						"desc" => __("You can choose to hide specific blocks on the Homepage.","rebirth"),
						"id" => "js_homepage_blocks",
						"std" => true,
						"type" => "multicheckHomepageBlocks",
						"options" => $option_array);
						
	$options[] = array( "name" => "",
						"desc" => "",
						"id" => "js_homepage_block_order",
						"std" => "",
						"hidden_flag" => true,
						"type" => "text");
						
						
						
	$options[] = array( "name" => __("Homepage Slider","rebirth"),
						"type" => "heading");
						
	$option_array = array('yes' => __("Yes","rebirth"),'no' => __("No","rebirth"));
		
	$options[] = array( "name" => __("Automatically Cycle the Slider?","rebirth"),
						"desc" => __("Say yes if you want the homepage slider to automatically cycle through the images.","rebirth"),
						"id" => "js_homepage_slider_cycle",
						"std" => 'yes',
						"type" => "radio",
						"options" => $option_array);
	
	$option_array = array(
		"1000" => __("1 Second","rebirth"),
		"2000" => __("2 Seconds","rebirth"),
		"3000" => __("3 Seconds","rebirth"),
		"4000" => __("4 Seconds","rebirth"),
		"5000" => __("5 Seconds","rebirth"),
		"6000" => __("6 Seconds","rebirth"),
		"7000" => __("7 Seconds","rebirth"),
		"8000" => __("8 Seconds","rebirth"),
		"9000" => __("9 Seconds","rebirth"),
		"10000" => __("10 Seconds","rebirth"));

	$options[] = array( "name" => __("Cycle Speed","rebirth"),
						"desc" => __("How many seconds between each slide?","rebirth"),
						"id" => "js_homepage_slider_speed",
						"std" => "6000",
						"type" => "select",
						"options" => $option_array);
						
	$option_array = array(
		"1000" => __("Slowest","rebirth"),
		"700" => __("Slow","rebirth"),
		"500" => __("Normal","rebirth"),
		"350" => __("Fast","rebirth"),
		"200" => __("Fastest","rebirth"));

	$options[] = array( "name" => __("Transition Speed","rebirth"),
						"desc" => __("How fast should the slides transition?","rebirth"),
						"id" => "js_homepage_slider_transition_speed",
						"std" => "500",
						"type" => "select",
						"options" => $option_array);
						
						
						
	$options[] = array( "name" => __("Homepage Intro Block","rebirth"),
						"type" => "heading");
						
	$options[] = array( "name" => __("Homepage Intro Block Text","rebirth"),
						"desc" => __("This text shows up under the widgets under the slider.","rebirth"),
						"id" => "js_homepage_intro_text",
						"std" => __("rebirth! The amazing template for amazing churches everywhere.","rebirth"),
						"type" => "textarea");
	
	
	
	$options[] = array( "name" => __("Social Settings","rebirth"),
						"type" => "heading");
						
	$options[] = array( "name" => __("Facebook","rebirth"),
						"desc" => __("Paste your Facebook profile or page URL here.","rebirth"),
						"id" => "js_social_icon_facebook",
						"std" => "",
						"type" => "text");
						
	$options[] = array( "name" => __("Twitter","rebirth"),
						"desc" => __("Paste your Twitter profile URL here.","rebirth"),
						"id" => "js_social_icon_twitter",
						"std" => "",
						"type" => "text");
						
	$options[] = array( "name" => __("Flickr","rebirth"),
						"desc" => __("Paste your Flickr profile URL here.","rebirth"),
						"id" => "js_social_icon_flickr",
						"std" => "",
						"type" => "text");
						
	$options[] = array( "name" => __("Youtube","rebirth"),
						"desc" => __("Paste your Youtube profile URL here.","rebirth"),
						"id" => "js_social_icon_youtube",
						"std" => "",
						"type" => "text");
						
	$options[] = array( "name" => __("Vimeo","rebirth"),
						"desc" => __("Paste your Vimeo profile URL here.","rebirth"),
						"id" => "js_social_icon_vimeo",
						"std" => "",
						"type" => "text");
						
	$options[] = array( "name" => __("Foursquare","rebirth"),
						"desc" => __("Paste your Foursquare profile URL here.","rebirth"),
						"id" => "js_social_icon_foursquare",
						"std" => "",
						"type" => "text");
				
				
						
	$options[] = array( "name" => __("Localization","rebirth"),
						"type" => "heading");
						
	$option_array = array(
		"12h" => __("12-Hour Format (am/pm)","rebirth"),
		"24h" => __("24-Hour Format","rebirth"));

	$options[] = array( "name" => __("Time Format","rebirth"),
						"desc" => __("Choose time format.","rebirth"),
						"id" => "js_time_format",
						"std" => "12h",
						"type" => "select",
						"options" => $option_array);
						
	$option_array = array(
		"english" => __("English","rebirth"),
		"german" => __("Deutsch (German)","rebirth"),
		"spanish" => __("Espanol (Spanish)","rebirth"),
		"french" => __("Francais (French)","rebirth"),
		"italian" => __("Italiano (Italian)","rebirth"));

	$options[] = array( "name" => __("Event Countdown Language","rebirth"),
						"desc" => __("Choose a language for the countdown timer.","rebirth"),
						"id" => "js_countdown_language",
						"std" => "english",
						"type" => "select",
						"options" => $option_array);
						
						
						
	$options[] = array( "name" => __("Footer Options","rebirth"),
						"type" => "heading");
												
	$options[] = array( "name" => __("Footer Contact Block - Title","rebirth"),
						"desc" => __("You can edit the title of the contact block here.","rebirth"),
						"id" => "js_contactblock_title",
						"std" => "Come and Visit!",
						"type" => "text");
	
	$options[] = array( "name" => __("Footer Contact Block - Short Message","rebirth"),
						"desc" => __("You can edit the short message in the contact block here.","rebirth"),
						"id" => "js_contactblock_text",
						"std" => "<p>".__("Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut. Lorem ipsum dolor sit amet.","rebirth")."</p>",
						"type" => "textarea");
	
	$options[] = array( "name" => __("Footer Contact Block - Address","rebirth"),
						"desc" => __("Enter your Address here. <strong>NOTE: If you leave this blank, the entire contact block will be hidden.</strong>","rebirth"),
						"id" => "js_contactblock_address",
						"std" => '1 Infinite Loop\nCupertino, CA',
						"type" => "textarea");
						
	$options[] = array( "name" => __("Footer Contact Block - Button Text","rebirth"),
						"desc" => __("Enter some text for the button (optional)","rebirth"),
						"id" => "js_contactblock_buttontext",
						"std" => "Get Directions",
						"type" => "text");
						
	$options[] = array( "name" => __("Footer Contact Block - Button Link","rebirth"),
						"desc" => __("Enter a link for the button (optional)","rebirth"),
						"id" => "js_contactblock_buttonlink",
						"std" => "/contact/",
						"type" => "text");
						
	$options[] = array( "name" => __("Right Footer Text","rebirth"),
						"desc" => __("You can use [year] to display the year.","rebirth"),
						"id" => "js_footer_text",
						"std" => "Copyright &copy;[year] Justin Scheetz",
						"type" => "text");
	
						
	
	$options[] = array( "name" => __("Other Options","rebirth"),
						"type" => "heading");
						
	$option_array = array(
		"10" => __("Far away","rebirth"),
		"14" => __("Normal","rebirth"),
		"16" => __("Closer","rebirth"),
		"18" => __("Closest","rebirth"));

	$options[] = array( "name" => __("Google Maps - Zoom Level","rebirth"),
						"desc" => __("Choose a zoom level for all Google Maps.","rebirth"),
						"id" => "js_gmap_zoom",
						"std" => "12",
						"type" => "select",
						"options" => $option_array);
						
	$options[] = array( "name" => __("Hide social tab?","rebirth"),
						"desc" => __("Hide the social tab throughout the site.","rebirth"),
						"id" => "js_hide_social",
						"std" => "0",
						"label" => "Hide the social tab throughout the site.",
						"type" => "checkbox");
		
	$options[] = array( "name" => __("Hide breadcrumbs?","rebirth"),
						"desc" => __("Hide breadcrumbs throughout the site.","rebirth"),
						"id" => "js_disable_breadcrumbs",
						"std" => "0",
						"label" => "Hide breadcrumbs throughout the site.",
						"type" => "checkbox");
						
	$options[] = array( "name" => __("Link Audio items directly to post?","rebirth"),
						"desc" => __("Instead of playing audio inline, the theme should just link directly to the post.","rebirth"),
						"id" => "js_audio_link",
						"std" => "0",
						"label" => "Link Audio items directly to post.",
						"type" => "checkbox");
						
	$options[] = array( "name" => __("Link Video items directly to post?","rebirth"),
						"desc" => __("Instead of playing video inline, the theme should just link directly to the post.","rebirth"),
						"id" => "js_video_link",
						"std" => "0",
						"label" => "Link Video items directly to post.",
						"type" => "checkbox");
						
	$options[] = array( "name" => __("Contact Page Map","rebirth"),
						"desc" => __("Hide the map and show the featured image instead, or nothing if no featured image is set.","rebirth"),
						"id" => "js_hide_contactmap",
						"std" => "0",
						"label" => "Hide the map and show the featured image.",
						"type" => "checkbox");
						
	$options[] = array( "name" => __("Contact Form \"To\" Email","rebirth"),
						"desc" => __("Where do you want messages from the contact form sent?","rebirth"),
						"id" => "js_contact_form_email",
						"std" => "",
						"type" => "text");
						
	$options[] = array( "name" => __("404 Page Content","rebirth"),
						"desc" => __("This is what will show up on the 404 page. HTML Allowed.","rebirth"),
						"id" => "js_404_content",
						"std" => "<p>".__("Sorry, the page cannot be found.","rebirth")."</p>",
						"type" => "textarea");
						
	$options[] = array( "name" => __("Google Analytics Code","glory"),
						"desc" => __("Enter your code, this shows up right above the </head> tag.","glory"),
						"id" => "js_google_analytics",
						"std" => "",
						"type" => "textarea");
	
	
		
	
			
	return $options;
}