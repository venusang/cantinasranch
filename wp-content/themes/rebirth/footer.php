		<div class="cl"></div>
				
		<?php
		$homepage_blocks = of_get_option('js_homepage_blocks');
		
		/* Show the footer map/address block? */
		global $post;
		
		if (is_home()){
			
			$hide_footer_page = '';
			$hide_footer_post = '';
			$hide_footer_videos = '';
			$hide_footer_audio = '';
			$hide_footer_events = '';
			$hide_footer_galleries = '';
			
		} else {
		
			$hide_footer_page = get_post_meta($post->ID, '_hide_footer_map_page', true);
			$hide_footer_page = ($hide_footer_page ? $hide_footer_page[0] : '');
			$hide_footer_post = get_post_meta($post->ID, '_hide_footer_map_post', true);
			$hide_footer_post = ($hide_footer_post ? $hide_footer_post[0] : '');
			$hide_footer_videos = get_post_meta($post->ID, '_hide_footer_map_videos', true);
			$hide_footer_videos = ($hide_footer_videos ? $hide_footer_videos[0] : '');
			$hide_footer_audio = get_post_meta($post->ID, '_hide_footer_map_audio', true);
			$hide_footer_audio = ($hide_footer_audio ? $hide_footer_audio[0] : '');
			$hide_footer_events = get_post_meta($post->ID, '_hide_footer_map_events', true);
			$hide_footer_events = ($hide_footer_events ? $hide_footer_events[0] : '');
			$hide_footer_galleries = get_post_meta($post->ID, '_hide_footer_map_galleries', true);
			$hide_footer_galleries = ($hide_footer_galleries ? $hide_footer_galleries[0] : '');
		
		}
		
		if (!$hide_footer_page && !$hide_footer_post && !$hide_footer_videos && !$hide_footer_audio && !$hide_footer_events && !$hide_footer_galleries){
		
			if (!isset($homepage_blocks['js_footer_mapblock']) || isset($homepage_blocks['js_footer_mapblock']) && !$homepage_blocks['js_footer_mapblock']){
				if (of_get_option('js_contactblock_address') && !is_page_template('page-contactus.php')){ ?>
				<section id="contact" class="cols">
					<section class="shadow"></section>
		
					<section class="one-quarter">
						<h3 class="bitter"><?php echo (of_get_option('js_contactblock_title') ? of_get_option('js_contactblock_title') : 'Get in touch!'); ?></h3>
						<p><?php echo (of_get_option('js_contactblock_text') ? nl2br(of_get_option('js_contactblock_text')) : 'Need to contact us or planning on making a visit? Just click the button below to send us a note or get directions to our location.'); ?></p>
		
						<?php if (of_get_option('js_contactblock_buttonlink')){ ?>
							<a href="<?php echo of_get_option('js_contactblock_buttonlink'); ?>" class="red-button"><?php echo (of_get_option('js_contactblock_buttontext') ? of_get_option('js_contactblock_buttontext') : 'Contact or Visit!'); ?></a>
						<?php } ?>
					</section>
					<section class="three-quarters">
					
						<!-- 700 x 250 Google Map -->
						<?php
							// Convert address to a Google Maps readable one.
							$g_address = (of_get_option('js_contactblock_address') ? of_get_option('js_contactblock_address') : '1 Infinite Loop Cupertino, CA');
							$g_address = str_replace( array("\r\n", "\n","\r"), '+', $g_address );
							$g_address = str_replace(' ','+',$g_address);
						?>
						
						<section class="google-map">
							<iframe width="700" height="250" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=<?php echo $g_address; ?>&amp;aq=&amp;ie=UTF8&amp;hq=&amp;hnear=<?php echo $g_address; ?>&amp;t=m&amp;vpsrc=6&amp;z=<?php echo (of_get_option('js_gmap_zoom') ? of_get_option('js_gmap_zoom') : '14'); ?>&amp;output=embed&iwloc=near"></iframe>
						</section>
						<!-- END Google Map -->
						
					</section>
				</section><?php
				}
			}
		
		}
		?>
			
	</section>
	<footer>
		<section class="shell">
		
			<p class="bitter">
				<span class="right"><?php
				if (of_get_option('js_footer_text')){
					echo str_replace('[year]',date('Y'),of_get_option('js_footer_text'));
				} else {
					echo 'Copyright &copy;'.date("Y").' Justin Scheetz';
				}
				?></span>
			
				<?php
				$foot_nav = wp_nav_menu( array( 'container' => '', 'echo' => '0', 'theme_location' => 'footer-menu' ) );
	 			$foot_nav2 = preg_replace( array( '#^<ul[^>]*>#', '#</ul>$#' ), '', $foot_nav );
	 			$foot_nav2 = preg_replace( array( '#<li[^>]*>#', '#</li>$#' ), '', $foot_nav2 );
	 			echo $foot_nav2;
	 			?>
			</p>
			
		</section>
	</footer>
	
	<?php if (is_single() || is_page() || is_home()) {
		if (of_get_option('js_hide_social') != true) { ?>
		<section id="share-area">
			<div class="fb-like" data-send="false" data-layout="box_count" data-width="55" data-show-faces="false"></div>
	
			<a href="https://twitter.com/share" class="twitter-share-button" data-lang="en" data-count="vertical">Tweet</a>
			<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
	
			<!-- Place this tag where you want the +1 button to render -->
			<g:plusone size="tall"></g:plusone>
	
			<!-- Place this render call where appropriate -->
			<script type="text/javascript">
			  (function() {
			    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
			    po.src = 'https://apis.google.com/js/plusone.js';
			    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
			  })();
			</script>
		</section>
		<?php }
	} ?>
	
	<?php $template_dir = get_template_directory_uri(); ?>
	
	<!-- jQuery is called via the Wordpress-friendly way via functions.php -->
	
	<script type="text/javascript">
		var auto_cycle = '<?php echo of_get_option('js_homepage_slider_cycle'); ?>';
		var cycle_speed = <?php echo of_get_option('js_homepage_slider_speed') / 1000; ?>;
		var animation_speed = <?php echo of_get_option('js_homepage_slider_transition_speed'); ?>;
		var audio_link = <?php echo (!is_single() ? number_format(of_get_option('js_audio_link')) : 0); ?>;
		var video_link = <?php echo (!is_single() ? number_format(of_get_option('js_video_link')) : 0); ?>;
		var autoPermOff = false;
		var rebirth = "<?php bloginfo('template_url') ?>/js";
		var audioPlayerColor = "<?php echo str_replace('#','',of_get_option('js_highlight_color')); ?>";
	</script>
	<script src="<?php echo $template_dir; ?>/js/prefixfree.min.js" type="text/javascript"></script>
	<script src="<?php echo $template_dir; ?>/js/jquery.colorbox-min.js" type="text/javascript"></script>
	<script src="<?php echo $template_dir; ?>/js/jquery.ui.widget.min.js" type="text/javascript"></script>
	<script src="<?php echo $template_dir; ?>/js/jquery.jcarousel.min.js" type="text/javascript"></script>
	<script src="<?php echo $template_dir; ?>/js/jquery.countdown.min.js" type="text/javascript"></script>
	<?php if (of_get_option('js_countdown_language') && of_get_option('js_countdown_language') != "english"){
		?><script src="<?php echo $template_dir; ?>/js/countdown_languages/<?php echo of_get_option('js_countdown_language'); ?>.js" type="text/javascript"></script><?php
	} ?> 
	<script src="<?php echo $template_dir; ?>/js/AudioPlayerV1.js" type="text/javascript"></script>
	<script src="<?php echo $template_dir; ?>/js/jquery.easing.1.3.js" type="text/javascript"></script>
	<script src="<?php echo $template_dir; ?>/js/jquery.func.js" type="text/javascript"></script>

	<script type="text/javascript">
		page_loaded();
	</script>

	<?php if (is_single() || is_page() || is_home()) { ?>
		<div id="fb-root"></div>
		<script>(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s); js.id = id;
		  js.src = "//connect.facebook.net/en_GB/all.js#xfbml=1";
		  fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));</script>
	<?php } ?>

	<?php wp_footer(); ?>

</body>
</html>