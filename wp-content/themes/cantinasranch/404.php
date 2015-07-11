<?php get_header(); ?>

	<section id="main">
		<article>
		
			<section id="content" class="full">
				
				<section class="entry">
					<section class="shadow"></section>

					<h1 class="bitter fourohfour"><?php _e('Page Not Found','rebirth'); ?></h1>
					<?php echo (of_get_option('js_404_content') ? of_get_option('js_404_content') : '<p>'.__('Sorry, this page cannot be found.','rebirth').'</p>'); ?>
					
				</section>
			</section>
			
		</article>
	</section>

<?php get_footer(); ?>