<?php
/*
 * The default template for displaying link
 */
?>

<!-- Start of blog wrapper -->
<article class="blog_wrapper">

<span class="post_type_link"></span><h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>

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

</div><!-- End of featured image -->

<!-- Start of clear fix --><div class="clear"></div> 

<!-- Start of featured_text -->
<div class="featured_text">

<?php the_excerpt(); ?>

</div><!-- End of featured_text -->     

</article><!-- End of blog wrapper -->

<hr>