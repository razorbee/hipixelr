<?php
/**
 * The base template for displaying 404 pages (not found).
 *
 * @package FrameMe
 */
?>
<?php get_header( frameme_template_base() ); ?>

	<?php frameme_site_breadcrumbs(); ?>

	<div <?php frameme_content_wrap_class(); ?>>

		<div class="row">

			<div id="primary" <?php frameme_primary_content_class(); ?>>

				<main id="main" class="site-main" role="main">

					<?php include frameme_template_path(); ?>

				</main><!-- #main -->

			</div><!-- #primary -->

			<?php get_sidebar(); // Loads the sidebar.php. ?>

		</div><!-- .row -->

	</div><!-- .site-content_wrap -->

<?php get_footer( frameme_template_base() ); ?>
