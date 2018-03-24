<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package FrameMe
 */
while ( have_posts() ) : the_post();

	get_template_part( 'template-parts/post/content-single', get_post_format() );

	frameme_post_author_bio();

	get_template_part( 'template-parts/content', 'post-navigation' );

	frameme_related_posts();

	// If comments are open or we have at least one comment, load up the comment template.
	if ( comments_open() || get_comments_number() ) :
		comments_template();
	endif;

endwhile; // End of the loop.
