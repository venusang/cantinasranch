<!DOCTYPE html>

<!--[if lt IE 7 ]> <html class="ie ie6 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7 ]>    <html class="ie ie7 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8 ]>    <html class="ie ie8 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 9 ]>    <html class="ie ie9 no-js" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 9]><!--><html class="no-js" <?php language_attributes(); ?>><!--<![endif]-->
<!-- the "no-js" class is for Modernizr. -->

<head>
	
	<meta charset="<?php bloginfo('charset'); ?>">
	
	<?php if (is_search()) { ?>
	<meta name="robots" content="noindex, nofollow" /> 
	<?php } ?>

	<title><?php wp_title('-', true, 'right'); ?> <?php bloginfo('name'); ?></title>
	
	<?php $highlight_color = of_get_option('js_highlight_color');
	if ($highlight_color){
		$highlight_color = explode('#',$highlight_color);
		$highlight_color = $highlight_color[1];
	}
	
	$logo_height = of_get_option('js_logo_height');
	if (!$logo_height){ $logo_height = 55; }
	
	$custom_font = of_get_option('js_custom_font');
	if (!$custom_font){ $custom_font = 'Bitter'; }
	
	$footer_text_style = of_get_option('js_footer_text_style');
	if (!$footer_text_style){ $footer_text_style = 'light'; }
	
	$template_dir = get_template_directory_uri(); ?>
		
	<!-- CSS: reset is in style.css, while the rebirth styling is within default.css -->
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" />
	<link rel="stylesheet" href="<?php echo $template_dir; ?>/_theme_styles/colorbox.css" />
	<link rel="stylesheet" href="<?php echo $template_dir; ?>/_theme_styles/player.css" />
	<link href="http://fonts.googleapis.com/css?family=<?php echo $custom_font; ?>" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="<?php echo $template_dir; ?>/_theme_styles/custom.php?font=<?php echo $custom_font; ?>&color=<?php echo ($highlight_color ? $highlight_color : 'db2a07'); ?>&logoheight=<?php echo $logo_height; ?>&footer_text_style=<?php echo $footer_text_style; ?>" />
	
	<?php // Is there a custom logo or background image?
	
		$custom_logo = of_get_option('js_logo');
		$background_image = of_get_option('js_background_image');
		$background_color = of_get_option('js_background_color');
		$background_image_alignment = of_get_option('js_background_image_alignment');
		$background_image_repeat = of_get_option('js_background_image_repeat');
		$background_fixed = of_get_option('js_background_image_fixed');
		$slider_button_location = of_get_option('js_homepage_slider_button_location');
		
		if ($background_fixed) { $background_fixed = 'fixed '; } else { $background_fixed = ''; }
	
		if ($slider_button_location || $custom_logo || $background_image || $background_color){ echo '<style type="text/css">
		'; }
		
		if ($custom_logo){ echo '#logo a { background: url(\''.$custom_logo.'\') left center no-repeat; }
		'; }
		
		if ($background_color || $background_image){
			if ($background_color && !$background_image){
				echo 'body { background: '.$background_color.'; }';
			} else if ($background_image && !$background_color){
				echo 'body { background: url(\''.$background_image.'\')'.($background_image_alignment ? ' '.$background_image_alignment : '').($background_image_repeat ? ' '.$background_image_repeat : '').' '.$background_fixed.'; }';
			} else {
				echo 'body { background: '.$background_color.' url(\''.$background_image.'\')'.($background_image_alignment ? ' '.$background_image_alignment : '').($background_image_repeat ? ' '.$background_image_repeat : '').' '.$background_fixed.'; }';
			}
		} else if ($background_fixed){
			echo 'body { background-attachment:fixed!important; }';
		}
		
		if ($custom_logo || $background_image || $background_color){ echo '</style>'; }
	?>
	
	<?php if (of_get_option('js_favicon')){ ?>
		<!-- The Favicon, change this to whatever you'd like -->
		<link rel="shortcut icon" href="<?php echo of_get_option('js_favicon'); ?>" />
	<?php } ?>
	
	<!-- The HTML5 Audio Player stylesheet -->
	<link rel="stylesheet" href="<?php echo $template_dir; ?>/_theme_styles/player/style.css" type="text/css" media="all" />
	
	<!-- all our JS is at the bottom of the page, except for Modernizr. -->
	<script src="<?php echo $template_dir; ?>/js/modernizr.custom.00324.js"></script>
	<script src="<?php echo $template_dir; ?>/js/swfobject.js" type="text/javascript" charset="utf-8"></script>
	<script src="<?php echo $template_dir; ?>/js/audio-player.js" type="text/javascript" charset="utf-8"></script>
	
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

	<?php if ( is_singular() ) wp_enqueue_script( "comment-reply" );
	wp_head(); if (!isset($content_width)) $content_width = 940; ?>
	
	<script type="text/javascript" charset="utf-8">
		document.domain = document.domain;
		function embedCode(playerId, playerWidth, flashvars, params, attributes) {
			swfobject.embedSWF("<?php echo $template_dir; ?>/js/mp3player.swf", playerId, playerWidth, "33", "9.0.0", "<?php echo $template_dir; ?>/js/expressInstall.swf", flashvars, params, attributes);
		}
	</script>
	
	<?php $google_analytics = of_get_option('js_google_analytics');
	if ($google_analytics) {
		echo $google_analytics;
	} ?>
	
</head>

<body <?php body_class( 'container_12' ); ?>>

	<section id="wrap" class="shell">
		<header>
			
			<?php // Custom Logo Uplaoded?
			$custom_logo = of_get_option('js_logo'); ?>
			<h1 id="logo">
				<a <?php if ($custom_logo){ echo 'style="background-image:url(\''.$custom_logo.'\');" '; } ?>title="<?php echo get_bloginfo('description'); ?>" class="notext" href="<?php echo home_url(); ?>/"><?php bloginfo('name'); ?></a>
			</h1>

			<nav class="bitter">
				<?php
				
				// Display Main Menu
				wp_nav_menu(array('container' => false, 'theme_location' => 'main-menu', 'fallback_cb' => 'main_menu_message'));
				
				function main_menu_message(){
					echo '<span style="display:block; position:relative; top:18px; text-align:center; font-size:15px; color:#fff;">Please <a style="color:#f9e184;" href="'.home_url().'/wp-admin/nav-menus.php">create and set a menu</a> for the main navigation.</span>';
				}
				
				?>
			</nav>
		</header>