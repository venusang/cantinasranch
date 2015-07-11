<?php
function register_post_types() {
	
	// Galleries
	$labels = array(
		'name' => __('Galleries','rebirth'),
		'singular_name' => __('Gallery','rebirth'),
		'add_new' => __('Add New Gallery','rebirth'),
		'add_new_item' => __('Add New Gallery','rebirth'),
		'edit_item' => __('Edit Gallery','rebirth'),
		'new_item' => __('New Gallery','rebirth'),
		'view_item' => __('View Gallery','rebirth'),
		'search_items' => __('Search Galleries','rebirth'),
		'not_found' => __('No Galleries Found','rebirth'),
		'not_found_in_trash' => __('No Galleries Found In Trash','rebirth'),
		'parent_item_colon' => __('Parent Gallery:','rebirth')
	);
	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true, 
		'query_var' => true,
		'rewrite' => array(
			'slug' => 'gallery',
			'with_front' => false
		),
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => null,
		'menu_icon' => get_template_directory_uri().'/_theme_settings/images/menu_icon_gallery.png',
		'supports' => array('title','editor', 'page-attributes','thumbnail','comments','author'),
		'has_archive' => 'galleries'
	); 
	register_post_type('gallery-items', $args);
	
	$labels = array(
	    'name' => _x( 'Gallery Categories', 'taxonomy general name','rebirth' ),
	    'singular_name' => _x( 'Gallery Category', 'taxonomy singular name','rebirth' ),
	    'search_items' =>  __( 'Search Gallery Categories','rebirth' ),
	    'popular_items' => __( 'Popular Gallery Categories','rebirth' ),
	    'all_items' => __( 'All Gallery Categories','rebirth' ),
	    'parent_item' => null,
	    'parent_item_colon' => null,
	    'edit_item' => __( 'Edit Gallery Category','rebirth' ), 
	    'update_item' => __( 'Update Gallery Category','rebirth' ),
	    'add_new_item' => __( 'Add New Gallery Category','rebirth' ),
	    'new_item_name' => __( 'New Gallery Category Name','rebirth' ),
	    'separate_items_with_commas' => __( 'Separate Gallery Categories with commas','rebirth' ),
	    'add_or_remove_items' => __( 'Add or remove Gallery Categories','rebirth' ),
	    'choose_from_most_used' => __( 'Choose from the most used Gallery Categories','rebirth' )
	);
	
	$args = array(
		'hierarchical' => true,
		'labels' => $labels,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array(
			"with_front" => true,
		),
	);
	register_taxonomy('galleries', 'gallery-items', $args);
	
	
	// Videos
	$labels = array(
		'name' => __('Videos','rebirth'),
		'singular_name' => __('Video','rebirth'),
		'add_new' => __('Add New Video','rebirth'),
		'add_new_item' => __('Add New Video','rebirth'),
		'edit_item' => __('Edit Video','rebirth'),
		'new_item' => __('New Video','rebirth'),
		'view_item' => __('View Video','rebirth'),
		'search_items' => __('Search Videos','rebirth'),
		'not_found' => __('No Videos Found','rebirth'),
		'not_found_in_trash' => __('No Videos Found In Trash','rebirth'),
		'parent_item_colon' => __('Parent Video:','rebirth')
	);
	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true, 
		'query_var' => true,
		'rewrite' => array(
			'slug' => 'video',
			'with_front' => false
		),
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => null,
		'menu_icon' => get_template_directory_uri().'/_theme_settings/images/menu_icon_video.png',
		'supports' => array('title','editor', 'page-attributes','thumbnail','comments','author'),
		'has_archive' => 'videos'
	); 
	register_post_type('video-items', $args);
	
	$labels = array(
	    'name' => _x( 'Video Categories', 'taxonomy general name','rebirth' ),
	    'singular_name' => _x( 'Video Category', 'taxonomy singular name','rebirth' ),
	    'search_items' =>  __( 'Search Video Categories','rebirth' ),
	    'popular_items' => __( 'Popular Video Categories','rebirth' ),
	    'all_items' => __( 'All Video Categories','rebirth' ),
	    'parent_item' => null,
	    'parent_item_colon' => null,
	    'edit_item' => __( 'Edit Video Category','rebirth' ), 
	    'update_item' => __( 'Update Video Category','rebirth' ),
	    'add_new_item' => __( 'Add New Video Category','rebirth' ),
	    'new_item_name' => __( 'New Video Category Name','rebirth' ),
	    'separate_items_with_commas' => __( 'Separate Video Categories with commas','rebirth' ),
	    'add_or_remove_items' => __( 'Add or remove Video Categories','rebirth' ),
	    'choose_from_most_used' => __( 'Choose from the most used Video Categories','rebirth' )
	);
	
	$args = array(
		'hierarchical' => true,
		'labels' => $labels,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array(
			"with_front" => true,
		),
	);
	register_taxonomy('videos', 'video-items', $args);
	
	// Audio Items
	$labels = array(
		'name' => __('Audio Items','rebirth'),
		'singular_name' => __('Audio Item','rebirth'),
		'add_new' => __('Add New Audio Item','rebirth'),
		'add_new_item' => __('Add New Audio Item','rebirth'),
		'edit_item' => __('Edit Audio Item','rebirth'),
		'new_item' => __('New Audio Item','rebirth'),
		'view_item' => __('View Audio Item','rebirth'),
		'search_items' => __('Search Audio Items','rebirth'),
		'not_found' => __('No Audio Items Found','rebirth'),
		'not_found_in_trash' => __('No Audio Items Found In Trash','rebirth'),
		'parent_item_colon' => __('Parent Audio Item:','rebirth')
	);
	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true, 
		'query_var' => true,
		'rewrite' => array(
			'slug' => 'audio-items',
			'with_front' => false
		),
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => null,
		'menu_icon' => get_template_directory_uri().'/_theme_settings/images/menu_icon_audio.png',
		'supports' => array('title','editor','page-attributes','thumbnail','comments','author'),
		'has_archive' => 'audio'
	); 
	register_post_type('audio-items', $args);
	
	$labels = array(
	    'name' => _x( 'Audio Categories', 'taxonomy general name','rebirth' ),
	    'singular_name' => _x( 'Audio Category', 'taxonomy singular name','rebirth' ),
	    'search_items' =>  __( 'Search Audio Categories','rebirth' ),
	    'popular_items' => __( 'Popular Audio Categories','rebirth' ),
	    'all_items' => __( 'All Audio Categories','rebirth' ),
	    'parent_item' => null,
	    'parent_item_colon' => null,
	    'edit_item' => __( 'Edit Audio Category','rebirth' ), 
	    'update_item' => __( 'Update Audio Category','rebirth' ),
	    'add_new_item' => __( 'Add New Audio Category','rebirth' ),
	    'new_item_name' => __( 'New Audio Category Name','rebirth' ),
	    'separate_items_with_commas' => __( 'Separate Audio Categories with commas','rebirth' ),
	    'add_or_remove_items' => __( 'Add or remove Audio Categories','rebirth' ),
	    'choose_from_most_used' => __( 'Choose from the most used Audio Categories','rebirth' )
	);
	
	$args = array(
		'hierarchical' => true,
		'labels' => $labels,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array(
			"with_front" => true,
		),
	);
	register_taxonomy('audio', 'audio-items', $args);
	
	
	// Events
	$labels = array(
		'name' => __('Events','rebirth'),
		'singular_name' => __('Event','rebirth'),
		'add_new' => __('Add New Event','rebirth'),
		'add_new_item' => __('Add New Event','rebirth'),
		'edit_item' => __('Edit Event','rebirth'),
		'new_item' => __('New Event','rebirth'),
		'view_item' => __('View Event','rebirth'),
		'search_items' => __('Search Events','rebirth'),
		'not_found' => __('No Events Found','rebirth'),
		'not_found_in_trash' => __('No Events Found In Trash','rebirth'),
		'parent_item_colon' => __('Parent Event:','rebirth')
	);
	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true, 
		'query_var' => true,
		'rewrite' => array(
			'slug' => 'event',
			'with_front' => false
		),
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => null,
		'menu_icon' => get_template_directory_uri().'/_theme_settings/images/menu_icon_events.png',
		'supports' => array('title','editor', 'page-attributes','thumbnail','comments','author'),
		'has_archive' => 'events'
	); 
	register_post_type('event-items', $args);
	
	$labels = array(
	    'name' => _x( 'Event Categories', 'taxonomy general name','rebirth' ),
	    'singular_name' => _x( 'Event Category', 'taxonomy singular name','rebirth' ),
	    'search_items' =>  __( 'Search Event Categories','rebirth' ),
	    'popular_items' => __( 'Popular Event Categories','rebirth' ),
	    'all_items' => __( 'All Event Categories','rebirth' ),
	    'parent_item' => null,
	    'parent_item_colon' => null,
	    'edit_item' => __( 'Edit Event Category','rebirth' ), 
	    'update_item' => __( 'Update Event Category','rebirth' ),
	    'add_new_item' => __( 'Add New Event Category','rebirth' ),
	    'new_item_name' => __( 'New Event Category Name','rebirth' ),
	    'separate_items_with_commas' => __( 'Separate Event Categories with commas','rebirth' ),
	    'add_or_remove_items' => __( 'Add or remove Event Categories','rebirth' ),
	    'choose_from_most_used' => __( 'Choose from the most used Event Categories','rebirth' )
	);
	
	$args = array(
		'hierarchical' => true,
		'labels' => $labels,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array(
			"with_front" => true,
		),
	);
	register_taxonomy('events', 'event-items', $args);

	// Slides
	$labels = array(
		'name' => __('Slides','glory'),
		'singular_name' => __('Slide','glory'),
		'add_new' => __('Add New Slide','glory'),
		'add_new_item' => __('Add New Slide','glory'),
		'edit_item' => __('Edit Slide','glory'),
		'new_item' => __('New Slide','glory'),
		'view_item' => __('View Slide','glory'),
		'search_items' => __('Search Slides','glory'),
		'not_found' => __('No Slides Found','glory'),
		'not_found_in_trash' => __('No Slides Found In Trash','glory'),
		'parent_item_colon' => __('Parent Slide:','glory')
	);
	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true, 
		'query_var' => true,
		'rewrite' => array(
			'slug' => 'slide',
			'with_front' => false
		),
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => null,
		'menu_icon' => get_template_directory_uri().'/_theme_settings/images/menu_icon_slides.png',
		'supports' => array('title','page-attributes','thumbnail'),
		'has_archive' => false
	); 
	register_post_type('slide-items', $args);
}

add_action('init', 'register_post_types');
?>