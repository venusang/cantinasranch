<div id="comments-block">
	
	<div class="post light">
		<?php $show_comments = true;
		$disable_page_comments = (of_get_option('js_disable_page_comments') == 'yes' ? true : false);
		$disable_post_comments = (of_get_option('js_disable_post_comments') == 'yes' ? true : false);
		$disable_gallery_comments = (of_get_option('js_disable_gallery_comments') == 'yes' ? true : false);
		$disable_event_comments = (of_get_option('js_disable_event_comments') == 'yes' ? true : false);
		$disable_video_comments = (of_get_option('js_disable_video_comments') == 'yes' ? true : false);
		$disable_audio_comments = (of_get_option('js_disable_audio_comments') == 'yes' ? true : false);
		
		if (is_single() && $disable_post_comments && 'post' == get_post_type() || is_page() && $disable_page_comments || 'gallery-items' == get_post_type() && $disable_gallery_comments || 'event-items' == get_post_type() && $disable_event_comments || 'video-items' == get_post_type() && $disable_video_comments || 'audio-items' == get_post_type() && $disable_audio_comments) {
			$show_comments = false;
		}
		
		// If $show_comments
		if ($show_comments){
		
			if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
				die (__('Please do not load this page directly. Thanks!','rebirth'));
			
			if ( post_password_required() ) { ?>
				<?php _e('This post is password protected. Enter the password to view comments.','rebirth'); ?>
			<?php
				return;
			}
			
			if ( have_comments() ) : ?>
			
				<section class="shadow"></section>
				
				<h2 id="comments" class="dotted-line-title"><span><?php comments_number(__('No Responses','rebirth'), __('One Response','rebirth'), '% '.__('Responses','rebirth'));?></span></h2>
			
				<div class="navigation">
					<div class="next-posts"><?php previous_comments_link() ?></div>
					<div class="prev-posts"><?php next_comments_link() ?></div>
				</div>
			
				<ol class="commentlist">
					<?php wp_list_comments(); ?>
				</ol>
			
				<div class="navigation">
					<div class="next-posts"><?php previous_comments_link() ?></div>
					<div class="prev-posts"><?php next_comments_link() ?></div>
				</div>
				
			 <?php else : // this is displayed if there are no comments so far ?>
			
				<?php if ( comments_open() ) : ?>
					<!-- If comments are open, but there are no comments. -->
			
				 <?php else : // comments are closed ?>
					<p class="closed-comments"><?php _e('Comments are closed.','rebirth'); ?></p>
			
				<?php endif; ?>
				
			<?php endif; ?>
			
			<?php if ( comments_open() ) : ?>
			
				<section class="shadow"></section>
				
				<h2 id="comments" class="dotted-line-title"><span><?php comment_form_title( __('Leave a Reply','rebirth'), __('Leave a Reply to','rebirth').' %s' ); ?></span></h2>
					<?php
					
				$comment_field = '<div class="textarea_wrap"><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></div>';
				comment_form(array('comment_field'=>$comment_field));
				
			endif;
			
		} // End if $show_comments ?>
	</div>

</div>