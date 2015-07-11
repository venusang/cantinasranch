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
<div id="left_content">
<h1><?php the_title(); ?></h1>
<?php
    $wp_query = new WP_Query(
        array(
            'post_type' => 'news',
            'posts_per_page' => -1
        )
    );
    $counter = 0;

    ?>
    	<div id="newsArticles">
    <?php while ( $wp_query->have_posts() ) : $wp_query->the_post(); sltws_post_meta(); ?>
        <?php $counter++; ?>
        <?php $theThumbnail = get_the_post_thumbnail(); ?>
        <div class="newsArticleRow" id="newsArticle_<?php echo $counter; ?>"/>
	        <span class="newsArticleTitle"><a href="<?php the_permalink(); ?>"><?php the_title();?></a></span>
	         <span class="newsArticleCopy"><?php the_excerpt();?><a class="readMore" href="<?php the_permalink();?>">read more...</a></span>
        </div>
        <?php endwhile; ?>
        </div>
    
    <?php wp_reset_query(); ?>

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