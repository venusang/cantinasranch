<?php

/* ------------------------------------ */
/* Shortcode Generator	 				*/
/* ------------------------------------ */

// Action target that adds the "Insert Product(s)" button to the post/page edit screen.
function js_add_gallery_button($context){
    $image_btn = get_template_directory_uri().'/_theme_settings/images/shortcode_gallery-icon.png';
    $out = '<a href="#TB_inline?width=450&inlineId=insert_gallery" class="thickbox" title="Insert Gallery"><img src="'.$image_btn.'" alt="Insert Gallery" /></a>';
    return $context . $out;
}

add_action('admin_footer','js_add_mce_popup');
add_action('media_buttons_context','js_add_gallery_button');

//Action target that displays the popup to insert a form to a post/page
function js_add_mce_popup(){
    ?>
   	<div id="insert_gallery" style="display:none;">
        <div class="wrap">
            <div>
            	
                <div style="padding:15px 15px 0 15px;">
                    <h3 style="color:#5A5A5A!important; font-family:Georgia,Times New Roman,Times,serif!important; font-size:1.8em!important; font-weight:normal!important;">rebirth &mdash; Gallery Generator</h3>
                   	<span>Please create your product shortcode using the options below.</span>
                </div>
                    
                <div style="padding:15px 15px 0 15px;">
                
                    <select id="js_gallery_shortcode_size">
                        <option value="">Thumbnail Image Size...</option>
                        <option value="medium">Medium</option>
                        <option value="thumbnail">Small</option>
                  	</select>
                  	
                  	<input type="checkbox" id="js_gallery_shortcode_hidefeatured" name="hide_featured" value="1" /> Hide the featured image from the gallery.
                      
                </div>
                <div style="padding:15px;">
                    <input type="button" class="button-primary" value="Insert Gallery" onclick="InsertGallery();"/>&nbsp;&nbsp;&nbsp;
                	<a class="button" style="color:#bbb;" href="#" onclick="tb_remove(); return false;">Cancel</a>
                </div>
                
            </div>
        </div>
    </div>
    
  	<script type="text/javascript">
     
        function InsertGallery(){ 
            var size = jQuery("#js_gallery_shortcode_size").val();
            var hideFeatured = jQuery("#js_gallery_shortcode_hidefeatured").attr('checked');
            if (size == 'medium'){
            	if (hideFeatured) { var extraStuff = ' hide_featured="1"'; } else { var extraStuff = ''; }
            	var win = window.dialogArguments || opener || parent || top;
				win.send_to_editor('[display-gallery size="medium"'+extraStuff+']');
            } else if (size == 'thumbnail') {
            	if (hideFeatured) { var extraStuff = ' hide_featured="1"'; } else { var extraStuff = ''; }
            	var win = window.dialogArguments || opener || parent || top;
				win.send_to_editor('[display-gallery size="thumbnail"'+extraStuff+']');
            } else {
            	alert("Please choose an image size for this gallery.");
                return;
            }
        }
        
    </script>

    <?php
}

function js_display_gallery( $atts, $content=null ) {
	extract( shortcode_atts( array(
		'type' => 'normal',
		'size' => 'medium',
		'hide_featured' => '',
	), $atts ) );

	$gallery_content = '';

	// Normal Gallery
	if ($type == 'normal'){
		
		if ( get_query_var('paged') ) { $paged = get_query_var('paged'); } 
		elseif ( get_query_var('page') ) { $paged = get_query_var('page'); } 
		else { $paged = 1; }
		
		global $post;
		
		$featured_image_id = get_post_thumbnail_id($post->ID);
		$img_count = 0;
	
		$args = array( 'orderby' => 'menu_order', 'order' => 'ASC', 'post_type' => 'attachment', 'numberposts' => -1, 'paged'=> $paged, 'post_status' => null, 'post_parent' => $post->ID ); 
		$attachments = get_posts($args);
		if ($attachments) {
			$key = 0;
			foreach ( $attachments as $attachment ) {
				
				$attachment_id = $attachment->ID;
				$key++;
				
				if ($hide_featured && $featured_image_id == $attachment_id){
			
					// Don't include this image because the shortcode has told us to hide it.
					
				} else {
				
					$thumbnail_image = wp_get_attachment_image_src($attachment->ID,$size);
					$full_image = wp_get_attachment_image_src($attachment->ID,'full');
					if (isset($attachment->post_excerpt) && $attachment->post_excerpt){
						$attachment_urls[$key]['caption'] = $attachment->post_excerpt;
					} else if (isset($attachment->post_title) && $attachment->post_title){
						$attachment_urls[$key]['caption'] = $attachment->post_title;
					} else {
						$attachment_urls[$key]['caption'] = '';
					}
					$attachment_urls[$key]['thumb'] = $thumbnail_image[0];
					$attachment_urls[$key]['full'] = $full_image[0];
					
				}
				
			}
		}
		
		if ($size == 'medium'){
			$gallery_content .= '<div class="gallery">';
			foreach ($attachment_urls as $key => $gallery_image){
				
				$img_count++;
				if ($img_count == 3){ $last = true; } else { $last = false; }
				$gallery_content .= js_display_gallery_photo($gallery_image['full'],$gallery_image['caption'],$gallery_image['thumb'],$size,false,false,$last);
				if ($img_count == 3){ $gallery_content .= '<div class="cl"></div>'; $img_count = 0; }
				
			}
			$gallery_content .= '<div class="cl"></div></div>';
		} else if ($size == 'thumbnail'){
			$gallery_content .= '<div class="gallery">';
			foreach ($attachment_urls as $key => $gallery_image){
				
				$img_count++;
				if ($img_count == 6){ $last = true; } else { $last = false; }
				$gallery_content .= js_display_gallery_photo($gallery_image['full'],$gallery_image['caption'],$gallery_image['thumb'],$size,false,false,$last);
				if ($img_count == 6){ $gallery_content .= '<div class="cl"></div>'; $img_count = 0; }
				
			}
			$gallery_content .= '<div class="cl"></div></div>';
		}
		
	}

	return $gallery_content;
}
add_shortcode( 'display-gallery', 'js_display_gallery' );



/* COLUMNS - Since v2.2										*/
/* -------------------------------------------------------- */

function js_one_third( $atts, $content = null ) {
   return '<div class="one_third">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_third', 'js_one_third');

function js_one_third_last( $atts, $content = null ) {
   return '<div class="one_third last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}
add_shortcode('one_third_last', 'js_one_third_last');

function js_two_third( $atts, $content = null ) {
   return '<div class="two_third">' . do_shortcode($content) . '</div>';
}
add_shortcode('two_third', 'js_two_third');

function js_two_third_last( $atts, $content = null ) {
   return '<div class="two_third last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}
add_shortcode('two_third_last', 'js_two_third_last');

function js_one_half( $atts, $content = null ) {
   return '<div class="one_half">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_half', 'js_one_half');

function js_one_half_last( $atts, $content = null ) {
   return '<div class="one_half last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}
add_shortcode('one_half_last', 'js_one_half_last');

function js_one_fourth( $atts, $content = null ) {
   return '<div class="one_fourth">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_fourth', 'js_one_fourth');

function js_one_fourth_last( $atts, $content = null ) {
   return '<div class="one_fourth last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}
add_shortcode('one_fourth_last', 'js_one_fourth_last');

function js_three_fourth( $atts, $content = null ) {
   return '<div class="three_fourth">' . do_shortcode($content) . '</div>';
}
add_shortcode('three_fourth', 'js_three_fourth');

function js_three_fourth_last( $atts, $content = null ) {
   return '<div class="three_fourth last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}
add_shortcode('three_fourth_last', 'js_three_fourth_last');

function js_one_fifth( $atts, $content = null ) {
   return '<div class="one_fifth">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_fifth', 'js_one_fifth');

function js_one_fifth_last( $atts, $content = null ) {
   return '<div class="one_fifth last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}
add_shortcode('one_fifth_last', 'js_one_fifth_last');

function js_two_fifth( $atts, $content = null ) {
   return '<div class="two_fifth">' . do_shortcode($content) . '</div>';
}
add_shortcode('two_fifth', 'js_two_fifth');

function js_two_fifth_last( $atts, $content = null ) {
   return '<div class="two_fifth last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}
add_shortcode('two_fifth_last', 'js_two_fifth_last');

function js_three_fifth( $atts, $content = null ) {
   return '<div class="three_fifth">' . do_shortcode($content) . '</div>';
}
add_shortcode('three_fifth', 'js_three_fifth');

function js_three_fifth_last( $atts, $content = null ) {
   return '<div class="three_fifth last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}
add_shortcode('three_fifth_last', 'js_three_fifth_last');

function js_four_fifth( $atts, $content = null ) {
   return '<div class="four_fifth">' . do_shortcode($content) . '</div>';
}
add_shortcode('four_fifth', 'js_four_fifth');

function js_four_fifth_last( $atts, $content = null ) {
   return '<div class="four_fifth last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}
add_shortcode('four_fifth_last', 'js_four_fifth_last');

function js_one_sixth( $atts, $content = null ) {
   return '<div class="one_sixth">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_sixth', 'js_one_sixth');

function js_one_sixth_last( $atts, $content = null ) {
   return '<div class="one_sixth last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}
add_shortcode('one_sixth_last', 'js_one_sixth_last');

function js_five_sixth( $atts, $content = null ) {
   return '<div class="five_sixth">' . do_shortcode($content) . '</div>';
}
add_shortcode('five_sixth', 'js_five_sixth');

function js_five_sixth_last( $atts, $content = null ) {
   return '<div class="five_sixth last">' . do_shortcode($content) . '</div><div class="clearboth"></div>';
}
add_shortcode('five_sixth_last', 'js_five_sixth_last');

?>