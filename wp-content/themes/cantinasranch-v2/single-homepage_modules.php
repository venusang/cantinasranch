<?php get_header(); ?>

<!-- Start of main section -->
<section id="main_section">

<?php
    $backgroundurl1 = get_post_meta($post->ID, 'backgroundurl', $single = true);
?>



<!-- Start of main section bg -->
<div id="main_section_bg">
<img src="<?php echo $backgroundurl1; ?>" onerror="this.style.display='none'" />

<!-- Start of clear fix --><div class="clear"></div>

</div><!-- End of main section bg -->

</section><!-- End of main section -->

<!-- Start of main -->
<section id="main">


<!-- Start of left content wrapper -->
<section id="left_content_wrapper">

<!-- Start of left content -->
<div id="left_content">
<h1><?php the_title(); ?></h1>

<?php if(have_posts()) : while(have_posts()) : the_post(); ?>

<?php the_content('        '); ?> 

<?php endwhile; ?> 

<?php else: ?> 
<p><?php _e( 'There are no posts to display. Try using the search.', 'gospel' ); ?></p> 

<?php endif; ?>

<!-- Start of clear fix --><div class="clear"></div>

</div><!-- End of left content -->

</section><!-- End of left content wrapper -->

<!-- Start of right content wrapper -->
<aside id="right_content_wrapper">

<!-- Start of right content -->
<div id="right_content">
<?php get_sidebar ('page'); ?>            

</div><!-- End of right content -->

</aside><!-- End of right content wrapper -->

<!-- Start of clear fix --><div class="clear"></div>
            
</section><!-- End of main -->

<?php get_footer (); ?>