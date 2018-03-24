<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package FrameMe
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-113346788-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-113346788-1');
</script>


<meta name="google-site-verification" content="aiGH9G7qEqQy7ggF2UQpmOvXgyeCdXjPIzvOonDVROs" />
<meta charset="<?php bloginfo( 'charset' ); ?>">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php frameme_get_page_preloader(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'frameme' ); ?></a>
	<header id="masthead" <?php frameme_header_class(); ?> role="banner">
		<?php frameme_ads_header() ?>
		<?php get_template_part( 'template-parts/header/mobile-panel' ); ?>
		<?php get_template_part( 'template-parts/header/top-panel', get_theme_mod( 'header_layout_type', frameme_theme()->customizer->get_default( 'header_layout_type' ) ) ); ?>

		<div <?php frameme_header_container_class(); ?>>
			<?php get_template_part( 'template-parts/header/layout', get_theme_mod( 'header_layout_type', frameme_theme()->customizer->get_default( 'header_layout_type' ) ) ); ?>
		</div><!-- .header-container -->
	</header><!-- #masthead -->

	<div id="content" <?php frameme_content_class(); ?>>
