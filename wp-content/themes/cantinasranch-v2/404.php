<?php $path = get_template_directory_uri();
if(!isset($_REQUEST['error']))  $error_code = '404';
else  $error_code = $_REQUEST['error'];
?>

<?php get_header(); ?>

<!-- Start of main section -->
<section id="main_section">
<?php 
if ( function_exists( 'get_option_tree' ) ) {
$notfoundbg = get_option_tree( 'vn_notfoundbg' );
} ?>

<?php if (isset($notfoundbg)) { ?>

<!-- Start of main section bg -->
<div id="main_section_bg">

<img src="<?php echo $notfoundbg; ?>" onerror="this.style.display='none'" />

</div><!-- End of main section bg -->

<!-- Start of clear fix --><div class="clear"></div>

</section><!-- End of main section -->
<?php } ?> 
<!-- Start of main -->
<section id="main">

<!-- Start of left content wrapper -->
<section id="left_content_wrapper">

<!-- Start of left content -->
<div id="left_content">

<p class="page_error"><?php _e( 'Page Not Found', 'gospel' ); ?></p>

<h2><?php _e( 'You earned the 404 page award!', 'gospel' ); ?></h2>

<p><?php _e( 'No worries you probably mistyped something, looked for something that does not exist anymore or just downright broke stuffs - just carry on with the menu at the top!', 'gospel' ); ?></p>

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