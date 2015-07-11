<?php

/*
Template Name: Media Archive
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
	
				<?php // Get all media items (Audio, Video, and Galleries), paginated
				
				if ( get_query_var('paged') ) { $paged = get_query_var('paged'); } 
				elseif ( get_query_var('page') ) { $paged = get_query_var('page'); } 
				else { $paged = 1; }
				
				if ($paged == 1){ the_content(); echo '<br />'; }
				$counter = 0;
				
				$all_posts = array(
					'post_type' => array(
						'gallery-items',
						'video-items',
						'audio-items'
					),
				    'posts_per_page' => get_option('posts_per_page'),
				    'orderby' => 'id',
				    'order' => 'DESC',
				    'paged'=> $paged,
				);
				query_posts($all_posts);
				
				if ( have_posts() ) : ?>
				
					<section id="recent" class="cols">
		
						<section class="three-quarters full">
						
							<ul><?php
							
								while ( have_posts() ) : the_post(); global $post;
								
									$post_type = get_post_type();
									if ($post_type == 'audio-items') { $taxonomy = 'audio'; }
									else if ($post_type == 'video-items') { $taxonomy = 'video'; }
									else if ($post_type == 'gallery-items') { $taxonomy = 'gallery'; }
									$counter++;
									
									?>
									
									<li<?php if ($counter == 4) { echo ' class="last"'; } ?>>
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
												
													?><span class="mini-player">
														<audio class="AudioPlayerV1" data-controls-duration="false" data-controls-volume="false" data-controls-time="false">
															<source type="audio/mpeg" src="<?php echo $audio_mp3_file; ?>" />
															<source type="audio/ogg" src="<?php echo $audio_ogg_file; ?>" />
														</audio>
														<div class="flash-player" rel="<?php echo $audio_mp3_file; ?>"><div id="audioPlayer2"></div></div>
													</span><?php
												} ?>
											</span>
					
											<strong class="bitter"><?php the_title(); ?></strong>
											<span class="desc"><?php the_excerpt(); ?></span>
										</a>
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