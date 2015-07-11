<?php get_header(); ?>

	<section id="main">
		<article>

			<section class="shadow"></section>
			<br />

			<?php js_breadcrumbs($post->ID); ?>
			
			<section id="content" class="full"><?php
			
				// Get the Event category and display the title.
				$cat = get_query_var('galleries');
				$category_name = get_term_by('slug',$cat,'galleries'); ?>
				
				<?php echo '<h1 class="bitter">Galleries <span>&gt;</span> '.$category_name->name.'</h1>'; ?>
	
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
												<span class="icon gallery"><span class="notext"></span></span>
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