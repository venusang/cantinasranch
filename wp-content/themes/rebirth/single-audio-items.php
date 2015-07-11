<?php get_header(); ?>
		
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	<section id="main">
		<article>
		
			<section id="slider" class="single">
				<section class="top"></section>
				<section class="bottom"></section>
				<section class="container">
					<ul>
						<?php
						$audio_linkto = get_post_meta($post->ID, '_audio_linkto', true);
						$caption = get_post_meta($post->ID, '_audio_caption', true);
						$button_text = get_post_meta($post->ID, '_audio_button_text', true);
						if (!$button_text) { $button_text = 'More Info'; }
						$title = get_the_title($post->ID);
						
						$mp3 = get_post_meta($post->ID, '_file_mp3', true);
						$external_mp3 = get_post_meta($post->ID, '_file_external_mp3', true);
						
						$audio_mp3_file = ($external_mp3 ? $external_mp3 : home_url() . '/wp-content/uploads/'.$mp3);
						
						$slide_items = '<li>';
							if (has_post_thumbnail($post->ID)){
								$slide_items .= get_the_post_thumbnail( $post->ID, 'slide-image', array('title'=>$caption));
							} else {
								$slide_items .= '<img width="940" height="410" src="'.get_template_directory_uri().'/_theme_styles/images/default_slider_image.jpg" />';
							}
							$slide_items .= '<section class="caption bitter">';
								$slide_items .= '<h3>'.$caption.'</h3>';
							$slide_items .= '</section>';
							$slide_items .= '<a href="'.get_permalink($post->ID).'" class="slide-link">';
								$slide_items .= '<span class="overlay"></span>';
								$slide_items .= '<span class="icon audio"><span class="notext">'.$audio_mp3_file.'</span></span>';
							$slide_items .= '</a>';
							$slide_items .= '<div class="players">';
								$slide_items .= '<section class="player-container">';
									$slide_items .= '<audio class="AudioPlayerV1" data-controls-duration="false" data-controls-time="false">';
										$slide_items .= '<source type="audio/mpeg" src="'.$audio_mp3_file.'" />';
									$slide_items .= '</audio>';
								$slide_items .= '</section>';
								$slide_items .= '<div class="flash-player" rel="'.$audio_mp3_file.'"><div id="audioPlayer1"></div></div>';
							$slide_items .= '</div>';
						$slide_items .= '</li>';
						
						echo $slide_items;
						?>
					</ul>
				</section>
			</section>

			<?php js_breadcrumbs($post->ID); ?>

			<section id="content" class="left">
				<h1 class="bitter"><?php the_title(); ?></h1>

				<section class="entry">
					<section class="shadow"></section>

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