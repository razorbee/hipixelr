<?php
/**
 * Cherry-services-list hooks.
 *
 * @package FrameMe
 */

// Add single widget area
add_filter( 'frameme_widget_area_default_settings', 'frameme_add_cherry_services_single_widget_area' );

// Customization cherry-services-list plugin.
add_filter( 'cherry_services_list_meta_options_args', 'frameme_modify_services_list_meta_options' );
add_filter( 'cherry_services_default_icon_format', 'frameme_cherry_services_default_icon_format' );
add_filter( 'cherry_services_listing_templates_list', 'frameme_cherry_services_listing_templates_list' );
add_filter( 'cherry_services_features_title_format', 'frameme_cherry_services_features_title_format' );
add_filter( 'cherry_services_styles', 'frameme_dequeue_cherry_services_grid_style' );
add_filter( 'cherry_services_cta_link_format', 'frameme_cherry_services_cta_link_format' );
add_filter( 'cherry_services_cta_submit_format', 'frameme_cherry_services_cta_submit_format' );
add_filter( 'cherry_services_shortcode_heading_format', 'frameme_modify_cherry_services_shortcode_heading_format' );

add_filter( 'cherry_services_data_callbacks', 'frameme_cherry_services_data_callbacks', 12, 2 );

/**
 * Add single widget area.
 */
function frameme_add_cherry_services_single_widget_area( $areas ) {

	$areas['single-service'] = array(
		'name'           => esc_html__( 'Single Services Area', 'frameme' ),
		'description'    => esc_html__( 'Display only at single services pages', 'frameme' ),
		'before_widget'  => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'   => '</aside>',
		'before_title'   => '<h5 class="widget-title title-decoration">',
		'after_title'    => '</h5>',
		'before_wrapper' => '<section id="%1$s" %2$s>',
		'after_wrapper'  => '</section>',
		'is_global'      => true,
	);

	return $areas;
}

/**
 * Modify cherry-services-list meta options.
 */
function frameme_modify_services_list_meta_options( $fields ) {

	// Change icon data.
	$fields['fields']['cherry-services-icon']['icon_data'] = frameme_get_nc_outline_icons_data();

	// Add `Button style presets` option.
	$fields['fields']['cherry-services-cta-btn-style-presets'] = array(
		'type'              => 'select',
		'element'           => 'control',
		'parent'            => 'styling',
		'value'             => 'accent-2',
		'options'           => frameme_get_btn_style_presets(),
		'label'             => esc_html__( 'Call to action button style preset', 'frameme' ),
		'sanitize_callback' => 'esc_attr',
	);

	return $fields;
}

/**
 * Change cherry-services-list icon format
 *
 * @return string
 */
function frameme_cherry_services_default_icon_format( $icon_format ) {
	return '<i class="nc-icon-outline %s"></i>';
}

/**
 *  Add template to cherry services-list templates list;
 */
function frameme_cherry_services_listing_templates_list( $tmpl_list ) {

	$tmpl_list['default-icon']            = 'default-icon.tmpl';
	$tmpl_list['default-description']     = 'default-description.tmpl';
	$tmpl_list['media-icon']              = 'media-icon.tmpl';
	$tmpl_list['media-icon-background']   = 'media-icon-bg.tmpl';
	$tmpl_list['media-icon-background-2'] = 'media-icon-bg-2.tmpl';
	$tmpl_list['sidebar-media-icon']      = 'sidebar-media-icon.tmpl';

	return $tmpl_list;
}

/**
 * Change cherry-services features title format.
 */
function frameme_cherry_services_features_title_format( $title_format ) {
	return '<h4 class="service-features_title">%s</h4>';
}

/**
 * Dequeue cherry-services grid style.
 *
 * @param array $styles Cherry services list styles.
 *
 * @return array
 */
function frameme_dequeue_cherry_services_grid_style ( $styles = array() ) {

	unset( $styles['cherry-services-grid'] );

	return $styles;
}

/**
 * Modify cta link format.
 *
 * @param string $link_format Default cta link format.
 *
 * @return string
 */
function frameme_cherry_services_cta_link_format( $link_format ) {

	global $post;
	$btn_preset       = get_post_meta( $post->ID, 'cherry-services-cta-btn-style-presets', true );
	$additional_class = $btn_preset ? sprintf( 'btn-%s', sanitize_html_class( $btn_preset ) ) : '';

	$link_format = '<div class="cta-button-wrap"><a href="%s" class="cta-button btn ' . $additional_class . '">%s</a></div>';

	return $link_format;
}

/**
 * Modify cta submit button format.
 *
 * @param string $submit_format Default submit format.
 *
 * @return string
 */
function frameme_cherry_services_cta_submit_format( $submit_format ) {
	global $post;
	$btn_preset       = get_post_meta( $post->ID, 'cherry-services-cta-btn-style-presets', true );
	$additional_class = $btn_preset ? sprintf( 'btn-%s', sanitize_html_class( $btn_preset ) ) : '';

	$submit_format = '<button type="submit" class="cta-form_submit btn ' . $additional_class . '">%s</button>';

	return $submit_format;
}

/**
 * Modify heading format.
 *
 * @param array $heading_format Default heading format.
 *
 * @return array
 */
function frameme_modify_cherry_services_shortcode_heading_format( $heading_format = array() ) {

	$heading_format['super_title'] = '<h6 class="services-heading_super_title">%s</h6>';
	$heading_format['subtitle']    = '<h5 class="services-heading_subtitle">%s</h5>';

	return $heading_format;
}

/**
 * Add new macros function.
 *
 * @return array
 */
function frameme_cherry_services_data_callbacks( $data, $atts ) {
	$data['content_title'] = 'frameme_services_content_title';
	$data['categories']    = 'frameme_services_display_categories';

	return $data;
}

function frameme_services_content_title( $args = array() ) {
	$args = wp_parse_args( $args, array(
		'tag'   => 'h3',
		'title' => esc_html__( 'SERVICE OVERVIEW', 'frameme' ),
	) );

	$format = '<%1$s class="services-content-title">%2$s</%1$s>';

	return sprintf( $format, $args['tag'], wp_kses_post( $args['title'] ) );
}

function frameme_services_display_categories( $args = array() ) {
	$utility = frameme_utility()->utility;

	$categories = $utility->meta_data->get_terms( array(
		'visible'   => true,
		'type'      => 'cherry-services_category',
		'delimiter' => ' | ',
		'prefix'    => '',
		'before'    => '<div class="services__cats">',
		'after'     => '</div>',
		'echo'      => false,
	) );

	return $categories;
}
