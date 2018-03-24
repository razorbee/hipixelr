<?php
/**
 * Menus configuration.
 *
 * @package FrameMe
 */

add_action( 'after_setup_theme', 'frameme_register_menus', 5 );
/**
 * Register menus.
 */
function frameme_register_menus() {

	register_nav_menus( array(
		'top'          => esc_html__( 'Top', 'frameme' ),
		'main'         => esc_html__( 'Main', 'frameme' ),
		'main_landing' => esc_html__( 'Landing Main', 'frameme' ),
		'footer'       => esc_html__( 'Footer', 'frameme' ),
		'social'       => esc_html__( 'Social', 'frameme' ),
	) );
}
