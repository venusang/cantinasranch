<!-- Start of clear fix --><div class="clear"></div>

</div><!-- End of bdywrapper -->

<!-- Start of outer footer wrapper -->
<footer id="outer_footer_wrapper">

	<!-- Start of footer wrapper -->
	<div id="footer_wrapper">

	<!-- Start of footerCantinasRanch -->
	<div id="footerCantinasRanch">
	<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('footer_one') ) : else : ?>		
	<?php endif; ?>

	</div><!-- end of footerCantinasRanch -->


	</div><!-- End of footer wrapper -->

</footer><!-- End of outer footer wrapper -->

<?php 
if ( function_exists( 'get_option_tree' ) ) {
$analytics = get_option_tree( 'vn_google_analytics' );
} ?>     

<?php echo stripslashes($analytics); ?>

</body>
</html>

<?php wp_footer(); ?>