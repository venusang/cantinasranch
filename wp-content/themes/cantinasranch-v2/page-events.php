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

<!-- Start of left content wrapper -->
<section id="left_content_wrapper">

<!-- Start of left content -->
<div id="left_content" class="eventPage">
<h1><?php the_title(); ?></h1>
<?php
    //LOOK HERE FOR DOCUMENTATION:
    //http://tri.be/support/documentation/the-events-calendar-template-tags-general-functions/

    global $post;
    $current_date = date('j M Y');
    $end_date = date('j M Y', strtotime('360 days'));

    $get_posts = tribe_get_events(array('start_date'=>$current_date,'end_date'=>$end_date) );

    foreach($get_posts as $post) { setup_postdata($post); ?>

        <div class="eventRow">
            <span class="event-date"><?php echo tribe_get_start_date($post->ID, true, 'M j, Y'); ?></span>
            <span class="event-header"><a href="<?php the_permalink(); ?>" id="post-<?php the_ID(); ?>"><?php the_title(); ?></a></span>
            <span class="event-details"><a href="<?php the_permalink(); ?>"> details</a></span>
        </div>

<?php } //endforeach ?>
<?php wp_reset_query(); ?>





<?php if(have_posts()) : while(have_posts()) : the_post(); ?>

<?php the_content('        '); ?> 

<?php endwhile; ?> 

<?php else: ?> 
<p><?php _e( 'There are no posts to display. Try using the search.', 'gospel' ); ?></p> 

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

<!-- Start of clear fix --><div class="clear"></div>
            
</section><!-- End of main -->

<?php get_footer (); ?>