<?php
/**
 * Template part for style-3 header layout.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package FrameMe
 */

$vertical_menu_slide             = ( ! is_rtl() ) ? 'right' : 'left';
$header_contact_block_visibility = get_theme_mod( 'header_contact_block_visibility', frameme_theme()->customizer->get_default( 'header_contact_block_visibility' ) );
$header_btn_visibility           = get_theme_mod( 'header_btn_visibility', frameme_theme()->customizer->get_default( 'header_btn_visibility' ) );
$search_visible                  = get_theme_mod( 'header_search', frameme_theme()->customizer->get_default( 'header_search' ) );

?>
<div class="header-container_wrap container">
	<?php frameme_vertical_main_menu( $vertical_menu_slide ); ?>

	<?php if ( $header_contact_block_visibility || $header_btn_visibility ) : ?>
		<div class="header-row__flex header-components__contact-button header-components__grid-elements"><?php
			frameme_contact_block( 'header' );
			frameme_header_btn();
		?></div>
	<?php endif; ?>

	<div class="header-container__flex-wrap">
		<div class="header-container__flex">
			<div class="site-branding">
				<?php frameme_header_logo() ?>
				<?php frameme_site_description(); ?>
			</div>

			<div class="header-components"><?php
				frameme_header_search_toggle();
				frameme_vertical_menu_toggle( 'main-menu' );
			?></div>
		</div>

		<?php frameme_header_search( '<div class="header-search">%s<span class="search-form__close"></span></div>' ); ?>
	</div>
</div>
