<?php
/*
Template Name: Catinas Ranch Custom Homepage - v2
*/

get_header ();


?>

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
<section id="main-homepage">


<!-- ******************************************************************** This is the slider ********************************************************************-->

<!-- Start of slider wrapper -->
<section class="slider_wrapper">

<!-- Start of slider -->
<section class="slider">   
    <?php if(have_posts()) : while(have_posts()) : the_post(); ?>

<?php the_content(); ?> 

<?php endwhile; ?> 

<?php else: ?> 

<?php endif; ?>
</section><!-- End of slider -->
<!-- Start of clear fix --><div class="clear"></div>
</section><!-- End of slider wrapper -->
<!-- ******************************************************************** This is the  area under the slider ********************************************************************-->
<!-- Start of midsection -->
<section id="midsection">




<div id="tabs">
    <ul>
        
        <li><a href="#calendar">Calendar</a></li>
        <li><a href="#news">News</a></li>
        <li><a href="#events">Events</a></li>
         <li><a href="#blog">CRF Blog</a></li>
    </ul>
   
    <div id="calendar">
        <div id="eventsCalendar">

            <?php get_sidebar ('homepage'); ?>            
        </div><!-- eventsCalendar-->
    </div>
    <!-- BEGINNING OF NEWS -->
    <div id="news">
        <ul>
        <?php 
        $args = array('post_type' => 'news', 'posts_per_page' => 7);
        $homepage_module_query = new WP_Query($args);
        ?>
        <?php while ( $homepage_module_query -> have_posts() ) : $homepage_module_query -> the_post(); ?>

        
            <li><a href="<?php the_permalink(); ?>"><?php the_title();?></a></li>
        
        <?php endwhile; ?>
        <span class="btnCantinasRanch"><a href="<?php echo get_bloginfo('siteurl');?>/news">View all news</a></span>
        </ul>
        <?php wp_reset_query(); ?>    

    </div><!-- END OF NEWS -->
    
    <!-- BEGINNING OF EVENTS -->

     <div id="events">

<?php
    //LOOK HERE FOR DOCUMENTATION:
    //http://tri.be/support/documentation/the-events-calendar-template-tags-general-functions/

    global $post;
    $current_date = date('j M Y');
    $end_date = date('j M Y', strtotime('360 days'));

    $get_posts = tribe_get_events(array('start_date'=>$current_date,'end_date'=>$end_date,'posts_per_page'=>5) );

    foreach($get_posts as $post) { setup_postdata($post); ?>

        <div class="eventRow">
            <span class="event-date"><?php echo tribe_get_start_date($post->ID, true, 'M j, Y'); ?></span>
            <span class="event-header"><a href="<?php the_permalink(); ?>" id="post-<?php the_ID(); ?>"><?php the_title(); ?></a></span>
            <!-- <span class="event-details"><a href="<?php the_permalink(); ?>"> details</a></span> -->
        </div>

<?php } //endforeach ?>
<?php wp_reset_query(); ?>
        
       <span class="btnCantinasRanch"><a href="<?php echo get_bloginfo('siteurl');?>/events">View all events</a></span>
    </div><!-- END OF EVENTS -->
<!-- BEGINNING OF BLOG -->
    <div id="blog">
        <?php 
        $args = array('post_type' => 'blog',
            'posts_per_page' => 2);
            $homepage_blog_query = new WP_Query($args);
            $blogCounter = 0;
        ?>
        <div id="blogWrapper">
        <?php while ( $homepage_blog_query -> have_posts() ) : $homepage_blog_query -> the_post(); ?>
        <?php $blogCounter++; ?>
        <div class="homepageBlog">
            <span class="blogImage"><a href="<?php the_permalink(); ?>"><?php if(has_post_thumbnail()){ the_post_thumbnail(); } else {?><img src="http://placekitten.com/75/75" /><?php }?></a></span>
            <span class="blogContent">
                <a class="blogTitle" href="<?php the_permalink(); ?>"><?php the_title();?></a>
                <?php the_excerpt(); ?><a class="readMore" href="<?php the_permalink(); ?>">  read more... </a>
            </span>
        </div>
        <?php endwhile; ?>
        </div><!-- end of blogWrapper -->
       <?php if($blogCounter > 0) {?>
        <span class="btnCantinasRanch"><a href="<?php echo get_bloginfo('siteurl');?>/blog">View all blogs</a></span>
        <?php } else {?> Coming soon.<?php } ?>
        <?php wp_reset_query(); wp_reset_postdata();?>

    </div><!-- END OF BLOG -->
</div>

<?php 
    $args = array('post_type' => 'homepage_modules','posts_per_page'=>5);
    $homepage_module_query = new WP_Query($args);
    $i = 0;
?>

    
<ul class="homepage_modules">
    <?php while ( $homepage_module_query -> have_posts() ) : $homepage_module_query -> the_post(); ?>
    <?php
    if (get_post_meta($post->ID, 'external_url', true)) {
       
    $thePostUrl = "href = \"";   
    $thePostUrl .= get_post_meta($post->ID, 'external_url', true);
    $thePostUrl .= "\"";
    $thePostUrl .= "target = \"_blank\""; 
    } else {

        $thePostUrl = "href = \"";
        $thePostUrl .= get_permalink();
        $thePostUrl .= "\""; 
    }
    ?>
<?php $i++; ?>
        <li>
            <div class="homepage_module" id="homepage_module_0<?php echo $i;?>" />
                <a <?php echo $thePostUrl; ?>><span class="homepage_module_title"><?php the_title(); ?></span>
                <span class="homepage_module_image"><?php the_post_thumbnail('array(200,100)'); ?></a></span>
            </div>
        </li>
    <?php endwhile; ?>
</ul><!-- end of homepage_modules -->
<?php wp_reset_query(); ?>




    <div class="homepage_module" id="donateModule">
        <a href="<?php echo get_bloginfo('siteurl'); ?>/donate">
            <span class="homepage_module_title">Donate</span>
            <span class="homepage_module_image"><img src="<?php echo get_bloginfo('stylesheet_directory'); ?>/img/imageDonate-v2.png" /></span>
        </a>
    </div>


</section><!-- End of midsection -->

<!-- Start of clear fix --><div class="clear"></div>

            
</section><!-- End of main -->

<?php include('footer-homepage.php'); ?>



<?php //get_footer(); ?>