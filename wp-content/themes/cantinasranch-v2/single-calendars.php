<?php
/*
Single Post Template: Homepage Calendar
Description: This part is optional, but helpful for describing the Post Template
*/
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<!--[if IE 7 ]>    <html class= "ie7"> <![endif]-->
<!--[if IE 8 ]>    <html class= "ie8"> <![endif]-->
<!--[if IE 9 ]>    <html class= "ie9"> <![endif]-->

<!--[if lt IE 9]>
   <script>
      document.createElement('header');
      document.createElement('nav');
      document.createElement('section');
      document.createElement('article');
      document.createElement('aside');
      document.createElement('footer');
   </script>
<![endif]--><head>
<title><?php echo get_option('blogname'); ?><?php wp_title(); ?></title>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
<meta name="viewport" content="width=device-width" />

<?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); ?>

<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

 <!-- *************************************************************************
*****************                FAVICON               ********************
************************************************************************** -->
<?php 
if ( function_exists( 'get_option_tree') ) {
  $favicon = get_option_tree( 'vn_custom_favicon' );
}
?>
<link rel="shortcut icon" href="<?php echo ($favicon); ?>" />

  <!--[if lt IE 9]>
<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<?php wp_head(); ?>

<style type="text/css">
.lbev-calendar .days li.theday{
	height:50px;
	list-style:none;
}
.lbev-calendar .days li.theday .dayname{
	font-size:12px;
}

</style>


</head>

<?php $theme_options = get_option('option_tree'); ?>

<body <?php body_class(); ?>>


<?php if(have_posts()) : while(have_posts()) : the_post(); ?>

<?php the_content(); ?> 

<?php endwhile; ?> 

<?php else: ?> 
<p><?php _e( 'There are no posts to display. Try using the search.', 'gospel' ); ?></p> 

<?php endif; ?>

</body>

