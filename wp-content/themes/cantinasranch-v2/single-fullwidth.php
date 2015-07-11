<?php
/*
Single Post Template: [Blog Single Full Width]
Description: This part is optional, but helpful for describing the Post Template
*/
?>

<?php get_header(); ?>

<!-- Start of main section -->
<section id="main_section">

<?php
    $backgroundurl1 = get_post_meta($post->ID, 'backgroundurl', $single = true);
?>

<!-- Start of main section bg -->
<div id="main_section_bg">

<img src="<?php echo $backgroundurl1; ?>" onerror="this.style.display='none'" />

</div><!-- End of main section bg -->

<!-- Start of clear fix --><div class="clear"></div>

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

<!-- Start of blog wrapper -->
<article class="blog_wrapper">
<?php 
    if (has_post_format('video')) { ?>
         <span class="post_type_video"></span><h1><?php the_title (); ?></h1>
<?php  } elseif (has_post_format('audio')) { ?>
         <span class="post_type_audio"></span><h1><?php the_title (); ?></h1>
<?php  } elseif (has_post_format('gallery')) { ?>
         <span class="post_type_gallery"></span><h1><?php the_title (); ?></h1>
         
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
echo wp_get_attachment_image( $attachment->ID, 'slide' );
echo '</li>';
}
}

?>

</ul><!-- End of slides -->	

</section><!-- End of slider -->

<?php } else { }?>
        
</div><!-- End of featured image -->

<?php  } elseif (has_post_format('link')) { ?>
         <span class="post_type_link"></span><h1><?php the_title (); ?></h1>
         
<!-- Start featured image -->
<div class="featured_image">
<?php the_post_thumbnail('slide'); ?>

</div><!-- End of featured image -->
         
<?php  } elseif (has_post_format('quote')) { ?>
         <span class="post_type_quote"></span><h1><?php the_title (); ?></h1>
         
<!-- Start featured image -->
<div class="featured_image">
<?php the_post_thumbnail('slide'); ?>

</div><!-- End of featured image -->

<?php  } else { ?>
         <span class="post_type_standard"></span><h1><?php the_title (); ?></h1>
         
<!-- Start featured image -->
<div class="featured_image">
<?php the_post_thumbnail('slide'); ?>

</div><!-- End of featured image -->

<?php  }
	
 ;?>
 
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

<!-- Start of featured_text -->
<div class="featured_text">
<?php the_content('        '); ?> 

<?php endwhile; ?> 

<?php else: ?> 
<p><?php _e( 'There are no posts to display. Try using the search.', 'gospel' ); ?></p> 

<?php endif; ?>

<!-- Start of clear fix --><div class="clear"></div>

</div><!-- End of featured_text --> 

</article><!-- End of blog wrapper -->

<!-- Start of clear fix --><div class="clear"></div>

</div><!-- End of fullwidth content -->

<!-- Start of comment wrapper main -->
<div class="comment_wrapper_main">

<?php comments_template(); ?>

</div><!-- End of comment wrapper main -->

<!-- Clear fix --><div class="clear"></div> 

</section><!-- End of main fullwidth wrapper -->

</div><!-- End of main fullwidth -->

<!-- Start of clear fix --><div class="clear"></div>
            
</section><!-- End of main -->

<?php get_footer (); ?>