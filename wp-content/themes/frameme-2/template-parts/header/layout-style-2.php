<?php
/**
 * Template part for style-2 header layout.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package FrameMe
 */

$search_visible        = get_theme_mod( 'header_search', frameme_theme()->customizer->get_default( 'header_search' ) );
?>
<div class="header-container_wrap container">

	<div class="header-row__flex">
		<div class="site-branding">
			<?php frameme_header_logo() ?>
			<?php frameme_site_description(); ?>
		</div>

		<div class="header-row__flex header-components__contact-button"><?php
			frameme_contact_block( 'header' );
			frameme_header_btn();
		?></div>
	</div>

	<div class="header-nav-wrapper">
		<?php frameme_main_menu(); ?>

		<?php if ( $search_visible ) : ?>
			<div class="header-components"><?php
				frameme_header_search_toggle();
			?></div>
		<?php endif; ?>

		<?php frameme_header_search( '<div class="header-search">%s<span class="search-form__close"></span></div>' ); ?>
	</div>

</div>
