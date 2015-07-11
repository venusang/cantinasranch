<?php get_header(); ?>

<!-- Start of main section -->
<section id="main_section">
<?php 
if ( function_exists( 'get_option_tree' ) ) {
$searchbg = get_option_tree( 'vn_searchbg' );
} ?>

<?php if (isset($searchbg)) { ?>

<!-- Start of main section bg -->
<div id="main_section_bg">

<img src="<?php echo $searchbg; ?>" onerror="this.style.display='none'" />

</div><!-- End of main section bg -->

<!-- Start of clear fix --><div class="clear"></div>

<?php } ?>

</section><!-- End of main section -->

<!-- Start of main -->
<section id="main">

<!-- Start of left content wrapper -->
<section id="left_content_wrapper">


<!-- Start of left content -->
<div id="left_content">
<?php if(have_posts()) : while(have_posts()) : the_post(); ?>

<!-- Start of blog wrapper -->
<article class="blog_wrapper">
<h1><a href="<?php the_permalink (); ?>"><?php the_title(); ?></a></h1>

<hr />

</article><!-- End of blog wrapper -->
        
<?php endwhile; ?> 
            
<?php else: ?> 
	<p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'gospel' ); ?></p> 
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
