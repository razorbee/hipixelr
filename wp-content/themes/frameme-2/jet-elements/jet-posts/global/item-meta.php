<?php
/**
 * Loop item meta
 */

if ( 'yes' !== $this->get_attr( 'show_meta' ) ) {
	return;
}

echo '<div class="entry-meta">';

if ( 'yes' == $this->get_attr( 'show_date' ) ) {
    jet_elements()->utility()->meta_data->get_date( array(
        'html'        => '<div class="post__date"><a href="%2$s" %3$s %4$s ><time datetime="%5$s">',
        'class'       => 'post__date-link',
        'echo'        => true,
    ) );

    jet_elements()->utility()->meta_data->get_date( array(
        'date_format' => 'F',
        'html'        => '<span class="post__date-month">%6$s%7$s</span>',
        'class'       => 'post__date-link',
        'echo'        => true,
    ) );

    jet_elements()->utility()->meta_data->get_date( array(
        'date_format' => 'd',
        'html'        => '<span class="post__date-day">%6$s%7$s</span>',
        'class'       => 'post__date-link',
        'echo'        => true,
    ) );

    jet_elements()->utility()->meta_data->get_date( array(
        'date_format' => 'Y',
        'html'        => '<span class="post__date-year">%6$s%7$s</span>',
        'class'       => 'post__date-year',
        'echo'        => true,
    ) );

    jet_elements()->utility()->meta_data->get_date( array(
        'html'        => '</time></a></div>',
        'class'       => 'post__date-link',
        'echo'        => true,
    ) );
}

	jet_elements()->utility()->meta_data->get_author( array(
        'visible' => $this->get_attr( 'show_author' ),
		'class'   => 'posted-by__author',
		'prefix'  => esc_html__( 'By ', 'frameme' ),
		'html'    => '<span class="posted-by">%1$s<a href="%2$s" %3$s %4$s rel="author">%5$s%6$s</a></span>',
		'echo'    => true,
	) );

	jet_elements()->utility()->meta_data->get_terms( array(
		'type'      => 'category',
		'delimiter' => ', ',
		'before'    => '<span class="post__cats">',
		'after'     => '</span>',
		'echo'      => true,
	) );
    jet_elements()->utility()->meta_data->get_comment_count( array(
        'visible' => $this->get_attr( 'show_comments' ),
        'class'   => 'post__comments-link',
        'icon'    => '',
        'prefix'  => esc_html__( 'Comments: ', 'jet-elements' ),
        'html'    => '<span class="post__comments post-meta__item">%1$s<a href="%2$s" %3$s %4$s>%5$s%6$s</a></span>',
        'echo'    => true,
    ) );

echo '</div>';
