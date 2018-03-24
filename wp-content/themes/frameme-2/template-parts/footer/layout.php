<?php
/**
 * The template for displaying the default footer layout.
 *
 * @package FrameMe
 */

$footer_logo_visibility    = get_theme_mod( 'footer_logo_visibility', frameme_theme()->customizer->get_default( 'footer_logo_visibility' ) );
$footer_menu_visibility    = get_theme_mod( 'footer_menu_visibility', frameme_theme()->customizer->get_default( 'footer_menu_visibility' ) );
?>

<div <?php frameme_footer_container_class(); ?>>

	<?php if ( $footer_logo_visibility || $footer_menu_visibility ) { ?>
		<div class="site-info container site-info-first-row">
			<div class="site-info-wrap">
				<div class="site-info-block"><?php
					frameme_footer_logo();
				?></div>
				<?php frameme_footer_menu(); ?>
			</div>
		</div><!-- .site-info-first-row -->
	<?php } ?>

	<div class="site-info container site-info-second-row">
		<div class="site-info-wrap">
			<div class="site-info-block"><?php
				frameme_footer_copyright();
				frameme_contact_block( 'footer' );
			?></div>
			<?php frameme_social_list( 'footer' ); ?>
		</div>
	</div><!-- .site-info-second-row -->

</div><!-- .container -->
