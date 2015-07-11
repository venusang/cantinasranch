<?php
if (function_exists('register_sidebar')) {

	// Default
	register_sidebar(array(
		'name' => __('Default Sidebar','rebirth'),
		'id'   => 'default-sidebar',
		'description'   => __('IMPORTANT: These widgets will show up in every sidebar.','rebirth'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '<div class="cl"></div></div>',
		'before_title'  => '<h3 class="bitter">',
		'after_title'   => '</h3>'
	));
	
	// Homepage - Horizontal Widget Blocks
	register_sidebar(array(
		'name' => __('Homepage - Horizontal Widget Blocks','rebirth'),
		'id'   => 'homepage-horizontal-blocks',
		'description'   => __('These widgets are horizontal "book-shelf" style widgets that show up on the homepage.','rebirth'),
		'before_widget' => '',
		'after_widget'  => '',
		'before_title'  => '<h3 class="bitter">',
		'after_title'   => '</h3>'
	));
		
	// Pages
	register_sidebar(array(
		'name' => __('Page Sidebar','rebirth'),
		'id'   => 'page-sidebar',
		'description'   => __('These widgets will show up on pages only.','rebirth'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '<div class="cl"></div></div>',
		'before_title'  => '<h3 class="bitter">',
		'after_title'   => '</h3>'
	));
	
	// Posts
	register_sidebar(array(
		'name' => __('Post Sidebar','rebirth'),
		'id'   => 'post-sidebar',
		'description'   => __('These widgets will show up on posts only.','rebirth'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '<div class="cl"></div></div>',
		'before_title'  => '<h3 class="bitter">',
		'after_title'   => '</h3>'
	));
	
	// Events
	register_sidebar(array(
		'name' => __('Event Sidebar','rebirth'),
		'id'   => 'events-sidebar',
		'description'   => __('These widgets will show up on Event posts only.','rebirth'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '<div class="cl"></div></div>',
		'before_title'  => '<h3 class="bitter">',
		'after_title'   => '</h3>'
	));
	
	// Galleries
	register_sidebar(array(
		'name' => __('Galleries Sidebar','rebirth'),
		'id'   => 'galleries-sidebar',
		'description'   => __('These widgets will show up on Gallery posts only.','rebirth'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '<div class="cl"></div></div>',
		'before_title'  => '<h3 class="bitter">',
		'after_title'   => '</h3>'
	));
	
	// Audio
	register_sidebar(array(
		'name' => __('Audio Sidebar','rebirth'),
		'id'   => 'audio-sidebar',
		'description'   => __('These widgets will show up on Audio posts only.','rebirth'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '<div class="cl"></div></div>',
		'before_title'  => '<h3 class="bitter">',
		'after_title'   => '</h3>'
	));
	
	// Videos
	register_sidebar(array(
		'name' => __('Videos Sidebar','rebirth'),
		'id'   => 'videos-sidebar',
		'description'   => __('These widgets will show up on Video posts only.','rebirth'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '<div class="cl"></div></div>',
		'before_title'  => '<h3 class="bitter">',
		'after_title'   => '</h3>'
	));
	
	// Media
	register_sidebar(array(
		'name' => __('Media Sidebar','rebirth'),
		'id'   => 'media-sidebar',
		'description'   => __('These widgets will show up on the Media Page Template only.','rebirth'),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '<div class="cl"></div></div>',
		'before_title'  => '<h3 class="bitter">',
		'after_title'   => '</h3>'
	));
	
}
?>