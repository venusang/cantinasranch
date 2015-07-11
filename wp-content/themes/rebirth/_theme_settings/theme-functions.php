<?php
function get_homepage_slides($orderby = 'menu_order', $order = 'asc'){
	
	// Get Featured Gallery Items
	$slide_items = '';
	$featured_items = get_posts(array('post_type' => array('slide-items'), 'numberposts' => -1, 'orderby' => $orderby, 'order'=>$order));
	
	// Display them in the slider
	if ($featured_items) :
		foreach ($featured_items as $i) :
		
			$slide_type = get_post_meta($i->ID, '_slide_type', true);
			$link_type = get_post_meta($i->ID, '_slide_link_type', true);
			if ($link_type && $link_type != 'custom'){
				$link_id = get_post_meta($i->ID, '_slide_link_'.$link_type, true);
				$slide_link = get_permalink($link_id);
			} else if ($link_type == 'custom'){
				$slide_link = get_post_meta($i->ID, '_slide_link_custom', true);
			} else {
				$slide_link = '';
			}

			$button_text_original = get_post_meta($i->ID, '_slide_button_text', true);
			$button_text = '';
			$button_linl = '#';
			$button_css_class = 'gallery';
				switch($slide_type) {
				case 'map':
					$button_text = '';
					$button_css_class = 'map';
					break;
				case 'image':
					$button_text = $slide_link ? __('View Page', 'born') : '';
					break;
				case 'audio':
					$button_text = __('Play Audio', 'born');
					$button_css_class = 'audio';
					break;
				case 'video':
					$button_text = __('Play Video', 'born');
					$slide_link = get_post_meta($i->ID, '_slide_video_link', true);
					$button_css_class = 'video';
					break;
				default:
					$button_text = __('View', 'born');
					break;
			}

			if($button_text_original)
				$button_text = $button_text_original;

			$button = '<a href="' . $slide_link . '" class="slide-link">
				<span class="overlay"></span>
				<span class="icon ' . $button_css_class . '"><span class="notext"></span></span>
			</a>';
			
			$slide_hide_caption = get_post_meta($i->ID, '_slide_hide_caption', true);
			if ($slide_hide_caption) { $slide_hide_caption = $slide_hide_caption[0]; } else { $slide_hide_caption = 0; }

			$caption_heading = '<h3>';
			if($button_text)
				$caption_heading .= '<a href="' . $slide_link . '" class="right">' . $button_text . '</a>';
			$caption_heading .= $i->post_title;
			$caption_heading .= '</h3>';

			if($slide_hide_caption)
				$caption_heading = '';
		
			if ($slide_type == 'image'){
		
				$caption = get_the_title($i->ID);
				
				$slide_items .= '<li>';
					if (has_post_thumbnail($i->ID)){
						$slide_items .= ($slide_link ? '<a href="'.$slide_link.'">' : '').get_the_post_thumbnail( $i->ID, 'slide-image', array('title'=>$caption)).($slide_link ? '</a>' : '');
					} else {
						$slide_items .= ($slide_link ? '<a href="'.$slide_link.'">' : '').'<img src="'.get_template_directory_uri().'/_theme_styles/images/default_slider_image.jpg" />'.($slide_link ? '</a>' : '');
					}
					if (!$slide_hide_caption){
						$slide_items .= '<section class="caption bitter">';
							$slide_items .= $caption_heading;
						$slide_items .= '</section>';
					}
					$slide_items .= $button;
				$slide_items .= '</li>';
				
			} else if ($slide_type == 'map'){
				$caption = get_the_title($i->ID);
				$map_address = get_post_meta($i->ID, '_slide_address', true);
				$map_address = nl2br($map_address);
				$map_address = str_replace(array('<br>','<br />','\'','"',',','\n'),array('+','+','','','',''),$map_address);
				$map_address = str_replace(' ','+',$map_address);
				$zoom_level = of_get_option('js_gmap_zoom');
				
				$slide_items .= '<li class="slide map-slide">';
					$slide_items .= '<iframe width="940" height="412" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q='.$map_address.'&amp;hnear='.$map_address.'&amp;t=m&amp;z='.$zoom_level.'&amp;iwloc=A&amp;output=embed"></iframe>';
					$slide_items .= '<section class="caption bitter">';
						$slide_items .= $caption_heading;
					$slide_items .= '</section>';
					#$slide_items .= $button;
				$slide_items .= '</li>';
							
			} else if ($slide_type == 'audio'){
			
				$caption = get_the_title($i->ID);
				$mp3 = get_post_meta($i->ID, '_slide_file_mp3', true);
				$external_mp3 = get_post_meta($i->ID, '_slide_file_external_mp3', true);
				$audio_mp3_file = ($external_mp3 ? $external_mp3 : home_url() . '/wp-content/uploads/'.$mp3);
				
				$slide_items .= '<li class="audio slide">';
					if (has_post_thumbnail($i->ID)){
						$slide_items .= get_the_post_thumbnail( $i->ID, 'slide-image', array('title'=>$caption));
					} else {
						$slide_items .= '<img width="940" height="412" src="'.get_template_directory_uri().'/_theme_styles/images/default_slider_image.jpg" />';
					}
					$slide_items .= '<section class="caption bitter">';
						$slide_items .= $caption_heading;
					$slide_items .= '</section>';
					$slide_items .= '<div class="players">';
						$slide_items .= '<section class="audio-container">';
							$slide_items .= '<audio data-controls-duration="false" data-controls-time="false" controls>';
								$slide_items .= '<source type="audio/mpeg" src="'.$audio_mp3_file.'" />';
							$slide_items .= '</audio>';
						$slide_items .= '</section>';
						$slide_items .= '<div class="flash-player" rel="'.$audio_mp3_file.'"><div id="audioPlayer1"></div></div>';
					$slide_items .= '</div>';
					// $slide_items .= '</section>';
					$slide_items .= '<a href="#" class="slide-link">
						<span class="overlay"></span>
						<span class="icon audio"><span class="notext">'.$audio_mp3_file.'</span></span>
					</a>';
				$slide_items .= '</li>';
			
			} else if ($slide_type == 'video'){
				$video_link = get_post_meta($i->ID, '_slide_video_link', true);
				$caption = get_the_title($i->ID);
				
				$slide_items .= '<li class="video slide">';
					if (has_post_thumbnail($i->ID)){
						$slide_items .= get_the_post_thumbnail( $i->ID, 'slide-image', array('title'=>$caption));
					} else {
						$slide_items .= '<img src="'.get_template_directory_uri().'/_theme_styles/images/default_slider_image.jpg" />';
					}
					if (!$slide_hide_caption){
						$slide_items .= '<section class="caption bitter">';
							$slide_items .= $caption_heading;
						$slide_items .= '</section>';
					}
					$slide_items .= '<a href="#" class="slide-link">
						<span class="overlay"></span>
						<span class="icon video"><span class="notext">' . $video_link . '</span></span>
					</a>';
				$slide_items .= '</li>';
			
			}
			
		endforeach;		
	endif;
	
	return $slide_items;
}

// Add Thumbnails to Page/Post management screen
if ( !function_exists('AddThumbColumn') && function_exists('add_theme_support') ) {

    function AddThumbColumn($cols) {
        $cols['thumbnail'] = __('Featured Image');
        return $cols;
    }
    function AddThumbValue($column_name, $post_id) {
        if ( 'thumbnail' == $column_name ) {
        
        	if (has_post_thumbnail( $post_id )) :
				$image_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'medium-thumbnail' );
				if (is_array($image_url)) { $image_url = $image_url[0]; }
			endif;
        
            if ( isset($image_url) && $image_url ) {
                echo '<img src="'.$image_url.'" width="100" />';
            } else {
                echo __('None');
            }
            
        }
    }
    
    // for posts
    add_filter( 'manage_posts_columns', 'AddThumbColumn' );
    add_action( 'manage_posts_custom_column', 'AddThumbValue', 10, 2 );
    
    // for pages
    add_filter( 'manage_pages_columns', 'AddThumbColumn' );
    add_action( 'manage_pages_custom_column', 'AddThumbValue', 10, 2 );
}

# Crawls the pages tree up to top level page ancestor 
# and returns that page as object
function get_page_ancestor($page_id) {
    $page_obj = get_page($page_id);
    while($page_obj->post_parent!=0) {
        $page_obj = get_page($page_obj->post_parent);
    }
    return get_page($page_obj->ID);
}

function js_display_gallery_item($post_thumbnail = '',$image_title = '',$post_link = '',$echo = true,$right = false,$post_id = ''){

	$attachments = get_children(array('post_parent'=>$post_id));
	$nbImg = count($attachments);

	$gallery_content = '';
	$gallery_content .= '<a';
	if ($right == true) { $gallery_content .= ' class="right"'; }
	$gallery_content .= ' title="'.$image_title.'" href="'.$post_link.'">';
	$gallery_content .= '<img alt="'.$image_title.'" src="'.$post_thumbnail.'" />';
	$gallery_content .= '<span class="img-title">'.$image_title.'<span class="cap"></span></span>';
	$gallery_content .= '<span class="img-cap"></span>';
	$gallery_content .= '<span class="count">'.$nbImg.'</span>';
	$gallery_content .= '</a>';
	
	if ($echo) { echo $gallery_content; } else { return $gallery_content; }
}

function js_display_gallery_photo($full_image_src = '',$image_caption = '',$post_thumbnail = '',$size = 'medium', $echo = true, $right = false, $last = false){

	$gallery_content = '';
	
	$gallery_content .= '<figure class="image'.($last ? ' last' : '').'">';
		$gallery_content .= '<a rel="gallery" title="'.$image_caption.'" href="'.$full_image_src.'" class="fancybox"><img src="'.$post_thumbnail.'" alt="" /></a>';
		$gallery_content .= '<figcaption>'.$image_caption.'</figcaption>';
	$gallery_content .= '</figure>';
	
	if ($echo) { echo $gallery_content; } else { return $gallery_content; }
}



// Pagination
function js_get_pagination($args = null) {
	$defaults = array(
		'page' => null, 'pages' => null, 
		'range' => 3, 'gap' => 3, 'anchor' => 1,
		'before' => '<div id="pagination">', 'after' => '</div><div class="cl"></div>',
		'title' => '',
		'nextpage' => __('&raquo;','rebirth'), 'previouspage' => __('&laquo','rebirth'),
		'echo' => 1
	);

	$r = wp_parse_args($args, $defaults);
	extract($r, EXTR_SKIP);

	if (!$page && !$pages) {
		global $wp_query;

		$page = get_query_var('paged');
		$page = !empty($page) ? intval($page) : 1;

		$posts_per_page = intval(get_query_var('posts_per_page'));
		$pages = intval(ceil($wp_query->found_posts / $posts_per_page));
	}
	
	$output = "";
	if ($pages > 1) {	
		$output .= $before;
		$ellipsis = "<li><span class='js-gap'>...</span></li>";

		if ($page > 1 && !empty($previouspage)) {
			$output .= "<li><a href='" . get_pagenum_link($page - 1) . "'>$previouspage</a></li>";
		}
		
		$min_links = $range * 2 + 1;
		$block_min = min($page - $range, $pages - $min_links);
		$block_high = max($page + $range, $min_links);
		$left_gap = (($block_min - $anchor - $gap) > 0) ? true : false;
		$right_gap = (($block_high + $anchor + $gap) < $pages) ? true : false;

		if ($left_gap && !$right_gap) {
			$output .= sprintf('%s%s%s', 
				js_pagination_loop(1, $anchor), 
				$ellipsis, 
				js_pagination_loop($block_min, $pages, $page)
			);
		}
		else if ($left_gap && $right_gap) {
			$output .= sprintf('%s%s%s%s%s', 
				js_pagination_loop(1, $anchor), 
				$ellipsis, 
				js_pagination_loop($block_min, $block_high, $page), 
				$ellipsis, 
				js_pagination_loop(($pages - $anchor + 1), $pages)
			);
		}
		else if ($right_gap && !$left_gap) {
			$output .= sprintf('%s%s%s', 
				js_pagination_loop(1, $block_high, $page),
				$ellipsis,
				js_pagination_loop(($pages - $anchor + 1), $pages)
			);
		}
		else {
			$output .= js_pagination_loop(1, $pages, $page);
		}

		if ($page < $pages && !empty($nextpage)) {
			$output .= "<li><a href='".(isset($postType_link) ? $postType_link : '')."" . get_pagenum_link($page + 1) . "'>$nextpage</a></li>";
		}

		$output .= $after;
	}

	if ($echo) {
		echo $output;
	}

	return $output;
}

function js_pagination_loop($start, $max, $page = 0) {
	$output = "";
	for ($i = $start; $i <= $max; $i++) {
		$output .= ($page === intval($i)) 
			? "<li><span>$i</span></li>" 
			: "<li><a href='" . get_pagenum_link($i) . "'>$i</a></li>";
	}
	return $output;
}
// END Pagination


function js_social_icons(){
	
	echo (of_get_option('js_social_icon_facebook') ? '<a href="'.of_get_option('js_social_icon_facebook').'" class="icon facebook"><span class="notext"></span></a>' : '');
	
	echo (of_get_option('js_social_icon_twitter') ? '<a href="'.of_get_option('js_social_icon_twitter').'" class="icon twitter"><span class="notext"></span></a>' : '');
	
	echo (of_get_option('js_social_icon_vimeo') ? '<a href="'.of_get_option('js_social_icon_vimeo').'" class="icon vimeo"><span class="notext"></span></a>' : '');
	
	echo (of_get_option('js_social_icon_flickr') ? '<a href="'.of_get_option('js_social_icon_flickr').'" class="icon flickr"><span class="notext"></span></a>' : '');
	
	echo (of_get_option('js_social_icon_youtube') ? '<a href="'.of_get_option('js_social_icon_youtube').'" class="icon youtube"><span class="notext"></span></a>' : '');
	
	echo (of_get_option('js_social_icon_foursquare') ? '<a href="'.of_get_option('js_social_icon_foursquare').'" class="icon foursquare"><span class="notext"></span></a>' : '');

}


// Social Button Display
function js_social_buttons(){

	$hide_facebook = of_get_option('js_hide_facebook_like');
	$hide_twitter = of_get_option('js_hide_twitter_tweet');
	$hide_google = of_get_option('js_hide_google_plus');

	if (!$hide_google || !$hide_twitter || !$hide_facebook) {

	?><div class="social-buttons">
							
		<?php if (!$hide_google){ ?>
		<!-- Google +1 -->
		<div class="google-plusone"><div class="g-plusone" data-size="medium"></div></div>
		<script src="<?php echo get_template_directory_uri(); ?>/js/google_plusone_script.js" type="text/javascript"></script>
		<?php } ?>
		
		<?php if (!$hide_twitter){ ?>
		<!-- Twitter Tweet -->
		<a href="https://twitter.com/share" class="twitter-share-button" data-count="none" data-via="">Tweet</a><script type="text/javascript" src="//platform.twitter.com/widgets.js"></script>
		<?php } ?>
		
		<?php if (!$hide_facebook){ ?>
		<!-- Facebook Like -->
		<div id="fb-root"></div><script src="<?php echo get_template_directory_uri(); ?>/js/fb_like_script.js" type="text/javascript"></script>
		<div class="fb-like" data-send="false" data-width="380" data-show-faces="false"></div>
		<?php } ?>
		
		<div class="clearboth"></div>
		
	</div><?php
	
	}

}


function js_countdown_block(){

	$current_date = date(current_time('mysql'));
	$current_timestamp = strtotime($current_date) * 1000;
			
	$all_posts = array(
		'post_type' => 'event-items',
	    'posts_per_page' => 1,
	    'orderby' => 'meta_value',
	    'meta_key' => '_start_date',
	    'order' => 'ASC',
	    'meta_query' => array(
	    	array(
	    		'key' => '_start_date',
	    		'compare' => '>',
	    		'value' => $current_timestamp,
	    		'type' => 'NUMERIC'
	    	)
	    )
	);
	query_posts($all_posts);
		
	if ( have_posts() ) : while ( have_posts() ) : the_post();
	
		global $post;
	
		$start_date = strtotime(get_post_meta($post->ID,'_start_date_visual',true)); ?>
	
		<section id="countdown" class="bitter">
			<h4><?php _e('Next event in','rebirth'); ?> <span class="counter"><?php echo date('F j, Y G i Z',$start_date); ?></span></h4>
			<h3><a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>"><?php echo substr(get_the_title($post->ID),0,45); if (strlen(get_the_title($post->ID)) > 45){ echo '...'; } ?></a></h3>
		</section>
	
	<?php endwhile; endif; wp_reset_query();
	
}



// Breadcrumb Display
function js_breadcrumbs($post_id = ''){

	$hide_breadcrumbs = of_get_option('js_disable_breadcrumbs');
	if ($hide_breadcrumbs != 1){

		$breadcrumbs = '<p id="breadcrumb"><a href="'.home_url().'">Home</a>';
		
		if (is_page()){
		
			$ancestors = get_post_ancestors($post_id);
			$ancestors = array_reverse($ancestors);
			if (!empty($ancestors)){
				foreach($ancestors as $page_id){
					$breadcrumbs .= '&nbsp;&nbsp;>&nbsp;&nbsp;<a href="'.get_permalink($page_id).'">'.get_the_title($page_id).'</a>';
				}
			}
		
		} else if (is_search()){
		
			$breadcrumbs .= '&nbsp;&nbsp;>&nbsp;&nbsp;Search Results';
		
		} else if ('gallery-items' == get_post_type()){
		
			if (is_tax()){ $breadcrumbs .= '&nbsp;&nbsp;>&nbsp;&nbsp;<a href="'.home_url().'/galleries/">Galleries</a>'; } else
			if (is_archive()){ $breadcrumbs .= '&nbsp;&nbsp;>&nbsp;&nbsp;Galleries'; } else {
			$breadcrumbs .= '&nbsp;&nbsp;>&nbsp;&nbsp;<a href="'.home_url().'/galleries/">Galleries</a>'; }
		
		} else if ('video-items' == get_post_type()){
		
			if (is_tax()){ $breadcrumbs .= '&nbsp;&nbsp;>&nbsp;&nbsp;<a href="'.home_url().'/videos/">Videos</a>'; } else
			if (is_archive()){ $breadcrumbs .= '&nbsp;&nbsp;>&nbsp;&nbsp;Videos'; } else {
			$breadcrumbs .= '&nbsp;&nbsp;>&nbsp;&nbsp;<a href="'.home_url().'/videos/">Videos</a>'; }
		
		} else if ('audio-items' == get_post_type()){
		
			if (is_tax()){ $breadcrumbs .= '&nbsp;&nbsp;>&nbsp;&nbsp;<a href="'.home_url().'/audio/">Audio</a>'; } else
			if (is_archive()){ $breadcrumbs .= '&nbsp;&nbsp;>&nbsp;&nbsp;Audio'; } else {
			$breadcrumbs .= '&nbsp;&nbsp;>&nbsp;&nbsp;<a href="'.home_url().'/audio/">Audio</a>'; }
		
		} else if ('event-items' == get_post_type()){
		
			if (is_tax()){ $breadcrumbs .= '&nbsp;&nbsp;>&nbsp;&nbsp;<a href="'.home_url().'/events/">Events</a>'; } else
			if (is_archive()){ $breadcrumbs .= '&nbsp;&nbsp;>&nbsp;&nbsp;Events'; } else {
			$breadcrumbs .= '&nbsp;&nbsp;>&nbsp;&nbsp;<a href="'.home_url().'/events/">Events</a>'; }
		
		} else if (is_single()){
			
			$categories = get_the_category();
			$cat_name = $categories[0]->cat_name;
			$cat_link = get_category_link($categories[0]->cat_ID);
	
			$breadcrumbs .= '&nbsp;&nbsp;>&nbsp;&nbsp;<a href="'.$cat_link.'">'.$cat_name.'</a>';
			
		}
		
		if (!is_tax() && !is_archive()){
		
			$original_title = get_the_title($post_id);
			$shortened_title = substr(get_the_title($post_id), 0, 75);
			
			$orig_length = strlen($original_title);
			$new_length = strlen($shortened_title);
			
			$dots = ''; if ($new_length < $orig_length) { $dots = '...'; }
			
			$breadcrumbs .= '&nbsp;&nbsp;>&nbsp;&nbsp;'.$shortened_title.$dots.'</p>';
			
		} else if (is_tax()){ $breadcrumbs .= '&nbsp;&nbsp;>&nbsp;&nbsp;'.single_cat_title('',false).'</p>'; }
		
		echo $breadcrumbs;
		
	}
	
}
// END Breadcrumb Display

function query_events($past = true, $args = array()) {

	global $paged;
	
	$current_timestamp = date(current_time('mysql'));
	$current_timestamp = strtotime($current_timestamp);

	$all_events = get_posts(array(
		'post_type'      => 'event-items',
		'posts_per_page' => -1,
		'orderby'        => 'meta_value',
		'meta_key'       => '_start_date',
		'order'          => 'ASC'
	));

	$matching = array();
	foreach($all_events as $event) {
		$start = get_post_meta($event->ID, '_start_date', true);
		$end   = get_post_meta($event->ID, '_end_date', true);

		if($end && $end != 'NaN') {
			$end = intval(preg_replace('~^(\d+)\d\d\d$~', '$1', $end));
			if( ($past && $end < $current_timestamp) || (!$past && $end > $current_timestamp) )
				$matching[] = $event->ID;
		} else {
			$start = intval(preg_replace('~^(\d+)\d\d\d$~', '$1', $start));
			if( ($past && $start < $current_timestamp) || (!$past && $start > $current_timestamp) )
				$matching[] = $event->ID;
		}
	}

	$args = array_merge(array(
		'post_type'      => 'event-items',
		'posts_per_page' => get_option('posts_per_page'),
		'orderby'        => 'meta_value',
		'meta_key'       => '_start_date',
		'order'          => 'ASC',
		'post__in'       => $matching,
		'paged'          => (isset($paged) ? $paged : ''),
	), $args);

	if(empty($matching))
		$args['meta_query'] = array(
			array(
				'key' => '__this_key_does_not_exists',
				'value' => '',
				'compare' => '=='
			)
		);

	query_posts($args);
}
?>