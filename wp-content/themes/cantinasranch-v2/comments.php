<?php
 
// Do not delete these lines
if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
die ('Please do not load this page directly. Thanks!');
 
if ( post_password_required() ) { ?>
<p class="nocomments"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'gospel' ); ?></p>
<?php
return;
}
?>
 
<!-- You can start editing here. -->
<?php if ( have_comments() ) : ?>


<div class="comment_title"><?php comments_number('0', '1', '%' );?> <?php _e( 'comments', 'gospel' ); ?></div>
 
<div class="commentlist"><?php wp_list_comments('type=comment&callback=mytheme_comment'); ?></div>

<?php else : // this is displayed if there are no comments so far ?>
 
<?php if ('open' == $post->comment_status) : ?>
<!-- If comments are open, but there are no comments. -->
 
<?php else : // comments are closed ?>
<!-- If comments are closed. -->
<p class="nocomments"><?php _e( 'Comments are closed.', 'gospel' ); ?></p>
 
<?php endif; ?>
<?php endif; ?>
 
<?php if ('open' == $post->comment_status) : ?>
 
<hr /> 
 
<div id="respond">
<div class="comment_title"><?php comment_form_title( __( 'Leave a Reply', 'Leave a Reply to %s', 'gospel' ) ); ?></div>
 
<div class="cancel-comment-reply">
<small><?php cancel_comment_reply_link(); ?></small>
</div>
 
<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
<p><?php _e( 'You must be', 'gospel' ); ?> <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>"><?php _e( 'logged in', 'gospel' ); ?></a> <?php _e( 'to post a comment.', 'gospel' ); ?></p>
<?php else : ?>

<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
 
<?php if ( $user_ID ) : ?>
 
<p><?php _e( 'Logged in as ', 'gospel' ); ?><a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="Log out of this account"><?php _e( 'Log out ', 'gospel' ); ?></a></p>
 
<?php else : ?>
 
<p><label for="author"><?php _e( 'Name', 'gospel' ); ?> <?php if ($req) echo "(required)"; ?></label><input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" size="22" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> />
</p>
 
<p><label for="email"><?php _e( 'Email (will not be published)', 'gospel' ); ?> <?php if ($req) echo "(required)"; ?></label><input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> />
</p>
 
<p><label for="url"><?php _e( 'Website ', 'gospel' ); ?></label><input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" size="22" tabindex="3" />


</p>
 
<?php endif; ?>
 
<!--<p><small><strong>XHTML:</strong> You can use these tags: <code><?php echo allowed_tags(); ?></code></small></p>-->
 
<p><label><?php _e( 'Your Comment', 'gospel' ); ?> <?php if ($req) echo "(required)"; ?></label><textarea name="comment" id="comment" cols="100%" rows="10" tabindex="4"></textarea></p>
 
<p><input name="submit" type="submit" id="submit" tabindex="5" value="Submit Comment" />
<?php comment_id_fields(); ?>
</p>
<?php do_action('comment_form', $post->ID); ?>
 
</form>
 <!-- Clear fix --><div class="clear"></div>
<?php endif; // If registration required and not logged in ?>
</div>
 
<?php endif; // if you delete this the sky will fall on your head ?>