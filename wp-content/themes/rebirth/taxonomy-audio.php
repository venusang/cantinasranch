<?php get_header(); ?>

	<section id="main">
		<article>

			<section class="shadow"></section>
			<br />

			<?php js_breadcrumbs($post->ID); ?>
			
			<section id="content" class="full"><?php
			
				// Get the Event category and display the title.
				$cat = get_query_var('audio');
				$category_name = get_term_by('slug',$cat,'audio'); ?>
				
				<?php echo '<h1 class="bitter">Audio <span>&gt;</span> '.$category_name->name.'</h1>'; ?>
	
				<?php if ( have_posts() ) : ?>
				
					<section id="recent" class="cols">
		
						<section class="three-quarters full">
						
							<ul><?php
							
								$counter = 0;
							
								while ( have_posts() ) : the_post(); global $post;
								
									$counter++;
									
									$mp3 = get_post_meta($post->ID, '_file_mp3', true);
									$external_mp3 = get_post_meta($post->ID, '_file_external_mp3', true);
									$ogg = get_post_meta($post->ID, '_file_ogg', true);
									$external_ogg = get_post_meta($post->ID, '_file_external_ogg', true);
									
									$audio_mp3_file = ($external_mp3 ? $external_mp3 : home_url() . '/wp-content/uploads/'.$mp3);
									$audio_ogg_file = ($external_ogg ? $external_ogg : home_url() . '/wp-content/uploads/'.$ogg);
									
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
												<span class="icon audio"><span class="notext"></span></span>
												<span class="mini-player player-container">
													<audio controls="controls" style="width:100%">
														<source type="audio/mpeg" src="<?php echo $audio_mp3_file; ?>" />
													</audio>
													<div class="flash-player" rel="<?php echo $audio_mp3_file; ?>"><div id="audioPlayer2"></div></div>
													<span class="notext" style="display:none"><?php echo $audio_mp3_file ?></span>
												</span>
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

<?php get_footer(); ?>