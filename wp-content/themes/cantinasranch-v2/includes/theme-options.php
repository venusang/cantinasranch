<?php
if ( function_exists('register_sidebars') ) {

register_sidebar(array(
	'name' => __( 'Home One', 'gospel' ),
	'id' => 'home_one',
    'before_widget' => '',
    'after_widget' => '',
    'before_title' => '<h4>',
    'after_title' => '</h4><hr />'
));
register_sidebar(array(
	'name' => __( 'Home Two', 'gospel' ),
	'id' => 'home_two',
    'before_widget' => '',
    'after_widget' => '',
    'before_title' => '<h4>',
    'after_title' => '</h4><hr />'
));
register_sidebar(array(
	'name' => __( 'Home Three', 'gospel' ),
	'id' => 'home_three',
    'before_widget' => '',
    'after_widget' => '',
    'before_title' => '<h4>',
    'after_title' => '</h4><hr />'
));
register_sidebar(array(
	'name' => __( 'Home Four', 'gospel' ),
	'id' => 'home_four',
    'before_widget' => '',
    'after_widget' => '',
    'before_title' => '<h4>',
    'after_title' => '</h4><hr />'
));
register_sidebar(array(
	'name' => __( 'Home Five', 'gospel' ),
	'id' => 'home_five',
    'before_widget' => '',
    'after_widget' => '',
    'before_title' => '<h4>',
    'after_title' => '</h4><hr />'
));
register_sidebar(array(
	'name' => __( 'Home Six', 'gospel' ),
	'id' => 'home_six',
    'before_widget' => '',
    'after_widget' => '',
    'before_title' => '<h4>',
    'after_title' => '</h4><hr />'
));
register_sidebar(array(
	'name' => __( 'Page', 'gospel' ),
	'id' => 'page',
    'before_widget' => '',
    'after_widget' => '',
    'before_title' => '<h5>',
    'after_title' => '</h5>'
));
register_sidebar(array(
	'name' => __( 'Blog', 'gospel' ),
	'id' => 'blog',
    'before_widget' => '',
    'after_widget' => '',
    'before_title' => '<h5>',
    'after_title' => '</h5>'
));
register_sidebar(array(
	'name' => __( 'Contact Map', 'gospel' ),
	'id' => 'map',
    'before_widget' => '',
    'after_widget' => '',
    'before_title' => '<h5>',
    'after_title' => '</h5>'
));
register_sidebar(array(
	'name' => __( 'Contact Info', 'gospel' ),
	'id' => 'info',
    'before_widget' => '',
    'after_widget' => '',
    'before_title' => '<h5>',
    'after_title' => '</h5>'
));
register_sidebar(array(
	'name' => __( 'Footer One', 'gospel' ),
	'id' => 'footer_one',
    'before_widget' => '',
    'after_widget' => '',
    'before_title' => '<h6>',
    'after_title' => '</h6>'
));
register_sidebar(array(
	'name' => __( 'Footer Two', 'gospel' ),
	'id' => 'footer_two',
    'before_widget' => '',
    'after_widget' => '',
    'before_title' => '<h6>',
    'after_title' => '</h6>'
));
register_sidebar(array(
	'name' => __( 'Footer Three', 'gospel' ),
	'id' => 'footer_three',
    'before_widget' => '',
    'after_widget' => '',
    'before_title' => '<h6>',
    'after_title' => '</h6>'
));
}
?>