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
						$caption = get_post_meta($post->ID, '_video_caption', true);
						$title = get_the_title($post->ID);
						
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
								$slide_items .= '<span class="icon video"><span class="notext">'.get_post_meta($post->ID, '_video_link', true).'</span></span>';
							$slide_items .= '</a>';
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