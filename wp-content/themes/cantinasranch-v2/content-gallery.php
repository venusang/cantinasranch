<?php
/*
 * The default template for displaying gallery
 */
?>

<!-- Start of blog wrapper -->
<article class="blog_wrapper">

<span class="post_type_gallery"></span><h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>

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
<?php
$attachments = get_children(
array(
'post_type' => 'attachment',
'post_mime_type' => 'image',
'post_parent' => $post->ID
));
if(count($attachments) > 1) { ?>

<!-- Start of slider -->
<section class="slider">   

<ul class="slides">
<?php 

$args = array(
'post_type' => 'attachment',
'numberposts' => -1,
'post_status' => null,
'post_parent' => $post->ID
);

$attachments = get_posts( $args );
if ( $attachments ) {
foreach ( $attachments as $attachment ) {
echo '<li>';
echo wp_get_attachment_image( $attachment->ID, 'gallery_format' );
echo '</li>';
}
}

?>

</ul><!-- End of slides -->	

</section><!-- End of slider -->

<?php } else { }?>

</div><!-- End of featured image --> 

<!-- Start of featured_text -->
<div class="featured_text">
<p><?php the_excerpt(); ?></p>

</div><!-- End of featured_text -->

<?php 
if ( function_exists( 'get_option_tree' ) ) {
$readmoretext = get_option_tree( 'vn_readmore' );
} ?>

<a href="<?php the_permalink (); ?>"><?php echo stripslashes($readmoretext); ?></a>       

</article><!-- End of blog wrapper -->

<hr>