<?php
/**
 * Cherry-projects hooks.
 *
 * @package FrameMe
 */

// Add single widget area
add_filter( 'frameme_widget_area_default_settings', 'frameme_add_cherry_projects_single_widget_area' );

// Customization cherry-project plugin.
add_filter( 'cherry-projects-title-settings', 'frameme_cherry_projects_title_settings' );
add_filter( 'cherry-projects-author-settings', 'frameme_cherry_projects_author_settings' );
add_filter( 'cherry-projects-button-settings', 'frameme_cherry_projects_button_settings' );
add_filter( 'cherry-projects-content-settings', 'frameme_cherry_projects_content_settings' );
add_filter( 'cherry_projects_show_all_text', 'frameme_projects_show_all_text' );
add_filter( 'cherry-projects-prev-button-text', 'frameme_cherry_projects_prev_button_text' );
add_filter( 'cherry-projects-next-button-text', 'frameme_cherry_projects_next_button_text' );
add_filter( 'cherry_projects_data_callbacks', 'frameme_cherry_projects_data_callbacks', 10, 2 );
add_filter( 'cherry_projects_cascading_list_map', 'frameme_cherry_projects_cascading_list_map' );
add_filter( 'cherry-projects-terms-list-settings', 'frameme_modify_cherry_projects_terms_list_settings' );
add_filter( 'cherry-projects-comments-settings', 'frameme_modify_cherry_projects_comments_settings' );
add_filter( 'cherry-projects-details-list-text', 'frameme_modify_cherry_projects_details_text' );

/**
 * Add single widget area.
 */
function frameme_add_cherry_projects_single_widget_area( $areas ) {

	$areas['single-project'] = array(
		'name'           => esc_html__( 'Single Projects Area', 'frameme' ),
		'description'    => esc_html__( 'Display only at single projects pages', 'frameme' ),
		'before_widget'  => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'   => '</aside>',
		'before_title'   => '<h4 class="widget-title title-decoration">',
		'after_title'    => '</h4>',
		'before_wrapper' => '<section id="%1$s" %2$s>',
		'after_wrapper'  => '</section>',
		'is_global'      => true,
	);

	return $areas;
}

/**
 * Customization title settings to cherry-project.
 *
 * @param array $settings Title settings.
 *
 * @return array
 */
function frameme_cherry_projects_title_settings( $settings ) {

	$title_html = ( is_single() ) ? '<h3 %1$s>%4$s</h3>' : '<h6 %1$s><a href="%2$s" %3$s rel="bookmark">%4$s</a></h6>';

	$settings['html']  = $title_html;
	$settings['class'] = 'project-entry-title';

	if ( is_single() ) {
		$settings['length'] = - 1;
	}

	return $settings;
}

/**
 * Customization meta author settings to cherry-project.
 *
 * @param array $settings Author settings.
 *
 * @return array
 */
function frameme_cherry_projects_author_settings( $settings ) {

	$settings['html']   = '<span class="posted-by">%1$s<a href="%2$s" %3$s %4$s rel="author">%5$s%6$s</a></span>';
	$settings['prefix'] = esc_html__( 'by ', 'frameme' );

	return $settings;
}

/**
 * Customization button settings to cherry-project.
 *
 * @param array $settings Button settings.
 *
 * @return array
 */
function frameme_cherry_projects_button_settings( $settings ) {

	$new_settings = array(
		'text'  => esc_html__( 'View Details', 'frameme' ),
		'class' => 'project-more-button btn btn-accent-1',
		'html'  => '<a href="%1$s" %3$s><span class="btn__text">%4$s</span>%5$s</a>',
	);

	$settings = array_merge( $settings, $new_settings );

	return $settings;
}

/**
 * Customization content settings to cherry-project.
 *
 * @param array $settings Content settings.
 *
 * @return array
 */
function frameme_cherry_projects_content_settings( $settings ) {

	$settings['class'] = 'project-entry-content';

	return $settings;
}

/**
 * Customization show all text to cherry-project.
 *
 * @return string
 */
function frameme_projects_show_all_text( $show_all_text ) {
	return esc_html__( 'All', 'frameme' );
}

/**
 * Customization cherry-projects prev button text.
 *
 * @return string
 */
function frameme_cherry_projects_prev_button_text( $prev_text ) {
	return sprintf( '%s %s', '<i class="nc-icon-mini arrows-1_minimal-left"></i>', esc_html( 'PREV', 'frameme' ) );
}

/**
 * Customization cherry-projects next button text.
 *
 * @return string
 */
function frameme_cherry_projects_next_button_text( $next_text ) {

	return sprintf( '%s %s', esc_html( 'NEXT', 'frameme' ), '<i class="nc-icon-mini arrows-1_minimal-right"></i>' );
}
/**
 * Add macroses to cherry-project.
 *
 * @return array
 */
function frameme_cherry_projects_data_callbacks( $data, $atts ) {

	$data['sharebuttons']  = 'frameme_get_single_share_buttons';
	$data['date']          = 'frameme_modify_cherry_projects_get_date';
	$data['content_title'] = 'frameme_get_projects_content_title';

	return $data;
}

/**
 * Customization cherry-projects cascading list map.
 *
 * @return array
 */
function frameme_cherry_projects_cascading_list_map( $cascading_list_map ) {
	return array( 2, 2, 3, 3, 3, 4, 4, 4, 4 );
}

/**
 * Customization cherry-projects date.
 *
 * @return array
 */
function frameme_modify_cherry_projects_get_date( $attr = array() ) {

	$utility      = frameme_utility()->utility;
	$default_attr = array( 'format' => 'F, j Y', 'human_time' => false );

	$attr = wp_parse_args( $attr, $default_attr );

	$settings = array(
		'visible'		=> true,
		'icon'			=> '',
		'prefix'		=> '',
		'html'			=> '%1$s<a href="%2$s" %3$s %4$s ><time datetime="%5$s" title="%5$s">%6$s%7$s</time></a>',
		'title'			=> '',
		'class'			=> 'post-date',
		'date_format'	=> $attr['format'],
		'human_time'	=> filter_var( $attr['human_time'] , FILTER_VALIDATE_BOOLEAN ),
		'echo'			=> false,
	);

	/**
	 * Filter post date settings.
	 *
	 * @since 1.0.0
	 * @var array
	 */
	$settings = apply_filters( 'frameme-cherry-projects-date-settings', $settings );

	if ( is_single() ) {
		$date = $utility->meta_data->get_date( array(
			'html'        => '<div class="post__date post__date-circle"><a href="%2$s" %3$s %4$s ><time datetime="%5$s">',
			'class'       => 'post__date-link',
			'echo'        => false,
		) );

		$date .= $utility->meta_data->get_date( array(
			'date_format' => 'd',
			'html'        => '<span class="post__date-day">%6$s%7$s</span>',
			'class'       => 'post__date-link',
			'echo'        => false,
		) );

		$date .= $utility->meta_data->get_date( array(
			'date_format' => 'M',
			'html'        => '<span class="post__date-month">%6$s%7$s</span>',
			'class'       => 'post__date-link',
			'echo'        => false,
		) );

		$date .= $utility->meta_data->get_date( array(
			'html'        => '</time></a></div>',
			'class'       => 'post__date-link',
			'echo'        => false,
		) );
	} else {
		$date = $utility->meta_data->get_date( $settings );
	}

	return $date;
}

/**
 * Get content title.
 *
 * @return array
 */
function frameme_get_projects_content_title() {
	$format = '<h4>%s</h4>';

	return sprintf( $format, esc_html__( 'PROJECT OVERVIEW', 'frameme' ) );
}

/**
 * @param array $settings
 *
 * @return array
 */
function frameme_modify_cherry_projects_terms_list_settings( $settings = array() ) {

	$settings['before'] = '<span class="post-terms">';
	$settings['after']  = '</span>';
	$settings['prefix'] = esc_html__( 'in ', 'frameme' );

	if ( 'projects_tag' === $settings[ 'type' ] ){
		$settings[ 'prefix' ] = esc_html__( 'Tags: ', 'frameme' );
	}

	return $settings;
}

/**
 * @param array $settings
 *
 * @return array
 */
function frameme_modify_cherry_projects_comments_settings( $settings ) {

	$settings['icon']  = '<i class="nc-icon-mini ui-2_chat-round-content"></i>';
	$settings['class'] = 'post-comments-count post__comments';
	$settings['sufix'] = '%s';

	return $settings;
}

/**
 * @param string $text
 *
 * @return string
 */
function frameme_modify_cherry_projects_details_text( $text ) {

	return esc_html__( 'Details', 'frameme' );
}
