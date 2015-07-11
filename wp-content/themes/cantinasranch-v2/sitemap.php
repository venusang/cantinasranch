<?php  
/* 
Template Name: Sitemap 
*/  
?>

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

<h3><?php _e( 'Pages', 'gospel' ); ?></h3>

<ul><?php wp_list_pages("title_li=" ); ?></ul>

<hr>

<h3><?php _e( 'Feeds', 'gospel' ); ?></h3>

<ul>

<li><a title="<?php _e( 'Full content', 'gospel' ); ?>" href="feed:<?php bloginfo('rss2_url'); ?>"><?php _e( 'Main RSS', 'gospel' ); ?></a></li>
<li><a title="<?php _e( 'Comment Feed', 'gospel' ); ?>" href="feed:<?php bloginfo('comments_rss2_url'); ?>"><?php _e( 'Comment Feed', 'gospel' ); ?></a></li>

</ul>

<hr>

<h3><?php _e( 'Categories', 'gospel' ); ?></h3>

<ul>

<?php $args = array(
    'show_option_all'    => '',
    'orderby'            => 'name',
    'order'              => 'ASC',
    'style'              => 'list',
    'show_count'         => 1,
    'hide_empty'         => 1,
    'use_desc_for_title' => 0,
    'child_of'           => 0,
    'feed'               => '',
    'feed_type'          => '',
    'feed_image'         => '',
    'exclude'            => '',
    'exclude_tree'       => '',
    'include'            => '',
    'hierarchical'       => true,
    'title_li'           => '',
    'show_option_none'   => __('No categories'),
    'number'             => NULL,
    'echo'               => 1,
    'depth'              => 0,
    'current_category'   => 0,
    'pad_counts'         => 0,
    'taxonomy'           => 'category',
    'walker'             => 'Walker_Category' ); ?> 
	
	<?php wp_list_categories( $args ); ?>
    
    </ul>

<hr>

<h3><?php _e( 'All Blog Posts', 'gospel' ); ?>:</h3>

<ul><?php $archive_query = new WP_Query('showposts=1000&cat=-8');
while ($archive_query->have_posts()) : $archive_query->the_post(); ?>

<li>
<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php _e( 'Permanent Link to', 'gospel' ); ?><?php the_title(); ?>"><?php the_title(); ?></a>
(<?php comments_number('0', '1', '%'); ?>)
</li>

<?php endwhile; ?>

</ul>

<hr>

<h3><?php _e( 'Archives', 'gospel' ); ?></h3>

<ul>
<?php wp_get_archives('type=monthly&show_post_count=true'); ?>
</ul>

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