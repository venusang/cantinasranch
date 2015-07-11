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
<?php if(have_posts()) : while(have_posts()) : the_post(); ?>

<!-- Start of blog wrapper -->
<article class="blog_wrapper">

<span class="post_type_event"></span><h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>

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

<?php } else { ?>

<?php the_post_thumbnail('gallery_format'); ?>

<?php } ?>

</div><!-- End of featured image -->

<!-- Start of post wrapper -->
<aside class="post_wrapper">

<!-- Start of post details -->
<div class="post_details">

<!-- Start of posted_on -->
<div class="posted_on">

<div class="cal">
    <span class="month"><?php echo eo_get_schedule_start('M'); ?></span>
    <span class="day"><?php echo eo_get_schedule_start('d'); ?></span>
    </div>

</div><!-- End of posted_on -->

<!-- Start of posted_comments -->
<div class="posted_comments">
<?php if(eo_is_all_day()): ?>
<!-- Event is all day -->
<?php $date_format = 'd M Y'; ?>
<?php else: ?>
<!-- Event is not all day - include time in format -->
<?php $date_format = 'd M Y g:ia'; ?>
<?php endif; ?>

<?php if(eo_reoccurs()):?>
<!-- Event reoccurs - is there a next occurrence? -->
<?php $next =   eo_get_next_occurrence($date_format);?>
<?php if($next): ?>
<!-- If the event is occurring again in the future, display the date -->
<div class="dynamic_events"><?php printf(__('From %1$s until %2$s. Next date is %3$s','eventorganiser'), eo_get_schedule_start('d M Y'), eo_get_schedule_end('d F Y'), $next);?></div>

<?php else: ?>
<!-- Otherwise the event has finished (no more occurrences) -->
<div class="dynamic_events"><?php printf(__('This event finished on %s','eventorganiser'), eo_get_schedule_end('d M Y',''));?></div>
<?php endif; ?>

<?php else: ?>
<!-- Event is a single event -->
<div class="dynamic_events"><?php printf(__('This event is on %s','eventorganiser'), eo_get_the_start($date_format) );?></div>
<?php endif; ?>

<br />

<div class="dynamic_events"><?php if(eo_get_venue_name()):?>
<?php _e('at','eventorganiser');?> <?php eo_venue_name();?>
<?php endif;?> </div>

<br />
<div class="dynamic_events">
<?php
//Events have their own 'event-category' taxonomy. Get list of categories this event is in.
$categories_list = get_the_term_list( get_the_ID(), 'event-category', '', ', ',''); 

if ( '' != $categories_list ) {
$utility_text = __( 'This event was posted in %1$s by <a href="%5$s">%4$s</a>.', 'eventorganiser' );
} else {
$utility_text = __( '', 'eventorganiser' );
}
printf(
$utility_text,
$categories_list,
esc_url( get_permalink() ),
the_title_attribute( 'echo=0' ),
get_the_author(),
esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) )
);
?>
<?php edit_post_link( __( 'Edit'), '<span class="edit-link">', '</span>' ); ?>
</div>

</div><!-- End of posted_comments -->

</div><!-- End of post details -->   

<!-- Start of featured_text -->
<div class="featured_text_event">
<?php the_excerpt(); ?> 

</div><!-- End of featured_text --> 

<?php 
if ( function_exists( 'get_option_tree' ) ) {
$readmoretext = get_option_tree( 'vn_readmore' );
} ?>

<a href="<?php the_permalink (); ?>"><?php echo stripslashes($readmoretext); ?></a>  

</aside><!-- End of post wrapper -->   

<hr />     

</article><!-- End of blog wrapper -->

<?php endwhile; ?> 

<?php else: ?> 
<p><?php _e( 'There are no events to display. Try using the search.', 'gospel' ); ?></p> 

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

<?php get_footer (); ?>