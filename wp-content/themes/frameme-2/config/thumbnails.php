<?php
/**
 * Thumbnails configuration.
 *
 * @package FrameMe
 */

add_action( 'after_setup_theme', 'frameme_register_image_sizes', 5 );
/**
 * Register image sizes.
 */
function frameme_register_image_sizes() {
	set_post_thumbnail_size( 360, 203, true );

	// Registers a new image sizes.
	add_image_size( 'frameme-thumb-s', 150, 150, true );
	add_image_size( 'frameme-thumb-m', 460, 460, true );
	add_image_size( 'frameme-thumb-l', 660, 371, true );
	add_image_size( 'frameme-thumb-l-2', 766, 203, true );
	add_image_size( 'frameme-thumb-xl', 1160, 508, true );

	add_image_size( 'frameme-thumb-masonry', 900, 9999, true);

	add_image_size( 'frameme-slider-thumb', 150, 86, true );
	
	add_image_size( 'frameme-thumb-78-78', 78, 78, true );
	add_image_size( 'frameme-thumb-260-147', 260, 147, true );
	add_image_size( 'frameme-thumb-260-195', 260, 195, true );
	add_image_size( 'frameme-thumb-260-260', 260, 260, true );
	add_image_size( 'frameme-thumb-services', 317, 619, true );
    add_image_size( 'frameme-thumb-360-360', 360, 360, true );
	add_image_size( 'frameme-thumb-360-270', 360, 270, true );
	add_image_size( 'frameme-thumb-370-205', 370, 205, true );
    add_image_size( 'frameme-thumb-370-255', 370, 255, true );
    add_image_size( 'frameme-thumb-370-279', 370, 279, true );
	add_image_size( 'frameme-thumb-480-271', 480, 271, true );
	add_image_size( 'frameme-thumb-480-360', 480, 360, true );
	add_image_size( 'frameme-thumb-560-315', 560, 315, true );
	add_image_size( 'frameme-thumb-660-495', 660, 495, true );
	add_image_size( 'frameme-thumb-760-571', 760, 571, true );
}
