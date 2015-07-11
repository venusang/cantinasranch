<?php
/*
* Register the new widget classes here so that they show up in the widget list
*/
function load_widgets() {
	register_widget('ThemeWidgetRecentPosts');
	register_widget('ThemeWidgetUpcomingEvents');
	register_widget('ThemeWidgetMediaItems');
	register_widget('ThemeWidgetFlickr');
	register_widget('ThemeWidgetPageChildren');
	register_widget('ThemeWidgetTextWidget');
	register_widget('ThemeWidgetEventCountdown');
	register_widget('ThemeWidgetSocialLinks');	
}
add_action('widgets_init', 'load_widgets');

// Remove specific widgets because we are replacing them with improved ones in rebirth
// NOTE: This is NOT removing default WordPress functionality, just improving it!
function unregister_default_wp_widgets() {
	//unregister_widget('WP_Widget_Pages');
	//unregister_widget('WP_Widget_Calendar');
	//unregister_widget('WP_Widget_Archives');
	//unregister_widget('WP_Widget_Links');
	//unregister_widget('WP_Widget_Meta');
	//unregister_widget('WP_Widget_Search');
	unregister_widget('WP_Widget_Text');
	//unregister_widget('WP_Widget_Categories');
	unregister_widget('WP_Widget_Recent_Posts');
	//unregister_widget('WP_Widget_Recent_Comments');
	//unregister_widget('WP_Widget_RSS');
	//unregister_widget('WP_Widget_Tag_Cloud');
}
add_action('widgets_init', 'unregister_default_wp_widgets', 1);

// Recent Posts
// ----------------------------------------------------
class ThemeWidgetRecentPosts extends ThemeWidgetBase {
	
	/*
	* Register widget function. Must have the same name as the class
	*/
	function ThemeWidgetRecentPosts() {
		$widget_opts = array(
			'classname' => 'theme-widget-recent-posts', // class of the <li> holder
			'description' => __( 'Displays recent posts in a custom style.','rebirth' ) // description shown in the widget list
		);
		// Additional control options. Width specifies to what width should the widget expand when opened
		$control_ops = array(
			//'width' => 350,
		);
		// widget id, widget display title, widget options
		$this->WP_Widget('theme-widget-recent-posts', __('Recent Posts (rebirth)','rebirth'), $widget_opts, $control_ops);
		$this->custom_fields = array(
			array(
				'name'=>'title',
				'type'=>'text',
				'title'=>'Title', 
				'default'=>__('Recent Posts','rebirth')
			),
			array(
				'name'=>'desc',
				'type'=>'text',
				'title'=>'Description', 
				'default'=>__('This is a short description.','rebirth')
			),
			array(
				'name'=>'categories',
				'type'=>'multiCategories',
				'title'=>__('Select Categories','rebirth'),
				'default'=>''
			),
			array(
				'name'=>'limit',
				'type'=>'integer',
				'title'=>__('Limit','rebirth'), 
				'default'=>'3'
			),
			array(
				'name'=>'button_text',
				'type'=>'text',
				'title'=>__('Button Text (optional)','rebirth'), 
				'default'=>false
			),
			array(
				'name'=>'button_link',
				'type'=>'text',
				'title'=>__('Button Link (optional)','rebirth'), 
				'default'=>false
			),
		);
	}
	
	/*
	* Called when rendering the widget in the front-end
	*/
	function front_end($args, $instance) {
		extract($args);
		
		$limit = intval($instance['limit']);
		$title = $instance['title'];
		$desc = $instance['desc'];
		$categories = $instance['categories'];
		$button_text = $instance['button_text'];
		$button_link = $instance['button_link'];
		if ($categories) { $categories = implode(",",$categories); }
		
		$current_sidebar = $args['id'];
		if ($current_sidebar == 'homepage-horizontal-blocks') { $is_horizontal = true; } else { $is_horizontal = false; }
		
		query_posts(array('posts_per_page'=>$limit, 'cat'=>$categories));
		if ( have_posts() ) : $post_count = 0; ?>
		
			<section id="recent"<?php if ($is_horizontal) { ?> class="cols"<?php } ?>>
			
				<?php if ($is_horizontal) { ?><section class="shadow"></section><?php } ?>
				<section class="one-quarter">
				
					<?php echo $before_title . $title . $after_title; ?>
					<p><?php echo $desc; ?></p>
		
					<?php if ($is_horizontal) { ?>
					<?php if ($button_text && $button_link){ echo '<a href="'.$button_link.'" class="red-button">'.$button_text.'</a>'; } ?>
					<?php } ?>
					
				</section>
				
				<?php if ($is_horizontal) { ?><section class="three-quarters"><?php } ?>
				
					<ul>
					
					<?php while ( have_posts() ) : the_post(); global $post; $post_count++; ?>
					
					<li>
						<a href="<?php the_permalink(); ?>">
							<span class="thumbnail">
								<?php
								if (has_post_thumbnail($post->ID)){
									echo get_the_post_thumbnail($post->ID,'medium-thumbnail');
								} else {
									echo '<img width="220" height="148" src="'.get_template_directory_uri().'/_theme_styles/images/default_medium_thumb.jpg" />';
								}
								?>
								<span class="overlay"></span>
								<span class="icon post"><span class="notext"></span></span>
							</span>
	
							<strong class="bitter"><?php the_title(); ?></strong>
							<span class="desc"><?php //the_excerpt(); ?></span>
						</a>
					</li><?php
					
					if ($post_count == 3){ echo '<div class="cl"></div>'; $post_count = 0; }

					endwhile; ?></ul>
					
					<?php if (!$is_horizontal) { ?>
					<?php if ($button_text && $button_link){ echo '<p><a href="'.$button_link.'" class="red-button">'.$button_text.'</a></p>'; } ?>
					<section class="shadow"></section><?php } ?>
				
				<?php if ($is_horizontal) { ?></section><?php } ?>
			</section>
						
		<?php endif; wp_reset_query();
		
	}
}


// Flickr Photos
// ----------------------------------------------------
class ThemeWidgetFlickr extends ThemeWidgetBase {
	/*
	* Register widget function. Must have the same name as the class
	*/
	function ThemeWidgetFlickr() {
		$widget_opts = array(
			'classname' => 'theme-widget-flickr', // class of the <li> holder
			'description' => __( 'Displays recent Flickr thumbnails.','rebirth' ) // description shown in the widget list
		);
		// Additional control options. Width specifies to what width should the widget expand when opened
		$control_ops = array(
			//'width' => 350,
		);
		// widget id, widget display title, widget options
		$this->WP_Widget('theme-widget-widget-flickr', __('Flickr Photos (rebirth)','rebirth'), $widget_opts, $control_ops);
		$this->custom_fields = array(
			array(
				'name'=>'title',
				'type'=>'text',
				'title'=>'Title', 
				'default'=>__('Flickr Photos','rebirth')
			),
			array(
				'name'=>'flickr_user_id',
				'type'=>'text',
				'title'=>__('Flickr User ID','rebirth'),
				'default'=>'',
			),
			array(
				'name'=>'flickr_id_desc',
				'title'=>__('Use <a href="http://idgettr.com/" target="_blank">idGettr</a> to find your Flickr ID.','rebirth'),
				'type'=>'desc',
				'default'=>'',
			),
			array(
				'name'=>'flickr_photo_count',
				'type'=>'integer',
				'title'=>__('Photos to Display','rebirth'),
				'default'=>'8',
			),
		);
	}
	
	/*
	* Called when rendering the widget in the front-end
	*/
	function front_end($args, $instance) {
	
		$current_sidebar = $args['id'];
		if ($current_sidebar == 'homepage-horizontal-blocks') { $is_horizontal = true; } else { $is_horizontal = false; }
	
		extract($args);
		
		$flickr_user_id = $instance['flickr_user_id'];
		$flickr_photo_count = intval($instance['flickr_photo_count']);
		$title = $instance['title'];
		
		$flickr_url = 'http://www.flickr.com/badge_code_v2.gne?count='.$flickr_photo_count.'&display=latest&size=s&layout=x&source=user_tag&user='.$flickr_user_id;

		$html = file_get_contents($flickr_url);
		preg_match_all("/<div.*div>/", $html, $matches);
		
		?><section id="flickr"<?php if ($is_horizontal) { ?> class="cols"<?php } ?>>
			
			<?php if ($is_horizontal) { ?><section class="shadow"></section><?php } ?>
			<section class="one-quarter">
			
				<?php echo $before_title . $title . $after_title;
				if ($is_horizontal) { echo '<a href="http://www.flickr.com/photos/'.$flickr_user_id.'/" class="red-button">'.__('View all at Flickr','rebirth').'</a>'; } ?>
				
			</section>
			
			<?php if ($is_horizontal) { $flickr_count = 0; ?><section class="three-quarters"><?php } ?>
				
				<?php echo '<div class="small-gallery">';
				foreach($matches[0] as $div) { $flickr_count++;
			  		$photo = str_replace('></a>', '/>
								<span class="img-corner"></span></a>', $div);
					echo $photo;
					if ($flickr_count == 8){ echo '<div class="cl"></div>'; $flickr_count = 0; }
				}
				echo '</div>';
				
				if (!$is_horizontal) {
				
					echo '<p><a href="http://www.flickr.com/photos/'.$flickr_user_id.'/" class="red-button">'.__('View all at Flickr','rebirth').'</a></p>';
					?><section class="shadow"></section><?php
				
				} ?>
				
			<?php if ($is_horizontal) { ?></section><?php } ?>
				
		</section><?php
		
	}
}

// Page Children
class ThemeWidgetPageChildren extends ThemeWidgetBase {
	function ThemeWidgetPageChildren() {
		$widget_opts = array(
			'classname' => 'theme-widget widget-subnav',
			'description' => __( 'Displays the direct children of the current page ancestor. This widget is displayed only on pages.','rebirth'));
		$control_ops = array();
		$this->WP_Widget('theme-widget-top-level-page-children', __('List Child Pages (rebirth)','rebirth'), $widget_opts, $control_ops);
	}
	function front_end($args, $instance) {
		extract($args);
		global $wp_query, $post;
		
		if (!is_page()) {
			return;
		}
		
		$anc = get_page_ancestor(get_the_id());
		$children = get_pages('sort_column=menu_order&order=ASC&parent=' . $anc->ID . '&child_of=' . $anc->ID);
		if (!$children) {
			return;
		}
		
		echo $before_title . $anc->post_title . $after_title; ?>
		
		<ul class="child-pages">
			<?php foreach ($children as $child): ?>
				<li <?php echo (is_page($child->ID) ? 'class="current_page_item"' : ''); ?>><a href="<?php echo get_permalink($child->ID); ?>"><span><?php echo apply_filters('the_title', $child->post_title); ?></span></a></li>
			<?php endforeach; ?>
		</ul>
		<?php
	}
}

// Text Widget with Icon
// ----------------------------------------------------
class ThemeWidgetTextWidget extends ThemeWidgetBase {
	/*
	* Register widget function. Must have the same name as the class
	*/
	function ThemeWidgetTextWidget() {
		$widget_opts = array(
			'classname' => 'theme-widget-text-widget', // class of the <li> holder
			'description' => __( 'Displays a text widget.','rebirth') );
		// Additional control options. Width specifies to what width should the widget expand when opened
		$control_ops = array(
			//'width' => 350,
		);
		// widget id, widget display title, widget options
		$this->WP_Widget('theme-widget-text-widget', __('Text Widget (rebirth)','rebirth'), $widget_opts, $control_ops);
		$this->custom_fields = array(
			array(
				'name'=>'title',
				'type'=>'text',
				'title'=>__('Title','rebirth'), 
				'default'=>__('Widget Title','rebirth')
			),
			array(
				'name'=>'text',
				'type'=>'textarea',
				'title'=>__('Widget Text','rebirth'), 
				'default'=>''
			),
			array(
				'name'=>'button_link',
				'type'=>'text',
				'title'=>__('Button Link (optional)','rebirth'), 
				'default'=>false
			),
			array(
				'name'=>'button_text',
				'type'=>'text',
				'title'=>__('Button Text (optional)','rebirth'), 
				'default'=>false
			),
		);
	}
	
	/*
	* Called when rendering the widget in the front-end
	*/
	function front_end($args, $instance) {
		extract($args);
		
		$title = $instance['title'];
		$text = $instance['text'];
		$button_link = $instance['button_link'];
		$button_text = $instance['button_text']; ?>
		
		<div class="text-widget">
			<?php echo $before_title . $title . $after_title; ?>
			<p><?php echo nl2br(do_shortcode($text)); ?></p>
			<?php if ($button_link && $button_text){
				echo '<a href="'.$button_link.'" class="button">'.$button_text.'</a>';
			} ?>
		</div>
			
	<?php }
}


// Event Countdown Widget
class ThemeWidgetEventCountdown extends ThemeWidgetBase {
	function ThemeWidgetEventCountdown() {
		$widget_opts = array(
			'classname' => 'theme-widget widget-subnav',
			'description' => __( 'Displays the next upcoming event in a countdown format. Suggested use is on the homepage only.','rebirth'));
		$control_ops = array();
		$this->WP_Widget('theme-widget-event-countdown', __('Event Countdown (Rebirth)','rebirth'), $widget_opts, $control_ops);
	}
	function front_end($args, $instance) {
	
		$current_sidebar = $args['id'];
		if ($current_sidebar == 'homepage-horizontal-blocks') { $is_horizontal = true; } else { $is_horizontal = false; }
		
		echo '<section id="banner">';
			if ($is_horizontal) { echo '<section class="shadow"></section>'; }
			js_countdown_block();
		echo '</section>';
		
	}
}


// Event Countdown Widget
class ThemeWidgetSocialLinks extends ThemeWidgetBase {
	function ThemeWidgetSocialLinks() {
		$widget_opts = array(
			'classname' => 'theme-widget widget-subnav',
			'description' => __( 'Displays your social icons. Be sure to set up your social links in the "Theme Options" panel first!','rebirth'));
		$control_ops = array();
		// Additional control options. Width specifies to what width should the widget expand when opened
		$control_ops = array(
			//'width' => 350,
		);
		// widget id, widget display title, widget options
		$this->WP_Widget('theme-widget-social-links', __('Social Links (rebirth)','rebirth'), $widget_opts, $control_ops);
		$this->custom_fields = array(
			array(
				'name'=>'title',
				'type'=>'text',
				'title'=>'Title', 
				'default'=>__('Social Links','rebirth')
			)
		);
	}
	
	function front_end($args, $instance) {
	
		$current_sidebar = $args['id'];
		if ($current_sidebar == 'homepage-horizontal-blocks') { $is_horizontal = true; } else { $is_horizontal = false; }
	
		extract($args);
		
		$title = $instance['title'];
		
		?><section id="social-widget"<?php if ($is_horizontal) { ?> class="cols"<?php } ?>>
			
			<?php if ($is_horizontal) { ?><section class="shadow"></section><?php } ?>
			<section class="one-quarter">
			
				<?php echo $before_title . $title . $after_title; ?>
				
			</section>
			
			<?php if ($is_horizontal) { ?><section class="three-quarters"><?php }
				
				js_social_icons();
				
			?><div class="cl"></div><?php
				
			if ($is_horizontal) { ?></section><?php } ?>
				
		</section><?php
		
	}
}


// Upcoming Events
// ----------------------------------------------------
class ThemeWidgetUpcomingEvents extends ThemeWidgetBase {
	
	/*
	* Register widget function. Must have the same name as the class
	*/
	function ThemeWidgetUpcomingEvents() {
		$widget_opts = array(
			'classname' => 'theme-widget-upcoming-events', // class of the <li> holder
			'description' => __( 'Display one or more upcoming events.','rebirth'));
		// Additional control options. Width specifies to what width should the widget expand when opened
		$control_ops = array(
			//'width' => 350,
		);
		// widget id, widget display title, widget options
		$this->WP_Widget('theme-widget-widget-upcoming-events', __('Upcoming Events (rebirth)','rebirth'), $widget_opts, $control_ops);
		$this->custom_fields = array(
			array(
				'name'=>'title',
				'type'=>'text',
				'title'=>__('Title','rebirth'), 
				'default'=>__('Upcoming Events','rebirth')
			),
			array(
				'name'=>'desc',
				'type'=>'text',
				'title'=>__('Short Description','rebirth'), 
				'default'=>__('This is a quick description.','rebirth')
			),
			array(
				'name'=>'event_categories',
				'type'=>'eventCategories',
				'title'=>__('Categories','rebirth'),
				'default'=>''
			),
			array(
				'name'=>'show',
				'type'=>'integer',
				'title'=>__('Show','rebirth'), 
				'default'=>'3'
			),
			array(
				'name'=>'button_text',
				'type'=>'text',
				'title'=>__('Button Text (optional)','rebirth'), 
				'default'=>false
			),
			array(
				'name'=>'button_link',
				'type'=>'text',
				'title'=>__('Button Link (optional)','rebirth'), 
				'default'=>false
			),
		);
	}
	
	/*
	* Called when rendering the widget in the front-end
	*/
	function front_end($args, $instance) {
		
		$current_sidebar = $args['id'];
		if ($current_sidebar == 'homepage-horizontal-blocks') { $is_horizontal = true; } else { $is_horizontal = false; }
	
		extract($args);
		
		$limit = intval($instance['show']);
		$title = $instance['title'];
		$desc = $instance['desc'];
		$button_text = $instance['button_text'];
		$button_link = $instance['button_link'];
		$categories = $instance['event_categories'];
		if (!$categories) { $categories = ''; echo '<h3><strong style="color:#AB3204;">ERROR:</strong> Please select one or more categories to display for your Events Widget.</h3>'; }
		
		$current_date = date(current_time('mysql'));
		$current_timestamp = strtotime($current_date) * 1000;
		
		$post_count = 0;
	
		query_events(false, array(
		    'tax_query' => array(
				array(
					'taxonomy' => 'events',
					'field' => 'id',
					'terms' => $categories,
				)
			),
			'posts_per_page' => $limit
		));
		
		if (have_posts()) : ?>
		
			<section id="upcoming"<?php if ($is_horizontal) { ?> class="cols"<?php } ?>>
			
				<?php if ($is_horizontal) { ?><section class="shadow"></section><?php } ?>
				<section class="one-quarter">
				
					<?php echo $before_title . $title . $after_title; ?>
					<p><?php echo $desc; ?></p>
		
					<?php if ($is_horizontal) { ?>
					<?php if ($button_text && $button_link){ echo '<a href="'.$button_link.'" class="red-button">'.$button_text.'</a>'; } ?>
					<?php } ?>
					
				</section>
				
				<?php if ($is_horizontal) { ?><section class="three-quarters"><?php } ?>
				
					<ul>
					
					<?php while ( have_posts() ) : the_post(); global $post; $post_count++;
					
					$start_date = strtotime(get_post_meta($post->ID,'_start_date_visual',true));
					$end_date = strtotime(get_post_meta($post->ID,'_end_date_visual',true));
					$address = get_post_meta($post->ID,'_address',true);
					$custom_title = get_post_meta($post->ID,'_custom_title',true);
					$custom_text = get_post_meta($post->ID,'_custom_text',true);
					
					?>
					
					<?php
					if (of_get_option('js_time_format') && of_get_option('js_time_format') == '24h'){
						$date_format = 'G:i';
					} else {
						$date_format = 'g:ia';
					}		
					?>
					
					<li>
						<a href="<?php the_permalink(); ?>">
							<?php if ($start_date){ ?><span class="date"><?php echo strftime('%b',$start_date); ?> <strong><?php echo date('d',$start_date); ?></strong></span><?php } ?>
							<span class="thumbnail">
								<?php
								if (has_post_thumbnail($post->ID)){
									echo get_the_post_thumbnail($post->ID,'event-thumbnail');
								} else {
									echo '<img width="220" height="98" src="'.get_template_directory_uri().'/_theme_styles/images/default_event_thumb.jpg" />';
								}
								?>
								<span class="overlay"></span>
								<?php if ($start_date){ ?><strong class="time"><?php echo date($date_format,$start_date); ?></strong><?php } ?>
							</span>
	
							<strong class="bitter"><?php the_title(); ?></strong>
	
							<?php if ($start_date){ ?><strong class="row"><span class="right"><?php echo strftime('%B %d',$start_date).' @ '.date($date_format,$start_date); ?></span> <?php _e('Starts:','rebirth'); ?></strong><?php } ?>
							<?php if ($end_date){ ?><strong class="row"><span class="right"><?php echo strftime('%B %d',$end_date).' @ '.date($date_format,$end_date); ?></span> <?php _e('Ends:','rebirth'); ?></strong><?php } ?>
							<?php if ($address){ ?><strong class="row"><span class="right"><?php echo nl2br($address); ?></span> <?php _e('Location:','rebirth'); ?></strong><?php } ?>
						</a>
						
						<?php if ($custom_title && $custom_text){ ?>
							<strong class="custom-row"><span class="right"><?php echo $custom_text; ?></span> <?php echo $custom_title; ?>:</strong>
						<?php } ?>
						
					</li><?php
					
					if ($post_count == 3){ echo '<div class="cl"></div>'; $post_count = 0; }

					endwhile; ?></ul>
					
					<?php if (!$is_horizontal) { ?>
					<?php if ($button_text && $button_link){ echo '<p><a href="'.$button_link.'" class="red-button">'.$button_text.'</a></p>'; } ?>
					<section class="shadow"></section><?php } ?>
					
					<?php if ($is_horizontal) { ?></section><div class="cl"></div><?php } ?>
					
				</section>
				
				
			
		<?php endif; wp_reset_query();
		
	}
}

// Upcoming Events
// ----------------------------------------------------
class ThemeWidgetMediaItems extends ThemeWidgetBase {
	
	/*
	* Register widget function. Must have the same name as the class
	*/
	function ThemeWidgetMediaItems() {
		$widget_opts = array(
			'classname' => 'theme-widget-media-items', // class of the <li> holder
			'description' => __( 'Display one or more recent media items.','rebirth'));
		// Additional control options. Width specifies to what width should the widget expand when opened
		$control_ops = array(
			//'width' => 350,
		);
		// widget id, widget display title, widget options
		$this->WP_Widget('theme-widget-widget-media-items', __('Media Items (rebirth)','rebirth'), $widget_opts, $control_ops);
		$this->custom_fields = array(
			array(
				'name'=>'title',
				'type'=>'text',
				'title'=>__('Title','rebirth'), 
				'default'=>__('Media Updates','rebirth')
			),
			array(
				'name'=>'desc',
				'type'=>'text',
				'title'=>__('Short Description','rebirth'), 
				'default'=>__('This is a quick description.','rebirth')
			),
			array(
				'name'=>'media_type',
				'type'=>'select',
				'title'=>__('Media Types','rebirth'),
				'options'=>array(
					'all' => 'All Media',
					'galleries' => 'Galleries',
					'videos' => 'Videos',
					'audio' => 'Audio'
				),
				'default'=>''
			),
			array(
				'name'=>'show',
				'type'=>'integer',
				'title'=>__('Show','rebirth'), 
				'default'=>'4'
			),
			array(
				'name'=>'button_text',
				'type'=>'text',
				'title'=>__('Button Text (optional)','rebirth'), 
				'default'=>false
			),
			array(
				'name'=>'button_link',
				'type'=>'text',
				'title'=>__('Button Link (optional)','rebirth'), 
				'default'=>false
			),
		);
	}
	
	/*
	* Called when rendering the widget in the front-end
	*/
	function front_end($args, $instance) {
	
		$current_sidebar = $args['id'];
		if ($current_sidebar == 'homepage-horizontal-blocks') { $is_horizontal = true; } else { $is_horizontal = false; }
	
		extract($args);
		
		$limit = intval($instance['show']);
		$title = $instance['title'];
		$desc = $instance['desc'];
		$button_text = $instance['button_text'];
		$button_link = $instance['button_link'];
		$media_type = $instance['media_type'];
		
		$media_types = array();
		if($media_type == 'all' || $media_type == 'galleries') { $media_types[] = 'gallery-items'; }
		if($media_type == 'all' || $media_type == 'videos') { $media_types[] = 'video-items'; }
		if($media_type == 'all' || $media_type == 'audio') { $media_types[] = 'audio-items'; }
		
		$all_posts = array(
			'post_type' => $media_types,
		    'posts_per_page' => $limit,
		    'orderby' => 'id',
		    'order' => 'DESC'
		);
		query_posts($all_posts);
		
		if ( have_posts() ) : $post_count = 0; ?>
		
			<section id="recent"<?php if ($is_horizontal) { ?> class="cols"<?php } ?>>
			
				<?php if ($is_horizontal) { ?><section class="shadow"></section><?php } ?>
				<section class="one-quarter">
				
					<?php echo $before_title . $title . $after_title; ?>
					<p><?php echo $desc; ?></p>
		
					<?php if ($is_horizontal) { ?>
					<?php if ($button_text && $button_link){ echo '<a href="'.$button_link.'" class="red-button">'.$button_text.'</a>'; } ?>
					<?php } ?>
					
				</section>
				
				<?php if ($is_horizontal) { ?><section class="three-quarters"><?php } ?>
				
					<ul>
					
					<?php while ( have_posts() ) : the_post(); global $post; $post_count++;
					
					$post_type = get_post_type();
					if ($post_type == 'audio-items') { $taxonomy = 'audio'; }
					else if ($post_type == 'video-items') { $taxonomy = 'video'; }
					else if ($post_type == 'gallery-items') { $taxonomy = 'gallery'; }
					
					?>
					
					<li>
						<a href="<?php the_permalink(); ?>">
							<span class="thumbnail">
								<?php
								if (has_post_thumbnail($post->ID)){
									echo get_the_post_thumbnail($post->ID,'medium-thumbnail');
								} else {
									echo '<img width="220" height="148" src="'.get_template_directory_uri().'/_theme_styles/images/default_medium_thumb.jpg" />';
								}
								?>
								<span class="overlay"></span>
								<span class="icon <?php echo $taxonomy; ?>"><span class="notext"><?php if ($taxonomy == 'video') { echo get_post_meta($post->ID, '_video_link', true); } ?></span></span>
								<?php if ($taxonomy == 'audio'){
								
									$mp3 = get_post_meta($post->ID, '_file_mp3', true);
									$external_mp3 = get_post_meta($post->ID, '_file_external_mp3', true);
									$ogg = get_post_meta($post->ID, '_file_ogg', true);
									$external_ogg = get_post_meta($post->ID, '_file_external_ogg', true);
									
									$audio_mp3_file = ($external_mp3 ? $external_mp3 : home_url() . '/wp-content/uploads/'.$mp3);
									$audio_ogg_file = ($external_ogg ? $external_ogg : home_url() . '/wp-content/uploads/'.$ogg);
								
									?><div class="mini-player player-container" id="player-<?php echo md5(rand()) ?>">
										<audio controls="controls" style="width:100%">
											<source type="audio/mpeg" src="<?php echo $audio_mp3_file; ?>" />
										</audio>
										<div class="flash-player" rel="<?php echo $audio_mp3_file; ?>"><div id="audioPlayer2"></div></div>
										<span class="notext" style="display:none"><?php echo $audio_mp3_file ?></span>
									</div><?php
								} ?>
							</span>
	
							<strong class="bitter"><?php the_title(); ?></strong>
							<span class="desc"><?php the_excerpt(); ?></span>
						</a>
					</li><?php
					
					if ($post_count == 3){ echo '<div class="cl"></div>'; $post_count = 0; }

					endwhile; ?></ul>
					
					<?php if (!$is_horizontal) { ?>
					<?php if ($button_text && $button_link){ echo '<p><a href="'.$button_link.'" class="red-button">'.$button_text.'</a></p>'; } ?>
					<section class="shadow"></section><?php } ?>
				
				<?php if ($is_horizontal) { ?></section><?php } ?>
			</section>
		
		<?php endif;
			
		wp_reset_query();
		
	}
}

?>