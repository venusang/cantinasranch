<?php get_header (); ?>

<!-- Start of main section -->
<section id="main_section">
<?php 
if ( function_exists( 'get_option_tree' ) ) {
$blogbg = get_option_tree( 'vn_blogbg' );
} ?>

<?php if (isset($blogbg)) { ?>

<!-- Start of main section bg -->
<div id="main_section_bg">

<img src="<?php echo $blogbg; ?>" onerror="this.style.display='none'" />

</div><!-- End of main section bg -->

<!-- Start of clear fix --><div class="clear"></div>

<?php } ?>

</section><!-- End of main section -->

<!-- Start of main -->
<section id="main">

<!-- Start of clear fix --><div class="clear"></div>

<!-- Start of left content wrapper -->
<section id="left_content_wrapper">


<!-- Start of left content -->
<div id="left_content">
<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
<?php get_template_part( 'content', get_post_format() ); ?>

<?php endwhile; ?> 

<?php else: ?> 
<p><?php _e( 'There are no posts to display. Try using the search.', 'gospel' ); ?></p> 

<?php endif; ?>

</div><!-- End of left content -->

</section><!-- End of left content wrapper -->

<!-- Start of right content wrapper -->
<aside id="right_content_wrapper">

<!-- Start of right content -->
<div id="right_content">
<?php get_sidebar ('blog'); ?>            

</div><!-- End of right content -->

</aside><!-- End of right content wrapper -->

<!-- Start of navigation -->
<div class="navigation">

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

</div><!-- End of navigation -->    

<!-- Start of clear fix --><div class="clear"></div>
            
</section><!-- End of main -->

<?php get_footer (); ?>