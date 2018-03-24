<?php
/**
 * Template part for top panel in header.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package FrameMe
 */

// Don't show top panel if all elements are disabled.
if ( ! frameme_is_top_panel_visible() ) {
	return;
}
?>

<div <?php echo frameme_get_html_attr_class( array( 'top-panel' ), 'top_panel_bg' ); ?>>
	<div class="container">
		<div class="top-panel__container">
			<?php frameme_top_message( '<div class="top-panel__message">%s</div>' ); ?>
			<?php frameme_contact_block( 'header_top_panel' ); ?>

			<div class="top-panel__wrap-items">
				<div class="top-panel__menus">
					<?php frameme_top_menu(); ?>
					<?php frameme_login_link(); ?>
					<?php frameme_social_list( 'header' ); ?>
				</div>
			</div>
		</div>
	</div>
</div><!-- .top-panel -->
