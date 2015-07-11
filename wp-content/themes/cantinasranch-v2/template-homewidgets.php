<?php
/*
Template Name: Home-Widgets
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
<section id="main">

<!-- Start of slider wrapper -->
<section class="slider_wrapper">

<!-- Start of slider -->
<section class="slider">   

<ul class="slides">

	<?php
    $temp = $wp_query;
    $wp_query = null;
    $wp_query = new WP_Query('post_type=slider&showposts=10');
    $wp_query->query('post_type=slider&showposts=10');
    ?>
        
    <?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); sltws_post_meta(); ?>
        
        <li>
        <a href="<?php echo $meta[ 'subtitle' ]; ?>" target="_new" title="<?php the_title(); ?>"><?php the_post_thumbnail('slide'); ?></a>
        </li>
        
        <?php endwhile; ?>
        
	</ul>
    
    <?php wp_reset_query(); ?>

</section><!-- End of slider -->

<!-- Start of clear fix --><div class="clear"></div>

</section><!-- End of slider wrapper -->

<?php 
if ( function_exists( 'get_option_tree' ) ) {
$todaymessage = get_option_tree( 'vn_todaymessage' );
} ?>

<?php if ($todaymessage != ('')){ ?> 

<!-- Start of message center -->
<section id="message_center">
<img src="<?php bloginfo('template_directory'); ?>/img/lg_square.png" height="66" width="66" alt="Today's Message" class="left" />
<h1><?php echo stripslashes($todaymessage); ?></h1>

<!-- Start of clear fix --><div class="clear"></div>

</section><!-- End of message center -->

<?php } else { } ?>

<!-- Start of midsection -->
<section id="midsection">

<!-- Start of one third first -->
<article class="one_third_first">
<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('home_one')) : ?>
<?php endif; ?>

</article><!-- End of one third first -->

<!-- Start of one third -->
<article class="one_third">
<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('home_two')) : ?>
<?php endif; ?>

</article><!-- End of one third -->

<!-- Start of one third -->
<article class="one_third">
<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('home_three')) : ?>
<?php endif; ?>

</article><!-- End of one third -->

<!-- Start of clear fix --><div class="clear"></div>

<!-- Start of line break --><div id="midsectionhr"></div>

<!-- Start of one third first -->
<article class="one_third_first_bottom">
<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('home_four')) : ?>
<?php endif; ?>

</article><!-- End of one third first -->

<!-- Start of one third -->
<article class="one_third_bottom">
<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('home_five')) : ?>
<?php endif; ?>

</article><!-- End of one third -->

<!-- Start of one third -->
<article class="one_third_bottom">
<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('home_six')) : ?>
<?php endif; ?>

</article><!-- End of one third -->

<!-- Start of clear fix --><div class="clear"></div>

</section><!-- End of midsection -->

<!-- Start of clear fix --><div class="clear"></div>
            
</section><!-- End of main -->

<?php get_footer(); ?>