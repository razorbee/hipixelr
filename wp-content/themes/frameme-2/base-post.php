<?php
/**
 * The base template.
 *
 * @package FrameMe
 */
?>
<?php get_header( frameme_template_base() ); ?>

	<?php frameme_site_breadcrumbs(); ?>

	<?php frameme_single_post_full_width_section(); ?>

	<?php do_action( 'frameme_render_widget_area', 'full-width-header-area' ); ?>

	<div <?php frameme_content_wrap_class(); ?>>

		<?php do_action( 'frameme_render_widget_area', 'before-content-area' ); ?>

		<div class="row">

			<div id="primary" <?php frameme_primary_content_class(); ?>>

				<?php do_action( 'frameme_render_widget_area', 'before-loop-area' ); ?>

				<main id="main" class="site-main" role="main">

					<?php include frameme_template_path(); ?>

				</main><!-- #main -->

				<?php do_action( 'frameme_render_widget_area', 'after-loop-area' ); ?>

			</div><!-- #primary -->

			<?php get_sidebar(); // Loads the sidebar.php. ?>

		</div><!-- .row -->

		<?php do_action( 'frameme_render_widget_area', 'after-content-area' ); ?>

	</div><!-- .site-content_wrap -->

	<?php do_action( 'frameme_render_widget_area', 'after-content-full-width-area' ); ?>

<?php get_footer( frameme_template_base() ); ?>
