<?php
/*
Template Name: Full-Width
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

<!-- Start of main fullwidth -->
<div id="main_fullwidth">

<!-- Start of clear fix --><div class="clear"></div>

<!-- Start of main fullwidth wrapper -->
<section id="main_fullwidth_wrapper">
<?php if(have_posts()) : while(have_posts()) : the_post(); ?>

<!-- Start of fullwidth content -->
<div class="fullwidth_content">

<?php the_content('        '); ?> 

<?php endwhile; ?> 

<?php else: ?> 
<p><?php _e( 'There are no posts to display. Try using the search.', 'gospel' ); ?></p> 

<?php endif; ?>

<!-- Start of clear fix --><div class="clear"></div>

</div><!-- End of fullwidth content -->

</section><!-- End of main fullwidth wrapper -->

</div><!-- End of main fullwidth -->

<!-- Start of clear fix --><div class="clear"></div>
            
</section><!-- End of main -->

<?php get_footer (); ?>