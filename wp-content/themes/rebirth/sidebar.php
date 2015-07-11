<?php

if (function_exists('dynamic_sidebar')) :

	if (get_post_type() == 'audio-items'){
		
			dynamic_sidebar('default-sidebar');
			dynamic_sidebar('audio-sidebar');
		
	} else if (get_post_type() == 'gallery-items'){
		
			dynamic_sidebar('default-sidebar');
			dynamic_sidebar('galleries-sidebar');
		
	} else if (get_post_type() == 'video-items'){
		
			dynamic_sidebar('default-sidebar');
			dynamic_sidebar('videos-sidebar');
		
	} else if (get_post_type() == 'event-items' || is_page_template('page-eventarchive.php') || is_page_template('page-upcomingevents.php')){
		
			dynamic_sidebar('default-sidebar');
			dynamic_sidebar('events-sidebar');
		
	} else if (is_page_template('page-allmedia.php')){
		
			dynamic_sidebar('default-sidebar');
			dynamic_sidebar('media-sidebar');
		
	} else if (is_page()){
		
			dynamic_sidebar('default-sidebar');
			dynamic_sidebar('page-sidebar');
		
	} else if (is_single() || is_archive() || is_category() || is_search()){
		
			dynamic_sidebar('default-sidebar');
			dynamic_sidebar('post-sidebar');
		
	} else {
	
		dynamic_sidebar('default-sidebar');
	
	}


endif;

?>