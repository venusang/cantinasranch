<?php

/*
Template Name: Homepage
*/

get_header();

	$template_dir = get_template_directory_uri();
		
	$homepage_blocks = of_get_option('js_homepage_blocks');
	$sort_order = of_get_option('js_homepage_block_order');
	
	if (!isset($sort_order) || isset($sort_order) && !$sort_order){
		$sort_order = 'countdown,slider,introblock,block,mapblock';
	}
	
	$sort_order = explode(',',$sort_order);
	$hide_shadow = 1;
	
	foreach($sort_order as $block){
	
		if ($block == 'countdown'){
			
			// Display the Countdown
			if (!isset($homepage_blocks['js_event_countdown']) || isset($homepage_blocks['js_event_countdown']) && !$homepage_blocks['js_event_countdown']){
			
				echo '<section id="banner">';
				if (!$hide_shadow) { echo '<section class="shadow"></section>'; } $hide_shadow = 0;
				js_countdown_block();
				echo '</section>';
				
			}
			  
		} else if ($block == 'slider'){
		
			// Display the Slider
			if (isset($homepage_blocks['js_homepage_slider']) && !$homepage_blocks['js_homepage_slider']){ ?>
			
				<section id="banner">
				<section id="slider">
					<section class="container">
						<ul>
							<?php echo get_homepage_slides(); ?>
						</ul>
					</section>
					<section class="top"></section>
					<section class="bottom"></section>
				</section>
				</section>
			
			<?php }
		
		} else if ($block == 'introblock'){
		
			if (isset($homepage_blocks['js_homepage_introblock']) && !$homepage_blocks['js_homepage_introblock']){
				echo '<section id="banner">';
					if (!$hide_shadow) { echo '<section class="shadow"></section>'; } $hide_shadow = 0;
					?><!-- A big introduction area with large custom text -->
					<section id="tagline">
						<h2 class="bitter"><?php echo (of_get_option('js_homepage_intro_text') ? do_shortcode(nl2br(of_get_option('js_homepage_intro_text'))) : 'Rebirth is the amazing WordPress Theme for amazing churches everywhere. By the way, you can easily update the text in this block.'); ?></h2>
					</section><?php
				echo '</section>';
				
			}
		
		} else if ($block == 'block'){
			
			if (of_get_option('js_homepage_page_display')){
		
				echo '<section id="main">';
				echo '<article>';
					
					$args = array(
						'page_id' => of_get_option('js_homepage_page_display')
					);
					
					// The Query
					query_posts( $args );
					
					// The Loop
					while ( have_posts() ) : the_post();
					
					echo '<section id="content" class="full">';
						echo '<section class="entry">';
							if (!$hide_shadow) { echo '<section class="shadow"></section>'; } $hide_shadow = 0;
					
							echo '<h1 class="bitter">'; the_title(); echo '</h1>';
							the_content();
						
						echo '</section>';
					echo '</section>';
				
					endwhile;
							
					// Reset Query
					wp_reset_query();
					
				echo '</article>';
				echo '</section>';
			
			// Are there any widgets active here?
			} else if (is_active_sidebar('homepage-horizontal-blocks')){
				
				dynamic_sidebar('homepage-horizontal-blocks');
			
			}
			
		}
	
	}
		
get_footer(); ?>