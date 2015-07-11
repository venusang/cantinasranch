<?php
// Post Thumbnails
add_theme_support('post-thumbnails', array('post','gallery-items','audio-items','video-items','page','event-items','slide-items'));
set_post_thumbnail_size(75,75,true);
add_image_size('post',586,300,true);
add_image_size('post-thumb',55,55,true);
add_image_size('lightbox-large',1000,1000,false);
add_image_size('large-full-banner',940,250,true);
add_image_size('medium',300,200,true);
add_image_size('thumbnail',140,140,true);
add_image_size('medium-thumbnail',220,148,true);
add_image_size('event-thumbnail',220,98,true);
add_image_size('slide-image',940,410,true);

add_post_type_support( 'post', 'page-attributes' );

// Navigation
add_theme_support('menus');
register_nav_menus(array( 'main-menu' => __( 'Main Menu','rebirth' ), 'footer-menu' => __( 'Footer Menu','rebirth' )));

// Fix <p>'s and <br>'s from showing up around shortcodes.
add_filter('the_content', 'shortcode_empty_paragraph_fix');
function shortcode_empty_paragraph_fix($content)
{   
    $array = array ( '<p>[' => '[', ']</p>' => ']', ']<br />' => ']' );
    $content = strtr($content, $array);
    return $content;
}


?>