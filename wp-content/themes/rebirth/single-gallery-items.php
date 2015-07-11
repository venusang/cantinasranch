<?php get_header(); ?>
		
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	<section id="main">
		<article>
		
			<?php
			
			$featured_caption = get_the_title(get_post_thumbnail_id(get_the_ID()));
			$featured_image = get_the_post_thumbnail($post->ID,'large-full-banner', array('title'=>$featured_caption));
			$show_large_image = get_post_meta($post->ID, '_show_big_image', true); ?>
		
			<?php if ($featured_image && $show_large_image){ ?>
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

				<section class="entry">
					<section class="shadow"></section>

					<?php the_content(); ?>
					<?php comments_template(); ?>
					
				</section>
			</section>
			
		</article>
	</section>
	
	<?php endwhile; endif; ?>

<?php get_footer(); ?>