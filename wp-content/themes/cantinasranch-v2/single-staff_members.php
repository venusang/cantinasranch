<?php
/*
Single Post Template: [Blog Single Right Sidebar]
Description: This part is optional, but helpful for describing the Post Template
*/
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<!--Google Fonts-->
<link href='http://fonts.googleapis.com/css?family=Muli:400,300italic,300,400italic' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=IM+Fell+DW+Pica' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Oswald|Open+Sans' rel='stylesheet' type='text/css'>
<?php wp_head(); ?>
<style type="text/css">
#main {
	width:700px;
}
#left_content{
	padding:0;
}
.featured_image{
	float:left;
	margin-right:20px;
}

.featured_text{
	width:400px;
	float:left;
}
.featured_text p{
	margin:0;
}
</style>
<body>
<!-- Start of main -->
<section id="main">

<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
 <?php
	    //get the staff members title
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
<!-- Start of blog wrapper -->
         <h1><?php the_title (); ?></h1>
         <h6><?php echo $subTitle; ?></h6>
         
<!-- Start featured image -->
<div class="featured_image">
<?php the_post_thumbnail('featured_image_hero'); ?>

</div><!-- End of featured image -->

   
<!-- Start of featured_text -->
<div class="featured_text">
<?php the_content(''); ?> 

<?php endwhile; ?> 

<?php else: ?> 

<?php endif; ?>

</div><!-- End of featured_text --> 

</section><!-- End of main -->
</body>
</html>