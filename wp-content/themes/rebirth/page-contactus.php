<?php 
/*
Template Name: Contact Page
*/

//If the form is submitted
if(isset($_POST['submitted'])) {

	$name = trim($_POST['contact_name']);
	$email = trim($_POST['contact_email']);
	$subject = trim($_POST['contact_subject']);

	if(function_exists('stripslashes')) {
		$message = stripslashes(trim($_POST['contact_message']));
	} else {
		$message = trim($_POST['contact_message']);
	}

	$emailTo = of_get_option('js_contact_form_email');

	$subject_email = sprintf( __( 'Contact Form Submission from %s', 'rebirth' ), $name );
	
	$body = __( 'Name' , 'rebirth' ) . ": " . $name . "\n\n" . __( 'Email' , 'rebirth' ) . ": " . $email . "\n\n" . __( 'Subject' , 'rebirth' ) . ": " . $subject . "\n\n" . __( 'Message' , 'rebirth' ) . ": " . $message;
	$headers = 'From: '.$email . "\r\n" . 'Reply-To: ' . $email;
	
	/********** SPAM PROTECTION *************/
	$is_spam = false;
	
	//the nr. of seconds that below a form submission is considered too fast, therefore is submitted by a spambot
	$interval_limit = 5;
	
	//we will need this value when we check for form submission time
	$time_now = time();
	
	//check for the timer and the decoy post variables
	$decoy = false; $time = false;
	foreach ($_POST as $key => $value)
	{
		if ( substr($key,0,2) == 'd_' )
		{
			//we have our decoy value
			$decoy = $value;
		}
		
		if ( substr($key,0,2) == 't_' )
		{
			//we have the timer value
			$tmp = explode("_",$key);
			$time = $tmp[2];
			$interval =  ($time_now - (int)$time);
		}	
	}
	
	//check for decoy value
	if ( ($decoy === false) || (!empty($decoy)) ) { $is_spam = true; }
	
	//check for timer
	if ( ($time === false) || ($interval < $interval_limit) ) { $is_spam = true; }
	
	// Check with Akismet, but only if Akismet is installed, activated, and has a KEY. (Recommended for spam control).
    if(function_exists('akismet_http_post') && trim(get_option('wordpress_api_key')) != '' ) {
		global $akismet_api_host, $akismet_api_port;
		$c['user_ip']				= preg_replace( '/[^0-9., ]/', '', $_SERVER['REMOTE_ADDR'] );
		$c['blog']					= home_url();
		$c['comment_author']		= $name;
		$c['comment_author_email'] 	= $email;
		$c['comment_content'] 		= $message;

		$query_string = '';
		foreach ( $c as $key => $data ) {
			if( is_string($data) )
				$query_string .= $key . '=' . urlencode( stripslashes($data) ) . '&';
		}
		
		$response = akismet_http_post($query_string, $akismet_api_host, '/1.1/comment-check', $akismet_api_port);
		
		if ( 'true' == $response[1] ) { // Akismet says it's SPAM
			$is_spam = true;
		}
	}
	
	if( !$is_spam )
		wp_mail( $emailTo, $subject_email, $body, $headers );

} else {

get_header(); ?>
        
    <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
    	
    	<section id="main">
			<article><?php
	
			$hide_contact_map = of_get_option('js_hide_contactmap');
			$featured_caption = get_the_title(get_post_thumbnail_id(get_the_ID()));
			$featured_image = get_the_post_thumbnail($post->ID,'large-full-banner', array('title'=>$featured_caption));
			$g_address = (of_get_option('js_contactblock_address') ? of_get_option('js_contactblock_address') : '1 Infinite Loop\nCupertino, CA');
			$g_address = str_replace( array("\r\n", "\n","\r"), '+', $g_address );
			$g_address = str_replace(' ','+',$g_address);
		
			if ($g_address && !$hide_contact_map){
				
				?><section id="main-image">
					<section class="top"></section>
					<section class="bottom"></section>
					<iframe width="940" height="350" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps?hl=en&amp;geocode=&amp;q=<?php echo str_replace(array('<br />',' '),'+',nl2br($g_address)); ?>&amp;aq=&amp;ie=UTF8&amp;hq=&amp;hnear=<?php echo str_replace(array('<br />',' '),'+',nl2br($g_address)); ?>&amp;t=m&amp;view=map&amp;z=<?php echo (of_get_option('js_gmap_zoom') ? of_get_option('js_gmap_zoom') : '14'); ?>&amp;output=embed&iwloc=near"></iframe>
				</section><?php
				
			} else if ($hide_contact_map && $featured_image){

				?><section id="main-image">
						<section class="top"></section>
						<section class="bottom"></section>
						<?php echo get_the_post_thumbnail($post->ID,'large-full-banner', array('title'=>$featured_caption)); ?>
					</section><?php
				
			} ?>
		
			<?php js_breadcrumbs($post->ID); ?>

			<section id="content" class="full">
				
				<h1 class="bitter"><?php the_title(); ?></h1>
				
				<section class="entry">
					<section class="shadow"></section>
				
					<div class="one_third">
						<p class="success-sending-message"><?php _e('Thank you, your message has been sent!','rebirth'); ?></p>
		                <p class="error-sending-message"><?php _e('All fields are required.','rebirth'); ?></p>
		
		                <div id="contact-form">
		
		                    <form action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>" id="contactForm" class="styled" method="post">
		
	                        	<label for="contact_name"><?php _e( 'Name' , 'rebirth' ) ?></label>
	                            <input type="text" tabindex="3" id="contact_name" name="contact_name" value="<?php if(isset($_POST['contact_name'])) echo $_POST['contact_name'];?>" class="requiredField textbox" />
		
		                        <label for="contact_email"><?php _e( 'Email' , 'rebirth' ) ?></label>
		                        <input type="text" tabindex="4" id="contact_email" name="contact_email" value="<?php if(isset($_POST['contact_email']))  echo $_POST['contact_email'];?>" class="requiredField email textbox" />
		                       
		                       	<label for="contact_subject"><?php _e( 'Subject' , 'rebirth' ) ?></label>
								<input type="text" tabindex="5" id="contact_subject" name="contact_subject" value="<?php if(isset($_POST['contact_subject'])) echo $_POST['contact_subject'];?>" class="requiredField textbox" />
		                            
		         				<label for="contact_message"><?php _e( 'Your Message' , 'rebirth' ) ?></label>
		                       	<div class="textarea-wrap">
		                         	<textarea cols="65" rows="9" tabindex="6" id="contact_message" name="contact_message" class="requiredField"><?php if(isset($_POST['message'])) { if(function_exists('stripslashes')) { echo stripslashes($_POST['message']); } else { echo $_POST['message']; } } ?></textarea>
		                       	</div>
		                    
		                        <?php // Ignore the 2 following fields, they are here to prevent SPAM bots
								$decoy = array('d_name','d_password','d_pw','d_user','d_username','d_comment');
								$timer = array('t_name_','t_pw_','t_username_','t_age_');
		
								$default_1 = $decoy[array_rand($decoy)];
								$default_2 = $timer[array_rand($timer)] .time();                            
		                        ?>
		                        
								<input type="text" name="<?php echo $default_1 ?>" style="display:none; position:absolute; left:9000px; top:9000px;" />
								<input type="text" name="<?php echo $default_2 ?>" style="display:none; position:absoute; left:9999px; top:9999px;" />
		
		                        <div class="form-section">
		                            <button class="button" tabindex="7" type="submit" id="rebirth-submit" name="rebirth-submit"><?php _e( 'Send Message' , 'rebirth' ) ?></button>
		                            <input type="hidden" name="submitted" id="submitted" value="true" />
		                            <span class="sending-message"><img src="<?php echo get_template_directory_uri(); ?>/_theme_styles/images/loading-light.gif" /> <?php _e('Sending...' , 'rebirth' ) ?></span>
		                        </div>
		
		                    </form>
		
		                </div>
					</div>
					
					<div class="two_third last">
						<?php the_content(); ?>
					</div>
					
					<div class="cl"></div>
    
    			</section>
			</section>
			
		</article>
	</section>
        
	<?php endwhile; ?>

<?php get_footer();
} ?>