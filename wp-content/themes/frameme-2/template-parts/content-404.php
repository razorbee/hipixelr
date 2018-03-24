<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package FrameMe
 */

$btn_style_preset   = get_theme_mod( 'page_404_btn_style_preset', frameme_theme()->customizer->get_default( 'page_404_btn_style_preset' ) );
$text_color         = get_theme_mod( 'page_404_text_color', frameme_theme()->customizer->get_default( 'page_404_text_color' ) );
$additional_class   = ( 'light' === $text_color ) ? 'invert' : 'regular';
$page_404_image_url = '';

?>
<div class="error-404-bg kenburns-top"></div>
<section class="error-404 not-found <?php echo $additional_class; ?>">
	<header class="page-header">
		<h1 class="page-title screen-reader-text"><?php esc_html_e( '404', 'frameme' ); ?></h1>
	</header><!-- .page-header -->

	<div class="page-content">
		<div class="row">
			<div class="col-xs-12 col-md-12">
				<h1 class="title-decoration__bottom title-decoration__big"><?php esc_html_e( 'Page Not Found.', 'frameme' ); ?></h1>
				<p><?php esc_html_e( 'Unfortunately the page you were looking for could not be found.', 'frameme' ); ?></p>
				<p><a class="btn btn-<?php echo sanitize_html_class( $btn_style_preset ); ?>" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Go to home!', 'frameme' ); ?></a></p>
			</div>
		</div>

	</div><!-- .page-content -->
</section><!-- .error-404 -->
