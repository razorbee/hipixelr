<?php
/**
 * The template for displaying the style-2 footer layout.
 *
 * @package FrameMe
 */
?>

<div <?php frameme_footer_container_class(); ?>>
	<div class="site-info container"><?php
		frameme_footer_logo();
		frameme_footer_menu();
		frameme_contact_block( 'footer' );
		frameme_social_list( 'footer' );
		frameme_footer_copyright();
	?></div><!-- .site-info -->
</div><!-- .container -->
