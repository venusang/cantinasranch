<?php
/*
Template Name: Left-Sidebar
*/
?>

<?php get_header(); ?>

<!-- Start of main section -->
<section id="main_section">

<?php
    $backgroundurl1 = get_post_meta($post->ID, 'backgroundurl1', $single = true);
?>

<!-- Start of main section bg -->
<div id="main_section_bg">

<img src="<?php echo $backgroundurl1; ?>" onerror="this.style.display='none'" />

<!-- Start of clear fix --><div class="clear"></div>

</div><!-- End of main section bg -->

</section><!-- End of main section -->

<!-- Start of main -->
<section id="main">

<!-- Start of wrapper content right -->
<section id="wrapper_content_right">

<!-- Start of content right -->
<div id="content_right">
<?php if(have_posts()) : while(have_posts()) : the_post(); ?>

<?php the_content('        '); ?> 

<?php endwhile; ?> 

<?php else: ?> 
<p><?php _e( 'There are no posts to display. Try using the search.', 'gospel' ); ?></p> 

<?php endif; ?>

<!-- Start of clear fix --><div class="clear"></div>

</div><!-- End of content right -->

</section><!-- End of wrapper content right -->

<!-- Start of wrapper content left -->
<aside id="wrapper_content_left">

<!-- Start of content left -->
<div id="content_left">
<?php get_sidebar ('page'); ?>            

</div><!-- End of right content -->

</aside><!-- End of right content wrapper -->

<!-- Start of clear fix --><div class="clear"></div>
            
</section><!-- End of main -->

<?php get_footer (); ?>