<?php
/*
 * The default template for displaying content
 */
?>

<!-- Start of blog wrapper -->
<article class="blog_wrapper">

<span class="post_type_standard"></span><h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>

<!-- Start of posted details -->
<div class="posted_details">

<!-- Start of post content first -->
<div class="post_content_first">
<?php the_author() ?>

</div><!-- End of post content first -->

<!-- Start of post content -->
<div class="post_content">
<?php the_time('F jS, Y') ?>

</div><!-- End of post content -->

<!-- Start of post content last -->
<div class="post_content_last">
<?php comments_popup_link('0', '1', '%', 'comments-link'); ?> comments

</div><!-- End of post content last -->

</div><!-- End of posted details -->

<!-- Start featured image -->
<div class="featured_image">
<a href="<?php the_permalink (); ?>"><?php the_post_thumbnail('blog_inner'); ?></a>

</div><!-- End of featured image -->

<!-- Start of featured_text blog -->
<div class="featured_text_full">
<p><?php the_excerpt(); ?></p>

</div><!-- End of featured_text blog -->

<?php 
if ( function_exists( 'get_option_tree' ) ) {
$readmoretext = get_option_tree( 'vn_readmore' );
} ?>

<a href="<?php the_permalink (); ?>"><?php echo stripslashes($readmoretext); ?></a>       

</article><!-- End of blog wrapper -->

<hr>