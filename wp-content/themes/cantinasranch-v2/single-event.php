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
<span class="post_type_event"></span><h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
         
   
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

<br />

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
<?php the_content(); ?> 

</div><!-- End of featured_text --> 

</aside><!-- End of post wrapper -->   

<?php
$address_array = eo_get_venue_address($event->ID);

{?>
<!---- If the venue has a description display it-->
<div class="venue-archive-meta">
<p><?php if(eo_get_venue_name()):?>
<?php _e('at','eventorganiser');?> <?php eo_venue_name();?>
<?php endif;?> Located at <?php echo $address_array['address'].'<span> , </span>'.$address_array['postcode']; ?><br /></p>
</div>
<?php } ?>

<!-- Display the venue map. If you specify a class, ensure that class has height/width dimensions-->
<?php echo do_shortcode('[eo_venue_map width="100%"]'); ?> 

</article><!-- End of blog wrapper -->

<?php endwhile; // end of the loop. ?>

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

<!-- Start of clear fix --><div class="clear"></div>
            
</section><!-- End of main -->

<?php get_footer (); ?>