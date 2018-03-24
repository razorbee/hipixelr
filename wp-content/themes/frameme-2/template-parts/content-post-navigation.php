<?php
/**
 * Template part for single post navigation.
 *
 * @package FrameMe
 */

if ( ! get_theme_mod( 'single_post_navigation', frameme_theme()->customizer->get_default( 'single_post_navigation' ) ) ) {
	return;
}

the_post_navigation( array(
	'prev_text' => esc_html__( 'Prev Post', 'frameme' ),
	'next_text' => esc_html__( 'Next Post', 'frameme' ),
) );
