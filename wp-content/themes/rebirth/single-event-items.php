<?php get_header(); ?>
		
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	<section id="main">
		<article>
		
			<?php
		
			$start_date = strtotime(get_post_meta($post->ID,'_start_date_visual',true));
			$end_date = strtotime(get_post_meta($post->ID,'_end_date_visual',true));
			$address = get_post_meta($post->ID,'_address',true);
			$hide_event_map = get_post_meta($post->ID,'_event_map',true);
			$custom_title = get_post_meta($post->ID,'_custom_title',true);
			$custom_text = get_post_meta($post->ID,'_custom_text',true);
			$featured_caption = get_the_title(get_post_thumbnail_id(get_the_ID()));
			$featured_image = get_the_post_thumbnail($post->ID,'large-full-banner', array('title'=>$featured_caption));
			
			if ($address && !$hide_event_map){ ?>
				<section id="main-image">
					<section class="top"></section>
					<section class="bottom"></section>
					<iframe width="940" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps?hl=en&amp;geocode=&amp;q=<?php echo str_replace(array('<br />',' '),'+',nl2br($address)); ?>&amp;aq=&amp;ie=UTF8&amp;hq=&amp;hnear=<?php echo str_replace(array('<br />',' '),'+',nl2br($address)); ?>&amp;t=m&amp;view=map&amp;z=<?php echo (of_get_option('js_gmap_zoom') ? of_get_option('js_gmap_zoom') : '14'); ?>&amp;output=embed&iwloc=near"></iframe>
				</section>
			<?php } else if ($hide_event_map && $featured_image){ ?>
				<section id="main-image">
					<section class="top"></section>
					<section class="bottom"></section>
					<?php echo get_the_post_thumbnail($post->ID,'large-full-banner', array('title'=>$featured_caption)); ?>
				</section>
			<?php } else { ?>
				<section class="shadow"></section>
				<br />
			<?php } ?>

			<?php js_breadcrumbs($post->ID); ?>

			<section id="content" class="left">
				<h1 class="bitter"><?php the_title(); ?></h1>

				<section class="entry">
					<section class="shadow"></section>
					
					<?php if ($start_date || $end_date || $address){ ?>
						
						<?php
						if (of_get_option('js_time_format') && of_get_option('js_time_format') == '24h'){
							$date_format = 'G:i';
						} else {
							$date_format = 'g:ia';
						}		
						?>
					
						<p>
							<?php if ($start_date){ ?><strong><?php _e('Starts:','rebirth'); ?></strong> <?php echo strftime('%B %d',$start_date).' @ '.date($date_format,$start_date); ?><br /><?php } ?>
							<?php if ($end_date){ ?><strong><?php _e('Ends:','rebirth'); ?></strong> <?php echo strftime('%B %d',$end_date).' @ '.date($date_format,$end_date); ?><br /><?php } ?>
							<?php if ($address){ ?><strong><?php _e('Location:','rebirth'); ?></strong> <?php echo nl2br($address); ?><?php } ?>
							<?php if ($custom_title && $custom_text){ ?>
								<br /><strong><?php echo $custom_title; ?>:</strong> <?php echo $custom_text; ?>
							<?php } ?>
						</p>
						
					<?php } ?>

					<?php the_content(); ?>
					<?php comments_template(); ?>
					
				</section>
			</section>

			<section id="sidebar" class="right">
				
				<?php get_sidebar(); ?>
				
			</section>
		</article>
	</section>
	
	<?php endwhile; endif; ?>

<?php get_footer(); ?>