<?php

/*
Template Name: Upcoming Events
*/

get_header(); ?>
		
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	<section id="main">
		<article>
		
			<?php $featured_caption = get_the_title(get_post_thumbnail_id(get_the_ID())); ?>
			<?php $featured_image = get_the_post_thumbnail($post->ID,'large-full-banner', array('title'=>$featured_caption)); ?>
		
			<?php if ($featured_image){ ?>
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
			
			<section id="content" class="full">
				<h1 class="bitter"><?php the_title(); ?></h1>
	
				<?php // Get older events, paginated
				
				if ( get_query_var('paged') ) { $paged = get_query_var('paged'); } 
				elseif ( get_query_var('page') ) { $paged = get_query_var('page'); } 
				else { $paged = 1; }
				
				if ($paged == 1){ the_content(); }
				
				query_events(false);
				
				if ( have_posts() ) : $counter = 0; ?>
				
					<section id="upcoming" class="cols">
		
						<section class="three-quarters full">
						
							<ul>
								
								<?php while ( have_posts() ) : the_post(); global $post;
								
								$start_date = strtotime(get_post_meta($post->ID,'_start_date_visual',true));
								$end_date = strtotime(get_post_meta($post->ID,'_end_date_visual',true));
								$address = get_post_meta($post->ID,'_address',true);
								$custom_title = get_post_meta($post->ID,'_custom_title',true);
								$custom_text = get_post_meta($post->ID,'_custom_text',true);
								$counter++;
								
								?>
								
								<?php
								if (of_get_option('js_time_format') && of_get_option('js_time_format') == '24h'){
									$date_format = 'G:i';
								} else {
									$date_format = 'g:ia';
								}		
								?>
								
								<li<?php if ($counter == 4) { echo ' class="last"'; } ?>>
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
									
								</li>
								
								<?php if ($counter == 4) { echo '<div class="cl"></div>'; $counter = 0; }
			
							endwhile;
							
							?></ul>
						
						</section>
						
					</section>
					
				<?php endif; ?>
				
				<?php js_get_pagination(); wp_reset_query(); ?>
				
			</section>
			
		</article>
	</section>
	
	<?php endwhile; endif; ?>

<?php get_footer(); ?>