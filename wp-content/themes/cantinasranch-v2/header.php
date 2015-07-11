<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<!--Google Fonts-->
<link href='http://fonts.googleapis.com/css?family=Muli:400,300italic,300,400italic' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=IM+Fell+DW+Pica' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Oswald|Open+Sans' rel='stylesheet' type='text/css'>
<!-- <link href="<?php bloginfo('siteurl'); ?>/wp-content/plugins/lb-events/assets/css/lbevents-widget.css"> -->

<!-- http://10.0.1.9:8888/cantinasranch/wp-content/plugins/lb-events/assets/css/lbevents-widget.css?ver=3.4.2 -->
<link rel="stylesheet" href="http://code.jquery.com/ui/1.9.0/themes/base/jquery-ui.css" />
    <script src="http://code.jquery.com/jquery-1.8.2.js"></script>
    <script src="http://code.jquery.com/ui/1.9.0/jquery-ui.js"></script>
    <script>
    $(function() {
        $("#tabs").tabs();
    });
    </script>

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
<meta name="google-site-verification" content="sc2490QpKMnBU_ngBk4mwJ1Xk3REaJOou_CiNYWwLLk" />
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



 <!-- *************************************************************************
*****************              TWITTER FEED            ********************
************************************************************************** -->
<?php 
if ( function_exists( 'get_option_tree') ) {
  $twitter = get_option_tree( 'vn_twitter_username' );
}
?>
<script type='text/javascript'>
    jQuery(document).ready(function(){
        jQuery(".tweet").tweet({
            username: "<?php echo $twitter; ?>",
            join_text: "auto",
            avatar_size: 36,
            count: 3,
            auto_join_text_default: "we said,", 
            auto_join_text_ed: "we",
            auto_join_text_ing: "we were",
            auto_join_text_reply: "we replied to",
            auto_join_text_url: "we were checking out",
            loading_text: "loading tweets..."
        });
    });
</script>





 <!-- *************************************************************************
*****************              CUSTOM CSS              ********************
************************************************************************** -->
<style type="text/css">
<?php 
if ( function_exists( 'get_option_tree') ) {
  $css = get_option_tree( 'vn_custom_css' );
}
?>
    <?php echo ($css); ?>
</style>

</head>

<?php $theme_options = get_option('option_tree'); ?>

<body <?php body_class(); ?>>
<?php if (is_front_page()) {?>
  <div id="bdywrapper_home">

<?php } else {?>
<!-- Start of bdywrapper -->
<div id="bdywrapper">
<?php } ?>
<!-- Start of outer wrapper -->
<header id="outer_wrapper">

<!-- Start of nav wrapper -->
<div id="nav_wrapper">

<!-- Start of top logo -->
<div id="top_logo">
<a href="<?php bloginfo('siteurl'); ?>"><?php 
if ( function_exists( 'get_option_tree' ) ) {
$logopath = get_option_tree( 'vn_logo' );
} ?><img src="<?php echo $logopath; ?>" alt="logo" /></a>

</div><!-- End of top logo -->

<?php 
if ( function_exists( 'get_option_tree' ) ) {
$infobox = get_option_tree( 'vn_info_box' );
} ?>

<?php if (isset($infobox)) { ?>

<!-- Start of info box -->
<div id="info_box">
<?php echo stripslashes($infobox); ?>

</div><!-- End of info box -->

<?php } ?>

<?php 
if ( function_exists( 'get_option_tree' ) ) {
$maplink = get_option_tree( 'vn_maplink' );
} ?>

<?php if (isset($maplink)) { ?>

<!-- Start of button -->
<div class="button">
<a class="button map chat" href="<?php echo $maplink; ?>" target="_new"><span><?php _e( 'Map &amp; Directions', 'gospel' ); ?></span></a>

</div><!-- End of button -->

<?php } ?>

<!-- Start of clear fix --><div class="clear"></div>

<!-- Start of top -->
<div id="top">  

<!-- Start of topmenu -->
<nav id="topmenu">  
<?php wp_nav_menu(array('menu_class'=>'sf-menu')); ?>






</nav><!-- End of topmenu -->

<!-- Start of searchbox -->
<div id="searchbox">
<?php //get_search_form(); ?>

</div><!-- End of searchbox -->
<!-- Start of social -->
<section class="social">

<ul class="icons">
<?php 
if ( function_exists( 'get_option_tree' ) ) {
$vimeolink = get_option_tree( 'vn_vimeolink' );
} ?>

<?php if (isset($vimeolink)) { ?>


<li><a href="<?php echo $vimeolink; ?>"><img src="<?php bloginfo('template_directory'); ?>/img/vimeo.png" height="14" width="16" alt="vimeo" /></a></li>

<?php } ?>

<?php 
if ( function_exists( 'get_option_tree' ) ) {
$youtubelink = get_option_tree( 'vn_youtubelink' );
} ?>

<?php if (isset($youtubelink)) { ?>

<li><a href="<?php echo $youtubelink; ?>"><img src="<?php bloginfo('template_directory'); ?>/img/youtube.png" height="16" width="17" alt="you tube" /></a></li>

<?php } ?>

<?php 
if ( function_exists( 'get_option_tree' ) ) {
$flickrlink = get_option_tree( 'vn_flickrlink' );
} ?>

<?php if (isset($flickrlink)) { ?>

<li><a href="<?php echo $flickrlink; ?>"><img src="<?php bloginfo('template_directory'); ?>/img/flickr.png" height="10" width="20" alt="flickr" /></a></li>

<?php } ?>

<?php 
if ( function_exists( 'get_option_tree' ) ) {
$googlelink = get_option_tree( 'vn_googlelink' );
} ?>

<?php if (isset($googlelink)) { ?>

<li><a href="<?php echo $googlelink; ?>"><img src="<?php bloginfo('template_directory'); ?>/img/googleplus.png" height="15" width="16" alt="google plus" /></a></li>

<?php } ?>

<?php 
if ( function_exists( 'get_option_tree' ) ) {
$twitter = get_option_tree( 'vn_twitter' );
} ?>

<?php if (isset($twitter)) { ?>

<li><a href="<?php echo $twitter; ?>" target="_blank"><img src="<?php bloginfo('template_directory'); ?>/img/twitter.png" height="13" width="17" alt="twitter" /></a></li>

<?php } ?>

<?php 
if ( function_exists( 'get_option_tree' ) ) {
$facebook = get_option_tree( 'vn_facebook' );
} ?>

<?php if (isset($facebook)) { ?>

<li><a href="<?php echo $facebook; ?>" target="_blank"><img src="<?php bloginfo('template_directory'); ?>/img/facebook.png" height="18" width="9" alt="facebook" /></a></li>

<?php } ?>

</ul>

</section><!-- End of social -->
</div><!-- End of top -->

</div><!-- End of nav wrapper -->

</header><!-- End of outer wrapper -->