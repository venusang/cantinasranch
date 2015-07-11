<?php get_header(); ?>

	<section id="main">
		<article>

			<section class="shadow"></section>
			<br />

			<?php js_breadcrumbs($post->ID); ?>
			
			<section id="content" class="full"><?php
			
				$post = $posts[0]; // Hack. Set $post so that the_date() works. ?>

				<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>

				<?php /* If this is a category archive */ if (is_category()) { ?>
					<h1 class="bitter"><?php single_cat_title(); ?></h1>
		
				<?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
					<h1 class="bitter"><?php single_tag_title(); ?></h1>
		
				<?php /* If this is a daily archive */ } elseif (is_day()) { ?>
					<h1 class="bitter"><?php _e('Archive for','rebirth'); echo ' '; the_time('F jS, Y'); ?></h1>
		
				<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
					<h1 class="bitter"><?php _e('Archive for','rebirth'); echo ' '; the_time('F, Y'); ?></h1>
		
				<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
					<h1 class="bitter"><?php _e('Archive for','rebirth'); echo ' '; the_time('Y'); ?></h1>
		
				<?php /* If this is an author archive */ } elseif (is_author()) { ?>
					<h1 class="bitter"><?php _e('Author Archive','rebirth'); ?></h1>
					
				<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
					<h1 class="bitter"><?php _e('Blog Archives','rebirth'); ?></h1>
				<?php } ?>
	
				<?php if ( have_posts() ) : ?>
				
					<section id="recent" class="cols">
		
						<section class="three-quarters full">
						
							<ul><?php
							
								$counter = 0;
							
								while ( have_posts() ) : the_post(); global $post;
								
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
												<span class="icon post"><span class="notext"></span></span>
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