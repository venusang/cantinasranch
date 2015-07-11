<?php get_header(); ?>
<!-- Start of main section -->
<section id="main_section">

<?php
    $backgroundurl1 = get_post_meta($post->ID, 'backgroundurl1', $single = true);
?>
<style type="text/css">
@media only screen and (max-width: 768px) {
#fancybox-overlay{
	width:1400px;
}
}



</style>
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

<?php if(have_posts()) : while(have_posts()) : the_post(); ?>

<?php the_content(''); ?> 

<?php endwhile; ?> 

<?php else: ?> 

<?php endif; ?>


<?php
    $wp_query = new WP_Query(
        array(
            'post_type' => 'arts_instructors',
            'posts_per_page' => -1
        )
    );
    $counter = 0;
    ?>

        

    	<div id="staffMembers">
    <?php while ( $wp_query->have_posts() ) : $wp_query->the_post();?>
        <?php $counter++; ?>

     <?php
	    //get the arts instructors title
     $subTitle;
     $postID = get_the_id();
	  $custom_fields = get_post_custom($postID);
	  $my_custom_field = $custom_fields['meta_subtitle'];
	  if($my_custom_field){
	  	foreach ( $my_custom_field as $key => $value )
	    // echo $key . " => " . $value . "<br />";
	  		$subTitle = $value;
	  } else {
	  	$subTitle = '';
	  }
	?>
        <?php $theThumbnail = get_the_post_thumbnail(); ?>
        <div class="staffMember" id="staffMember_<?php echo $counter; ?>">
	        <span class="staffMemberImage"><a class="fancybox iframe" href="<?php the_permalink();?>" target="_new" title="<?php the_title(); ?>"><?php if($theThumbnail){ the_post_thumbnail('large'); } else { ?><img src="http://placekitten.com/100/150" /><?php } ?></a></span>
	        <span class="staffMemberName"><a class="fancybox iframe" href="<?php the_permalink();?>"><?php the_title();?><span class="subTitle"><?php echo $subTitle ?></span></a></span>
        </div>
       
        <?php endwhile; ?>
        </div>
    
    <?php wp_reset_query(); ?>





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