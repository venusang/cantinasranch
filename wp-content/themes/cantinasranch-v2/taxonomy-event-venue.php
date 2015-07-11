<?php get_header(); ?>

<!-- Start of main section -->
<section id="main_section">

<?php 
if ( function_exists( 'get_option_tree' ) ) {
$eventbg = get_option_tree( 'vn_eventbg' );
} ?>

<?php if (isset($eventbg)) { ?>

<!-- Start of main section -->
<section id="main_section">

<!-- Start of main section bg -->
<div id="main_section_bg">

<img src="<?php echo $eventbg; ?>" onerror="this.style.display='none'" />

<!-- Start of clear fix --><div class="clear"></div>

</div><!-- End of main section bg -->

<?php } ?>

</section><!-- End of main section -->

<!-- Start of main -->
<section id="main">

<!-- Start of left content wrapper -->
<section id="left_content_wrapper">

<!-- Start of left content -->
<div id="left_content">
<?php while ( have_posts() ) : the_post(); ?>

<!-- Start of blog wrapper -->
<article class="blog_wrapper">
<?php if(eo_get_venue_name()):?>

<span class="post_type_event"></span><h1><?php eo_venue_name();?></h1>

<?php endif;?> 

<!-- Start featured image -->
<div class="featured_image">
<!-- Display the venue map. If you specify a class, ensure that class has height/width dimensions-->
<?php echo do_shortcode('[eo_venue_map width="100%"]'); ?>

</div><!-- End of featured image -->

<!-- Start of post wrapper -->
<aside class="post_wrapper">

<!-- Start of post details -->
<div class="post_details">

<!-- Start of posted_on -->
<div class="posted_on">

</div><!-- End of posted_on -->

<!-- Start of posted_comments -->
<div class="posted_comments">

</div><!-- End of posted_comments -->

</div><!-- End of post details -->   

<!-- Start of featured_text -->
<div class="featured_text_event">
<?php
$address_array = eo_get_venue_address($event->ID);

{?>

<p>Located at <?php echo $address_array['address'].'<span> , </span>'.$address_array['postcode']; ?><br /></p>
<?php } ?> 

</div><!-- End of featured_text --> 

</aside><!-- End of post wrapper -->   

<hr />     

</article><!-- End of blog wrapper -->

<?php endwhile; ?> 

</div><!-- End of left content -->

</section><!-- End of left content wrapper -->

<!-- Start of right content wrapper -->
<aside id="right_content_wrapper">

<!-- Start of right content -->
<div id="right_content">
<?php get_sidebar ('page'); ?>

</div><!-- End of right content -->

</aside><!-- End of right content wrapper -->

<!-- Start of navigation -->
<div class="navigation">
<?php 
global $wp_query;
if ( $wp_query->max_num_pages > 1 ) : ?>
                
<!-- Start of alignleft -->
<div class="alignleft">

<!-- Start of button -->
<div class="button">
<?php next_posts_link( __('older','gospel') ) ?>

</div><!-- End of button -->

</div><!-- End of alignleft -->

<!-- Start of alignright -->
<div class="alignright">

<!-- Start of button -->
<div class="button">
<?php previous_posts_link( __('newer','gospel') ) ?>

</div><!-- End of button -->

</div><!-- End of alignright -->

<?php endif; ?>

</div><!-- End of navigation --> 

<!-- Start of clear fix --><div class="clear"></div>
            
</section><!-- End of main -->

<?php get_footer(); ?>
