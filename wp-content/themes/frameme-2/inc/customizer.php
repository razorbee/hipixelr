<?php
/**
 * Theme Customizer.
 *
 * @package FrameMe
 */

/**
 * Retrieve a holder for Customizer options.
 *
 * @since  1.0.0
 * @return array
 */
function frameme_get_customizer_options() {
	/**
	 * Filter a holder for Customizer options (for theme/plugin developer customization).
	 *
	 * @since 1.0.0
	 */
	return apply_filters( 'frameme_get_customizer_options' , array(
		'prefix'     => 'frameme',
		'capability' => 'edit_theme_options',
		'type'       => 'theme_mod',
		'options'    => array(

			'show_tagline' => array(
				'title'    => esc_html__( 'Show tagline after logo', 'frameme' ),
				'section'  => 'title_tagline',
				'priority' => 60,
				'default'  => false,
				'field'    => 'checkbox',
				'type'     => 'control',
			),
			'totop_visibility' => array(
				'title'    => esc_html__( 'Show ToTop button', 'frameme' ),
				'section'  => 'title_tagline',
				'priority' => 61,
				'default'  => true,
				'field'    => 'checkbox',
				'type'     => 'control',
			),
			'page_preloader' => array(
				'title'    => esc_html__( 'Show page preloader', 'frameme' ),
				'section'  => 'title_tagline',
				'priority' => 62,
				'default'  => true,
				'field'    => 'checkbox',
				'type'     => 'control',
			),

			/** `General Site settings` panel */
			'general_settings' => array(
				'title'    => esc_html__( 'General Site settings', 'frameme' ),
				'priority' => 40,
				'type'     => 'panel',
			),

			/** `Logo & Favicon` section */
			'logo_favicon' => array(
				'title'    => esc_html__( 'Logo &amp; Favicon', 'frameme' ),
				'priority' => 25,
				'panel'    => 'general_settings',
				'type'     => 'section',
			),
			'header_logo_type' => array(
				'title'   => esc_html__( 'Logo Type', 'frameme' ),
				'section' => 'logo_favicon',
				'default' => 'image',
				'field'   => 'radio',
				'choices' => array(
					'image' => esc_html__( 'Image', 'frameme' ),
					'text'  => esc_html__( 'Text', 'frameme' ),
				),
				'type' => 'control',
			),
			'header_logo_url' => array(
				'title'           => esc_html__( 'Logo Upload', 'frameme' ),
				'description'     => esc_html__( 'Upload logo image', 'frameme' ),
				'section'         => 'logo_favicon',
				'default'         => '%s/assets/images/logo.png',
				'field'           => 'image',
				'type'            => 'control',
				'active_callback' => 'frameme_is_header_logo_image',
			),
			'invert_header_logo_url' => array(
				'title'           => esc_html__( 'Invert Logo Upload', 'frameme' ),
				'description'     => esc_html__( 'Upload logo image', 'frameme' ),
				'section'         => 'logo_favicon',
				'default'         => '%s/assets/images/invert-logo.png',
				'field'           => 'image',
				'type'            => 'control',
				'active_callback' => 'frameme_is_header_logo_image',
			),
			'retina_header_logo_url' => array(
				'title'           => esc_html__( 'Retina Logo Upload', 'frameme' ),
				'description'     => esc_html__( 'Upload logo for retina-ready devices', 'frameme' ),
				'section'         => 'logo_favicon',
				'field'           => 'image',
				'type'            => 'control',
				'active_callback' => 'frameme_is_header_logo_image',
			),
			'invert_retina_header_logo_url' => array(
				'title'           => esc_html__( 'Invert Retina Logo Upload', 'frameme' ),
				'description'     => esc_html__( 'Upload logo for retina-ready devices', 'frameme' ),
				'section'         => 'logo_favicon',
				'default'         => false,
				'field'           => 'image',
				'type'            => 'control',
				'active_callback' => 'frameme_is_header_logo_image',
			),
			'header_logo_font_family' => array(
				'title'           => esc_html__( 'Font Family', 'frameme' ),
				'section'         => 'logo_favicon',
				'default'         => 'Montserrat, sans-serif',
				'field'           => 'fonts',
				'type'            => 'control',
				'active_callback' => 'frameme_is_header_logo_text',
			),
			'header_logo_font_style' => array(
				'title'           => esc_html__( 'Font Style', 'frameme' ),
				'section'         => 'logo_favicon',
				'default'         => 'normal',
				'field'           => 'select',
				'choices'         => frameme_get_font_styles(),
				'type'            => 'control',
				'active_callback' => 'frameme_is_header_logo_text',
			),
			'header_logo_font_weight' => array(
				'title'           => esc_html__( 'Font Weight', 'frameme' ),
				'section'         => 'logo_favicon',
				'default'         => '600',
				'field'           => 'select',
				'choices'         => frameme_get_font_weight(),
				'type'            => 'control',
				'active_callback' => 'frameme_is_header_logo_text',
			),
			'header_logo_font_size' => array(
				'title'           => esc_html__( 'Font Size, px', 'frameme' ),
				'section'         => 'logo_favicon',
				'default'         => '24',
				'field'           => 'number',
				'input_attrs'     => array(
					'min'  => 6,
					'max'  => 50,
					'step' => 1,
				),
				'type'            => 'control',
				'active_callback' => 'frameme_is_header_logo_text',
			),
			'header_logo_character_set' => array(
				'title'           => esc_html__( 'Character Set', 'frameme' ),
				'section'         => 'logo_favicon',
				'default'         => 'latin',
				'field'           => 'select',
				'choices'         => frameme_get_character_sets(),
				'type'            => 'control',
				'active_callback' => 'frameme_is_header_logo_text',
			),

			/** `Breadcrumbs` section */
			'breadcrumbs' => array(
				'title'    => esc_html__( 'Breadcrumbs', 'frameme' ),
				'priority' => 30,
				'type'     => 'section',
				'panel'    => 'general_settings',
			),
			'breadcrumbs_visibillity' => array(
				'title'   => esc_html__( 'Enable Breadcrumbs', 'frameme' ),
				'section' => 'breadcrumbs',
				'default' => false,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'breadcrumbs_front_visibillity' => array(
				'title'   => esc_html__( 'Enable Breadcrumbs on front page', 'frameme' ),
				'section' => 'breadcrumbs',
				'default' => false,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'breadcrumbs_page_title' => array(
				'title'   => esc_html__( 'Enable page title in breadcrumbs area', 'frameme' ),
				'section' => 'breadcrumbs',
				'default' => true,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'breadcrumbs_path_type' => array(
				'title'   => esc_html__( 'Show full/minified path', 'frameme' ),
				'section' => 'breadcrumbs',
				'default' => 'minified',
				'field'   => 'select',
				'choices' => array(
					'full'     => esc_html__( 'Full', 'frameme' ),
					'minified' => esc_html__( 'Minified', 'frameme' ),
				),
				'type'    => 'control',
			),
			'breadcrumbs_bg_color' => array(
				'title'   => esc_html__( 'Breadcrumbs background color', 'frameme' ),
				'section' => 'breadcrumbs',
				'default' => '#f6f6f6',
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'breadcrumbs_bg_image' => array(
				'title'   => esc_html__( 'Background Image', 'frameme' ),
				'section' => 'breadcrumbs',
				'field'   => 'image',
				'default' => '%s/assets/images/texture.png',
				'type'    => 'control',
			),
			'breadcrumbs_bg_repeat' => array(
				'title'   => esc_html__( 'Background Repeat', 'frameme' ),
				'section' => 'breadcrumbs',
				'default' => 'repeat',
				'field'   => 'select',
				'choices' => frameme_get_bg_repeat(),
				'type'    => 'control',
			),
			'breadcrumbs_bg_position' => array(
				'title'   => esc_html__( 'Background Position', 'frameme' ),
				'section' => 'breadcrumbs',
				'default' => 'center',
				'field'   => 'select',
				'choices' => frameme_get_bg_position(),
				'type'    => 'control',
			),
			'h1' => array(
				'title'   => esc_html__( 'Background Size', 'frameme' ),
				'section' => 'breadcrumbs',
				'default' => 'cover',
				'field'   => 'select',
				'choices' => frameme_get_bg_size(),
				'type'    => 'control',
			),
			'breadcrumbs_bg_attachment' => array(
				'title'   => esc_html__( 'Background Attachment', 'frameme' ),
				'section' => 'breadcrumbs',
				'default' => 'scroll',
				'field'   => 'select',
				'choices' => frameme_get_bg_attachment(),
				'type'    => 'control',
			),
			'breadcrumbs_bg_image_opacity' => array(
				'title'       => esc_html__( 'Background image opacity', 'frameme' ),
				'section'     => 'breadcrumbs',
				'default'     => 1,
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => 0,
					'max'  => 1,
					'step' => 0.01,
				),
				'type' => 'control',
			),

			/** `Social links` section */
			'social_links' => array(
				'title'    => esc_html__( 'Social links', 'frameme' ),
				'priority' => 50,
				'type'     => 'section',
				'panel'    => 'general_settings',
			),
			'header_social_links' => array(
				'title'   => esc_html__( 'Show social links in header', 'frameme' ),
				'section' => 'social_links',
				'default' => true,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'footer_social_links' => array(
				'title'   => esc_html__( 'Show social links in footer', 'frameme' ),
				'section' => 'social_links',
				'default' => true,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'blog_post_share_buttons' => array(
				'title'   => esc_html__( 'Show social sharing to blog posts', 'frameme' ),
				'section' => 'social_links',
				'default' => true,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'single_post_share_buttons' => array(
				'title'   => esc_html__( 'Show social sharing to single blog post', 'frameme' ),
				'section' => 'social_links',
				'default' => true,
				'field'   => 'checkbox',
				'type'    => 'control',
			),

			/** `Page Layout` section */
			'page_layout' => array(
				'title'    => esc_html__( 'Page Layout', 'frameme' ),
				'priority' => 55,
				'type'     => 'section',
				'panel'    => 'general_settings',
			),
			'header_container_type' => array(
				'title'   => esc_html__( 'Header type', 'frameme' ),
				'section' => 'page_layout',
				'default' => 'fullwidth',
				'field'   => 'select',
				'choices' => array(
					'boxed'     => esc_html__( 'Boxed', 'frameme' ),
					'fullwidth' => esc_html__( 'Fullwidth', 'frameme' ),
				),
				'type' => 'control',
			),
			'content_container_type' => array(
				'title'   => esc_html__( 'Content type', 'frameme' ),
				'section' => 'page_layout',
				'default' => 'boxed',
				'field'   => 'select',
				'choices' => array(
					'boxed'     => esc_html__( 'Boxed', 'frameme' ),
					'fullwidth' => esc_html__( 'Fullwidth', 'frameme' ),
				),
				'type' => 'control',
			),
			'footer_container_type' => array(
				'title'   => esc_html__( 'Footer type', 'frameme' ),
				'section' => 'page_layout',
				'default' => 'fullwidth',
				'field'   => 'select',
				'choices' => array(
					'boxed'     => esc_html__( 'Boxed', 'frameme' ),
					'fullwidth' => esc_html__( 'Fullwidth', 'frameme' ),
				),
				'type' => 'control',
			),
			'container_width' => array(
				'title'       => esc_html__( 'Container width (px)', 'frameme' ),
				'section'     => 'page_layout',
				'default'     => 1200,
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => 960,
					'max'  => 1920,
					'step' => 1,
				),
				'type' => 'control',
			),
			'sidebar_width' => array(
				'title'   => esc_html__( 'Sidebar width', 'frameme' ),
				'section' => 'page_layout',
				'default' => '1/3',
				'field'   => 'select',
				'choices' => array(
					'1/3' => '1/3',
					'1/4' => '1/4',
				),
				'sanitize_callback' => 'sanitize_text_field',
				'type'              => 'control',
			),

			/** `Color Scheme` panel */
			'color_scheme' => array(
				'title'       => esc_html__( 'Color Scheme', 'frameme' ),
				'description' => esc_html__( 'Configure Color Scheme', 'frameme' ),
				'priority'    => 40,
				'type'        => 'panel',
			),

			/** `Regular scheme` section */
			'regular_scheme' => array(
				'title'       => esc_html__( 'Regular scheme', 'frameme' ),
				'priority'    => 10,
				'panel'       => 'color_scheme',
				'type'        => 'section',
			),
			'regular_accent_color_1' => array(
				'title'   => esc_html__( 'Accent color (1)', 'frameme' ),
				'section' => 'regular_scheme',
				'default' => '#bda27f   ',
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'regular_accent_color_2' => array(
				'title'   => esc_html__( 'Accent color (2)', 'frameme' ),
				'section' => 'regular_scheme',
				'default' => '#c4ab8c',
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'regular_accent_color_3' => array(
				'title'   => esc_html__( 'Accent color (3)', 'frameme' ),
				'section' => 'regular_scheme',
				'default' => '#f1ede8',
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'regular_accent_color_4' => array(
				'title'   => esc_html__( 'Accent color (4)', 'frameme' ),
				'section' => 'regular_scheme',
				'default' => '#94929b',
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'regular_text_color' => array(
				'title'   => esc_html__( 'Text color', 'frameme' ),
				'section' => 'regular_scheme',
				'default' => '#828282',
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'regular_link_color' => array(
				'title'   => esc_html__( 'Link color', 'frameme' ),
				'section' => 'regular_scheme',
				'default' => '#bda27f',
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'regular_link_hover_color' => array(
				'title'   => esc_html__( 'Link hover color', 'frameme' ),
				'section' => 'regular_scheme',
				'default' => '#828282',
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'regular_h1_color' => array(
				'title'   => esc_html__( 'H1 color', 'frameme' ),
				'section' => 'regular_scheme',
				'default' => '#000000',
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'regular_h2_color' => array(
				'title'   => esc_html__( 'H2 color', 'frameme' ),
				'section' => 'regular_scheme',
				'default' => '#000000',
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'regular_h3_color' => array(
				'title'   => esc_html__( 'H3 color', 'frameme' ),
				'section' => 'regular_scheme',
				'default' => '#000000',
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'regular_h4_color' => array(
				'title'   => esc_html__( 'H4 color', 'frameme' ),
				'section' => 'regular_scheme',
				'default' => '#000000',
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'regular_h5_color' => array(
				'title'   => esc_html__( 'H5 color', 'frameme' ),
				'section' => 'regular_scheme',
				'default' => '#000000',
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'regular_h6_color' => array(
				'title'   => esc_html__( 'H6 color', 'frameme' ),
				'section' => 'regular_scheme',
				'default' => '#000000',
				'field'   => 'hex_color',
				'type'    => 'control',
			),

			/** `Invert scheme` section */
			'invert_scheme' => array(
				'title'       => esc_html__( 'Invert scheme', 'frameme' ),
				'priority'    => 20,
				'panel'       => 'color_scheme',
				'type'        => 'section',
			),
			'invert_accent_color_1' => array(
				'title'   => esc_html__( 'Accent color (1)', 'frameme' ),
				'section' => 'invert_scheme',
				'default' => '#ffffff',
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'invert_text_color' => array(
				'title'   => esc_html__( 'Text color', 'frameme' ),
				'section' => 'invert_scheme',
				'default' => '#ffffff',
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'invert_link_color' => array(
				'title'   => esc_html__( 'Link color', 'frameme' ),
				'section' => 'invert_scheme',
				'default' => '#ffffff',
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'invert_link_hover_color' => array(
				'title'   => esc_html__( 'Link hover color', 'frameme' ),
				'section' => 'invert_scheme',
				'default' => '#828282',
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'invert_h1_color' => array(
				'title'   => esc_html__( 'H1 color', 'frameme' ),
				'section' => 'invert_scheme',
				'default' => '#ffffff',
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'invert_h2_color' => array(
				'title'   => esc_html__( 'H2 color', 'frameme' ),
				'section' => 'invert_scheme',
				'default' => '#ffffff',
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'invert_h3_color' => array(
				'title'   => esc_html__( 'H3 color', 'frameme' ),
				'section' => 'invert_scheme',
				'default' => '#ffffff',
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'invert_h4_color' => array(
				'title'   => esc_html__( 'H4 color', 'frameme' ),
				'section' => 'invert_scheme',
				'default' => '#ffffff',
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'invert_h5_color' => array(
				'title'   => esc_html__( 'H5 color', 'frameme' ),
				'section' => 'invert_scheme',
				'default' => '#ffffff',
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'invert_h6_color' => array(
				'title'   => esc_html__( 'H6 color', 'frameme' ),
				'section' => 'invert_scheme',
				'default' => '#ffffff',
				'field'   => 'hex_color',
				'type'    => 'control',
			),

			/** `Greyscale colors` section */
			'grey_scheme' => array(
				'title'       => esc_html__( 'Greyscale colors', 'frameme' ),
				'priority'    => 30,
				'panel'       => 'color_scheme',
				'type'        => 'section',
			),

			'grey_color_1' => array(
				'title'   => esc_html__( 'Grey color (1)', 'frameme' ),
				'section' => 'grey_scheme',
				'default' => '#d2d2d3',
				'field'   => 'hex_color',
				'type'    => 'control',
			),

			'grey_color_2' => array(
				'title'   => esc_html__( 'Grey color (2)', 'frameme' ),
				'section' => 'grey_scheme',
				'default' => '#adadad',
				'field'   => 'hex_color',
				'type'    => 'control',
			),

			'grey_color_3' => array(
				'title'   => esc_html__( 'Grey color (3)', 'frameme' ),
				'section' => 'grey_scheme',
				'default' => '#f6f6f6',
				'field'   => 'hex_color',
				'type'    => 'control',
			),

			/** `Typography Settings` panel */
			'typography' => array(
				'title'       => esc_html__( 'Typography', 'frameme' ),
				'description' => esc_html__( 'Configure typography settings', 'frameme' ),
				'priority'    => 50,
				'type'        => 'panel',
			),

			/** `Body text` section */
			'body_typography' => array(
				'title'       => esc_html__( 'Body text', 'frameme' ),
				'priority'    => 5,
				'panel'       => 'typography',
				'type'        => 'section',
			),
			'body_font_family' => array(
				'title'   => esc_html__( 'Font Family', 'frameme' ),
				'section' => 'body_typography',
				'default' => 'Lato, sans-serif',
				'field'   => 'fonts',
				'type'    => 'control',
			),
			'body_font_style' => array(
				'title'   => esc_html__( 'Font Style', 'frameme' ),
				'section' => 'body_typography',
				'default' => 'normal',
				'field'   => 'select',
				'choices' => frameme_get_font_styles(),
				'type'    => 'control',
			),
			'body_font_weight' => array(
				'title'   => esc_html__( 'Font Weight', 'frameme' ),
				'section' => 'body_typography',
				'default' => '400',
				'field'   => 'select',
				'choices' => frameme_get_font_weight(),
				'type'    => 'control',
			),
			'body_font_size' => array(
				'title'       => esc_html__( 'Font Size, px', 'frameme' ),
				'section'     => 'body_typography',
				'default'     => '16',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => 6,
					'max'  => 50,
					'step' => 1,
				),
				'type' => 'control',
			),
			'body_line_height' => array(
				'title'       => esc_html__( 'Line Height', 'frameme' ),
				'description' => esc_html__( 'Relative to the font-size of the element', 'frameme' ),
				'section'     => 'body_typography',
				'default'     => '1.5',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => 1.0,
					'max'  => 3.0,
					'step' => 0.1,
				),
				'type' => 'control',
			),
			'body_letter_spacing' => array(
				'title'       => esc_html__( 'Letter Spacing, em', 'frameme' ),
				'section'     => 'body_typography',
				'default'     => '0.03',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => -1,
					'max'  => 1,
					'step' => 0.01,
				),
				'type' => 'control',
			),
			'body_character_set' => array(
				'title'   => esc_html__( 'Character Set', 'frameme' ),
				'section' => 'body_typography',
				'default' => 'latin',
				'field'   => 'select',
				'choices' => frameme_get_character_sets(),
				'type'    => 'control',
			),
			'body_text_align' => array(
				'title'   => esc_html__( 'Text Align', 'frameme' ),
				'section' => 'body_typography',
				'default' => 'left',
				'field'   => 'select',
				'choices' => frameme_get_text_aligns(),
				'type'    => 'control',
			),

			/** `H1 Heading` section */
			'h1_typography' => array(
				'title'    => esc_html__( 'H1 Heading', 'frameme' ),
				'priority' => 10,
				'panel'    => 'typography',
				'type'     => 'section',
			),
			'h1_font_family' => array(
				'title'   => esc_html__( 'Font Family', 'frameme' ),
				'section' => 'h1_typography',
				'default' => 'Dancing Script, cursive',
				'field'   => 'fonts',
				'type'    => 'control',
			),
			'h1_font_style' => array(
				'title'   => esc_html__( 'Font Style', 'frameme' ),
				'section' => 'h1_typography',
				'default' => 'normal',
				'field'   => 'select',
				'choices' => frameme_get_font_styles(),
				'type'    => 'control',
			),
			'h1_font_weight' => array(
				'title'   => esc_html__( 'Font Weight', 'frameme' ),
				'section' => 'h1_typography',
				'default' => '400',
				'field'   => 'select',
				'choices' => frameme_get_font_weight(),
				'type'    => 'control',
			),
			'h1_font_size' => array(
				'title'       => esc_html__( 'Font Size, px', 'frameme' ),
				'section'     => 'h1_typography',
				'default'     => '68',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => 10,
					'max'  => 200,
					'step' => 1,
				),
				'type' => 'control',
			),
			'h1_line_height' => array(
				'title'       => esc_html__( 'Line Height', 'frameme' ),
				'description' => esc_html__( 'Relative to the font-size of the element', 'frameme' ),
				'section'     => 'h1_typography',
				'default'     => '1.19',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => 1.0,
					'max'  => 3.0,
					'step' => 0.1,
				),
				'type' => 'control',
			),
			'h1_letter_spacing' => array(
				'title'       => esc_html__( 'Letter Spacing, em', 'frameme' ),
				'section'     => 'h1_typography',
				'default'     => '0',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => -1,
					'max'  => 1,
					'step' => 0.01,
				),
				'type' => 'control',
			),
			'h1_character_set' => array(
				'title'   => esc_html__( 'Character Set', 'frameme' ),
				'section' => 'h1_typography',
				'default' => 'latin',
				'field'   => 'select',
				'choices' => frameme_get_character_sets(),
				'type'    => 'control',
			),
			'h1_text_align' => array(
				'title'   => esc_html__( 'Text Align', 'frameme' ),
				'section' => 'h1_typography',
				'default' => 'inherit',
				'field'   => 'select',
				'choices' => frameme_get_text_aligns(),
				'type'    => 'control',
			),

			/** `H2 Heading` section */
			'h2_typography' => array(
				'title'    => esc_html__( 'H2 Heading', 'frameme' ),
				'priority' => 15,
				'panel'    => 'typography',
				'type'     => 'section',
			),
			'h2_font_family' => array(
				'title'   => esc_html__( 'Font Family', 'frameme' ),
				'section' => 'h2_typography',
				'default' => 'Dancing Script, cursive',
				'field'   => 'fonts',
				'type'    => 'control',
			),
			'h2_font_style' => array(
				'title'   => esc_html__( 'Font Style', 'frameme' ),
				'section' => 'h2_typography',
				'default' => 'normal',
				'field'   => 'select',
				'choices' => frameme_get_font_styles(),
				'type'    => 'control',
			),
			'h2_font_weight' => array(
				'title'   => esc_html__( 'Font Weight', 'frameme' ),
				'section' => 'h2_typography',
				'default' => '400',
				'field'   => 'select',
				'choices' => frameme_get_font_weight(),
				'type'    => 'control',
			),
			'h2_font_size' => array(
				'title'       => esc_html__( 'Font Size, px', 'frameme' ),
				'section'     => 'h2_typography',
				'default'     => '48',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => 10,
					'max'  => 200,
					'step' => 1,
				),
				'type' => 'control',
			),
			'h2_line_height' => array(
				'title'       => esc_html__( 'Line Height', 'frameme' ),
				'description' => esc_html__( 'Relative to the font-size of the element', 'frameme' ),
				'section'     => 'h2_typography',
				'default'     => '1.3',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => 1.0,
					'max'  => 3.0,
					'step' => 0.1,
				),
				'type' => 'control',
			),
			'h2_letter_spacing' => array(
				'title'       => esc_html__( 'Letter Spacing, em', 'frameme' ),
				'section'     => 'h2_typography',
				'default'     => '0',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => -1,
					'max'  => 1,
					'step' => 0.01,
				),
				'type' => 'control',
			),
			'h2_character_set' => array(
				'title'   => esc_html__( 'Character Set', 'frameme' ),
				'section' => 'h2_typography',
				'default' => 'latin',
				'field'   => 'select',
				'choices' => frameme_get_character_sets(),
				'type'    => 'control',
			),
			'h2_text_align' => array(
				'title'   => esc_html__( 'Text Align', 'frameme' ),
				'section' => 'h2_typography',
				'default' => 'inherit',
				'field'   => 'select',
				'choices' => frameme_get_text_aligns(),
				'type'    => 'control',
			),

			/** `H3 Heading` section */
			'h3_typography' => array(
				'title'    => esc_html__( 'H3 Heading', 'frameme' ),
				'priority' => 20,
				'panel'    => 'typography',
				'type'     => 'section',
			),
			'h3_font_family' => array(
				'title'   => esc_html__( 'Font Family', 'frameme' ),
				'section' => 'h3_typography',
				'default' => 'Dancing Script, cursive',
				'field'   => 'fonts',
				'type'    => 'control',
			),
			'h3_font_style' => array(
				'title'   => esc_html__( 'Font Style', 'frameme' ),
				'section' => 'h3_typography',
				'default' => 'normal',
				'field'   => 'select',
				'choices' => frameme_get_font_styles(),
				'type'    => 'control',
			),
			'h3_font_weight' => array(
				'title'   => esc_html__( 'Font Weight', 'frameme' ),
				'section' => 'h3_typography',
				'default' => '400',
				'field'   => 'select',
				'choices' => frameme_get_font_weight(),
				'type'    => 'control',
			),
			'h3_font_size' => array(
				'title'       => esc_html__( 'Font Size, px', 'frameme' ),
				'section'     => 'h3_typography',
				'default'     => '30',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => 10,
					'max'  => 200,
					'step' => 1,
				),
				'type' => 'control',
			),
			'h3_line_height' => array(
				'title'       => esc_html__( 'Line Height', 'frameme' ),
				'description' => esc_html__( 'Relative to the font-size of the element', 'frameme' ),
				'section'     => 'h3_typography',
				'default'     => '1.344',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => 1.0,
					'max'  => 3.0,
					'step' => 0.1,
				),
				'type' => 'control',
			),
			'h3_letter_spacing' => array(
				'title'       => esc_html__( 'Letter Spacing, em', 'frameme' ),
				'section'     => 'h3_typography',
				'default'     => '0.02',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => -1,
					'max'  => 1,
					'step' => 0.01,
				),
				'type' => 'control',
			),
			'h3_character_set' => array(
				'title'   => esc_html__( 'Character Set', 'frameme' ),
				'section' => 'h3_typography',
				'default' => 'latin',
				'field'   => 'select',
				'choices' => frameme_get_character_sets(),
				'type'    => 'control',
			),
			'h3_text_align' => array(
				'title'   => esc_html__( 'Text Align', 'frameme' ),
				'section' => 'h3_typography',
				'default' => 'inherit',
				'field'   => 'select',
				'choices' => frameme_get_text_aligns(),
				'type'    => 'control',
			),

			/** `H4 Heading` section */
			'h4_typography' => array(
				'title'    => esc_html__( 'H4 Heading', 'frameme' ),
				'priority' => 25,
				'panel'    => 'typography',
				'type'     => 'section',
			),
			'h4_font_family' => array(
				'title'   => esc_html__( 'Font Family', 'frameme' ),
				'section' => 'h4_typography',
				'default' => 'Lato, sans-serif',
				'field'   => 'fonts',
				'type'    => 'control',
			),
			'h4_font_style' => array(
				'title'   => esc_html__( 'Font Style', 'frameme' ),
				'section' => 'h4_typography',
				'default' => 'normal',
				'field'   => 'select',
				'choices' => frameme_get_font_styles(),
				'type'    => 'control',
			),
			'h4_font_weight' => array(
				'title'   => esc_html__( 'Font Weight', 'frameme' ),
				'section' => 'h4_typography',
				'default' => '400',
				'field'   => 'select',
				'choices' => frameme_get_font_weight(),
				'type'    => 'control',
			),
			'h4_font_size' => array(
				'title'       => esc_html__( 'Font Size, px', 'frameme' ),
				'section'     => 'h4_typography',
				'default'     => '24',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => 10,
					'max'  => 200,
					'step' => 1,
				),
				'type' => 'control',
			),
			'h4_line_height' => array(
				'title'       => esc_html__( 'Line Height', 'frameme' ),
				'description' => esc_html__( 'Relative to the font-size of the element', 'frameme' ),
				'section'     => 'h4_typography',
				'default'     => '1.2',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => 1.0,
					'max'  => 3.0,
					'step' => 0.1,
				),
				'type' => 'control',
			),
			'h4_letter_spacing' => array(
				'title'       => esc_html__( 'Letter Spacing, em', 'frameme' ),
				'section'     => 'h4_typography',
				'default'     => '0',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => -1,
					'max'  => 1,
					'step' => 0.01,
				),
				'type' => 'control',
			),
			'h4_character_set' => array(
				'title'   => esc_html__( 'Character Set', 'frameme' ),
				'section' => 'h4_typography',
				'default' => 'latin',
				'field'   => 'select',
				'choices' => frameme_get_character_sets(),
				'type'    => 'control',
			),
			'h4_text_align' => array(
				'title'   => esc_html__( 'Text Align', 'frameme' ),
				'section' => 'h4_typography',
				'default' => 'inherit',
				'field'   => 'select',
				'choices' => frameme_get_text_aligns(),
				'type'    => 'control',
			),

			/** `H5 Heading` section */
			'h5_typography' => array(
				'title'    => esc_html__( 'H5 Heading', 'frameme' ),
				'priority' => 30,
				'panel'    => 'typography',
				'type'     => 'section',
			),
			'h5_font_family' => array(
				'title'   => esc_html__( 'Font Family', 'frameme' ),
				'section' => 'h5_typography',
				'default' => 'Lato, sans-serif',
				'field'   => 'fonts',
				'type'    => 'control',
			),
			'h5_font_style' => array(
				'title'   => esc_html__( 'Font Style', 'frameme' ),
				'section' => 'h5_typography',
				'default' => 'normal',
				'field'   => 'select',
				'choices' => frameme_get_font_styles(),
				'type'    => 'control',
			),
			'h5_font_weight' => array(
				'title'   => esc_html__( 'Font Weight', 'frameme' ),
				'section' => 'h5_typography',
				'default' => '400',
				'field'   => 'select',
				'choices' => frameme_get_font_weight(),
				'type'    => 'control',
			),
			'h5_font_size' => array(
				'title'       => esc_html__( 'Font Size, px', 'frameme' ),
				'section'     => 'h5_typography',
				'default'     => '18',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => 10,
					'max'  => 200,
					'step' => 1,
				),
				'type' => 'control',
			),
			'h5_line_height' => array(
				'title'       => esc_html__( 'Line Height', 'frameme' ),
				'description' => esc_html__( 'Relative to the font-size of the element', 'frameme' ),
				'section'     => 'h5_typography',
				'default'     => '1.67',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => 1.0,
					'max'  => 3.0,
					'step' => 0.1,
				),
				'type' => 'control',
			),
			'h5_letter_spacing' => array(
				'title'       => esc_html__( 'Letter Spacing, em', 'frameme' ),
				'section'     => 'h5_typography',
				'default'     => '-0.01',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => -1,
					'max'  => 1,
					'step' => 0.01,
				),
				'type' => 'control',
			),
			'h5_character_set' => array(
				'title'   => esc_html__( 'Character Set', 'frameme' ),
				'section' => 'h5_typography',
				'default' => 'latin',
				'field'   => 'select',
				'choices' => frameme_get_character_sets(),
				'type'    => 'control',
			),
			'h5_text_align' => array(
				'title'   => esc_html__( 'Text Align', 'frameme' ),
				'section' => 'h5_typography',
				'default' => 'inherit',
				'field'   => 'select',
				'choices' => frameme_get_text_aligns(),
				'type'    => 'control',
			),

			/** `H6 Heading` section */
			'h6_typography' => array(
				'title'    => esc_html__( 'H6 Heading', 'frameme' ),
				'priority' => 35,
				'panel'    => 'typography',
				'type'     => 'section',
			),
			'h6_font_family' => array(
				'title'   => esc_html__( 'Font Family', 'frameme' ),
				'section' => 'h6_typography',
				'default' => 'Lato, sans-serif',
				'field'   => 'fonts',
				'type'    => 'control',
			),
			'h6_font_style' => array(
				'title'   => esc_html__( 'Font Style', 'frameme' ),
				'section' => 'h6_typography',
				'default' => 'normal',
				'field'   => 'select',
				'choices' => frameme_get_font_styles(),
				'type'    => 'control',
			),
			'h6_font_weight' => array(
				'title'   => esc_html__( 'Font Weight', 'frameme' ),
				'section' => 'h6_typography',
				'default' => '400',
				'field'   => 'select',
				'choices' => frameme_get_font_weight(),
				'type'    => 'control',
			),
			'h6_font_size' => array(
				'title'       => esc_html__( 'Font Size, px', 'frameme' ),
				'section'     => 'h6_typography',
				'default'     => '16',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => 10,
					'max'  => 200,
					'step' => 1,
				),
				'type' => 'control',
			),
			'h6_line_height' => array(
				'title'       => esc_html__( 'Line Height', 'frameme' ),
				'description' => esc_html__( 'Relative to the font-size of the element', 'frameme' ),
				'section'     => 'h6_typography',
				'default'     => '1.44',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => 1.0,
					'max'  => 3.0,
					'step' => 0.1,
				),
				'type' => 'control',
			),
			'h6_letter_spacing' => array(
				'title'       => esc_html__( 'Letter Spacing, em', 'frameme' ),
				'section'     => 'h6_typography',
				'default'     => '0.04',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => -1,
					'max'  => 1,
					'step' => 0.01,
				),
				'type' => 'control',
			),
			'h6_character_set' => array(
				'title'   => esc_html__( 'Character Set', 'frameme' ),
				'section' => 'h6_typography',
				'default' => 'latin',
				'field'   => 'select',
				'choices' => frameme_get_character_sets(),
				'type'    => 'control',
			),
			'h6_text_align' => array(
				'title'   => esc_html__( 'Text Align', 'frameme' ),
				'section' => 'h6_typography',
				'default' => 'inherit',
				'field'   => 'select',
				'choices' => frameme_get_text_aligns(),
				'type'    => 'control',
			),

			/** `Breadcrumbs` section */
			'breadcrumbs_typography' => array(
				'title'    => esc_html__( 'Breadcrumbs', 'frameme' ),
				'priority' => 45,
				'panel'    => 'typography',
				'type'     => 'section',
			),
			'breadcrumbs_font_family' => array(
				'title'   => esc_html__( 'Font Family', 'frameme' ),
				'section' => 'breadcrumbs_typography',
				'default' => 'Roboto, sans-serif',
				'field'   => 'fonts',
				'type'    => 'control',
			),
			'breadcrumbs_font_style' => array(
				'title'   => esc_html__( 'Font Style', 'frameme' ),
				'section' => 'breadcrumbs_typography',
				'default' => 'normal',
				'field'   => 'select',
				'choices' => frameme_get_font_styles(),
				'type'    => 'control',
			),
			'breadcrumbs_font_weight' => array(
				'title'   => esc_html__( 'Font Weight', 'frameme' ),
				'section' => 'breadcrumbs_typography',
				'default' => '400',
				'field'   => 'select',
				'choices' => frameme_get_font_weight(),
				'type'    => 'control',
			),
			'breadcrumbs_font_size' => array(
				'title'       => esc_html__( 'Font Size, px', 'frameme' ),
				'section'     => 'breadcrumbs_typography',
				'default'     => '12',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => 6,
					'max'  => 50,
					'step' => 1,
				),
				'type' => 'control',
			),
			'breadcrumbs_line_height' => array(
				'title'       => esc_html__( 'Line Height', 'frameme' ),
				'description' => esc_html__( 'Relative to the font-size of the element', 'frameme' ),
				'section'     => 'breadcrumbs_typography',
				'default'     => '1.75',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => 1.0,
					'max'  => 3.0,
					'step' => 0.1,
				),
				'type' => 'control',
			),
			'breadcrumbs_letter_spacing' => array(
				'title'       => esc_html__( 'Letter Spacing, em', 'frameme' ),
				'section'     => 'breadcrumbs_typography',
				'default'     => '0',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => -1,
					'max'  => 1,
					'step' => 0.01,
				),
				'type' => 'control',
			),
			'breadcrumbs_character_set' => array(
				'title'   => esc_html__( 'Character Set', 'frameme' ),
				'section' => 'breadcrumbs_typography',
				'default' => 'latin',
				'field'   => 'select',
				'choices' => frameme_get_character_sets(),
				'type'    => 'control',
			),

			/** `Meta` section */
			'meta_typography' => array(
				'title'       => esc_html__( 'Meta', 'frameme' ),
				'priority'    => 50,
				'panel'       => 'typography',
				'type'        => 'section',
			),
			'meta_font_family' => array(
				'title'   => esc_html__( 'Font Family', 'frameme' ),
				'section' => 'meta_typography',
				'default' => 'Lato, sans-serif',
				'field'   => 'fonts',
				'type'    => 'control',
			),
			'meta_font_style' => array(
				'title'   => esc_html__( 'Font Style', 'frameme' ),
				'section' => 'meta_typography',
				'default' => 'normal',
				'field'   => 'select',
				'choices' => frameme_get_font_styles(),
				'type'    => 'control',
			),
			'meta_font_weight' => array(
				'title'   => esc_html__( 'Font Weight', 'frameme' ),
				'section' => 'meta_typography',
				'default' => '300',
				'field'   => 'select',
				'choices' => frameme_get_font_weight(),
				'type'    => 'control',
			),
			'meta_font_size' => array(
				'title'       => esc_html__( 'Font Size, px', 'frameme' ),
				'section'     => 'meta_typography',
				'default'     => '16',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => 10,
					'max'  => 200,
					'step' => 1,
				),
				'type' => 'control',
			),
			'meta_line_height' => array(
				'title'       => esc_html__( 'Line Height', 'frameme' ),
				'description' => esc_html__( 'Relative to the font-size of the element', 'frameme' ),
				'section'     => 'meta_typography',
				'default'     => '1.75',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => 1.0,
					'max'  => 3.0,
					'step' => 0.1,
				),
				'type' => 'control',
			),
			'meta_letter_spacing' => array(
				'title'       => esc_html__( 'Letter Spacing, em', 'frameme' ),
				'section'     => 'meta_typography',
				'default'     => '0',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => -1,
					'max'  => 1,
					'step' => 0.01,
				),
				'type' => 'control',
			),
			'meta_character_set' => array(
				'title'   => esc_html__( 'Character Set', 'frameme' ),
				'section' => 'meta_typography',
				'default' => 'latin',
				'field'   => 'select',
				'choices' => frameme_get_character_sets(),
				'type'    => 'control',
			),

			/** `Main menu` section */
			'main_menu_typography' => array(
				'title'       => esc_html__( 'Main menu', 'frameme' ),
				'priority'    => 50,
				'panel'       => 'typography',
				'type'        => 'section',
			),
			'main_menu_font_family' => array(
				'title'   => esc_html__( 'Font Family', 'frameme' ),
				'section' => 'main_menu_typography',
				'default' => 'Lato, sans-serif',
				'field'   => 'fonts',
				'type'    => 'control',
			),
			'main_menu_font_style' => array(
				'title'   => esc_html__( 'Font Style', 'frameme' ),
				'section' => 'main_menu_typography',
				'default' => 'normal',
				'field'   => 'select',
				'choices' => frameme_get_font_styles(),
				'type'    => 'control',
			),
			'main_menu_font_weight' => array(
				'title'   => esc_html__( 'Font Weight', 'frameme' ),
				'section' => 'main_menu_typography',
				'default' => '400',
				'field'   => 'select',
				'choices' => frameme_get_font_weight(),
				'type'    => 'control',
			),
			'main_menu_font_size' => array(
				'title'       => esc_html__( 'Font Size, px', 'frameme' ),
				'section'     => 'main_menu_typography',
				'default'     => '14',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => 10,
					'max'  => 200,
					'step' => 1,
				),
				'type' => 'control',
			),
			'main_menu_line_height' => array(
				'title'       => esc_html__( 'Line Height', 'frameme' ),
				'description' => esc_html__( 'Relative to the font-size of the element', 'frameme' ),
				'section'     => 'main_menu_typography',
				'default'     => '1.363',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => 1.0,
					'max'  => 3.0,
					'step' => 0.1,
				),
				'type' => 'control',
			),
			'main_menu_letter_spacing' => array(
				'title'       => esc_html__( 'Letter Spacing, em', 'frameme' ),
				'section'     => 'main_menu_typography',
				'default'     => '0.04',
				'field'       => 'number',
				'input_attrs' => array(
					'min'  => -1,
					'max'  => 1,
					'step' => 0.01,
				),
				'type' => 'control',
			),
			'main_menu_character_set' => array(
				'title'   => esc_html__( 'Character Set', 'frameme' ),
				'section' => 'main_menu_typography',
				'default' => 'latin',
				'field'   => 'select',
				'choices' => frameme_get_character_sets(),
				'type'    => 'control',
			),

			/** `Typography misc` section */
			'misc_styles' => array(
				'title'    => esc_html__( 'Misc', 'frameme' ),
				'priority' => 60,
				'panel'    => 'typography',
				'type'     => 'section',
			),
			'word_wrap' => array(
				'title'   => esc_html__( 'Enable Word Wrap', 'frameme' ),
				'section' => 'misc_styles',
				'default' => false,
				'field'   => 'checkbox',
				'type'    => 'control',
			),

			/** `Header` panel */
			'header_options' => array(
				'title'    => esc_html__( 'Header', 'frameme' ),
				'priority' => 60,
				'type'     => 'panel',
			),

			/** `Header styles` section */
			'header_styles' => array(
				'title'    => esc_html__( 'Styles', 'frameme' ),
				'priority' => 5,
				'panel'    => 'header_options',
				'type'     => 'section',
			),
			'header_layout_type' => array(
				'title'   => esc_html__( 'Layout', 'frameme' ),
				'section' => 'header_styles',
				'default' => 'style-6',
				'field'   => 'select',
				'choices' => frameme_get_header_layout_options(),
				'type'    => 'control',
			),
			'header_transparent_layout' => array(
				'title'   => esc_html__( 'Header overlay', 'frameme' ),
				'section' => 'header_styles',
				'default' => false,
				'field'   => 'checkbox',
				'type'    => 'control',
				'active_callback' => '__return_false',
			),
			'header_invert_color_scheme' => array(
				'title'   => esc_html__( 'Enable invert color scheme', 'frameme' ),
				'section' => 'header_styles',
				'default' => false,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'header_nav_panel_type' => array(
				'title'   => esc_html__( 'Navigation section type', 'frameme' ),
				'section' => 'header_styles',
				'default' => 'boxed',
				'field'   => 'select',
				'type'    => 'control',
				'choices' => array(
					'fullwidth' => esc_html__( 'Fullwidth', 'frameme' ),
					'boxed'     => esc_html__( 'Boxed', 'frameme' ),
				),
				'active_callback' => 'frameme_is_header_layout_style_5',
			),
			'header_nav_panel_position' => array(
				'title'   => esc_html__( 'Navigation section position', 'frameme' ),
				'section' => 'header_styles',
				'default' => 'static',
				'field'   => 'select',
				'type'    => 'control',
				'choices' => array(
					'static' => esc_html__( 'Static', 'frameme' ),
					'over'   => esc_html__( 'Over Content', 'frameme' ),
				),
				'active_callback' => 'frameme_is_header_layout_style_5',
			),
			'header_bg_color' => array(
				'title'   => esc_html__( 'Background Color', 'frameme' ),
				'section' => 'header_styles',
				'field'   => 'hex_color',
				'default' => '#ffffff',
				'type'    => 'control',
			),
			'header_bg_image' => array(
				'title'   => esc_html__( 'Background Image', 'frameme' ),
				'section' => 'header_styles',
				'field'   => 'image',
				'type'    => 'control',
			),
			'header_bg_repeat' => array(
				'title'   => esc_html__( 'Background Repeat', 'frameme' ),
				'section' => 'header_styles',
				'default' => 'no-repeat',
				'field'   => 'select',
				'choices' => frameme_get_bg_repeat(),
				'type'    => 'control',
			),
			'header_bg_position' => array(
				'title'   => esc_html__( 'Background Position', 'frameme' ),
				'section' => 'header_styles',
				'default' => 'center',
				'field'   => 'select',
				'choices' => frameme_get_bg_position(),
				'type'    => 'control',
			),
			'header_bg_size' => array(
				'title'   => esc_html__( 'Background Size', 'frameme' ),
				'section' => 'header_styles',
				'default' => 'cover',
				'field'   => 'select',
				'choices' => frameme_get_bg_size(),
				'type'    => 'control',
			),
			'header_bg_attachment' => array(
				'title'   => esc_html__( 'Background Attachment', 'frameme' ),
				'section' => 'header_styles',
				'default' => 'scroll',
				'field'   => 'select',
				'choices' => frameme_get_bg_attachment(),
				'type'    => 'control',
			),

			/** `Header elements` section */
			'header_elements' => array(
				'title'       => esc_html__( 'Header Elements', 'frameme' ),
				'priority'    => 15,
				'panel'       => 'header_options',
				'type'        => 'section',
			),
			'header_search' => array(
				'title'   => esc_html__( 'Show search', 'frameme' ),
				'section' => 'header_elements',
				'default' => false,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'header_btn_visibility' => array(
				'title'   => esc_html__( 'Show header call to action button', 'frameme' ),
				'section' => 'header_elements',
				'default' => false,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'header_btn_text' => array(
				'title'           => esc_html__( 'Header call to action button', 'frameme' ),
				'description'     => esc_html__( 'Button text', 'frameme' ),
				'section'         => 'header_elements',
				'default'         => esc_html__( 'Make an Appointment', 'frameme' ),
				'field'           => 'text',
				'type'            => 'control',
				'active_callback' => 'frameme_is_header_btn_visible',
			),
			'header_btn_icon' => array(
				'title'           => esc_html__( 'Header button icon', 'frameme' ),
				'description'     => esc_html__( 'Choose icon', 'frameme' ),
				'section'         => 'header_elements',
				'field'           => 'iconpicker',
				'default'         => 'education_agenda-bookmark',
				'icon_data'       => frameme_get_nc_mini_icons_data(),
				'type'            => 'control',
				'active_callback' => 'frameme_is_header_btn_visible',
			),
			'header_btn_icon_location' => array(
				'title'   => esc_html__( 'Header icon location', 'frameme' ),
				'section' => 'header_elements',
				'default' => 'left',
				'field'   => 'radio',
				'choices' => array(
					'left'   => esc_html__( 'Left', 'frameme' ),
					'right'  => esc_html__( 'Right', 'frameme' ),
				),
				'type'    => 'control',
				'active_callback' => 'frameme_is_header_btn_visible',
			),
			'header_btn_url' => array(
				'title'           => '',
				'description'     => esc_html__( 'Button url', 'frameme' ),
				'section'         => 'header_elements',
				'default'         => '%%home_url%%booked',
				'field'           => 'text',
				'type'            => 'control',
				'active_callback' => 'frameme_is_header_btn_visible',
			),
			'header_btn_target' => array(
				'title'           => esc_html__( 'Open Link in New Tab', 'frameme' ),
				'section'         => 'header_elements',
				'default'         => false,
				'field'           => 'checkbox',
				'type'            => 'control',
				'active_callback' => 'frameme_is_header_btn_visible',
			),
			'header_btn_style' => array(
				'title'   => esc_html__( 'Header button style', 'frameme' ),
				'section' => 'header_elements',
				'default' => 'accent-1',
				'field'   => 'radio',
				'choices' => array(
					'accent-1'  => esc_html__( 'Accent 1', 'frameme' ),
					'accent-2'  => esc_html__( 'Accent 2', 'frameme' ),
				),
				'type'    => 'control',
				'active_callback' => 'frameme_is_header_btn_visible',
			),

			/** `Header contact block` section */
			'header_contact_block' => array(
				'title'       => esc_html__( 'Header Contact Block', 'frameme' ),
				'priority'    => 10,
				'panel'       => 'header_options',
				'type'        => 'section',
			),
			'header_contact_block_visibility' => array(
				'title'   => esc_html__( 'Show Header Contact Block', 'frameme' ),
				'section' => 'header_contact_block',
				'default' => false,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'header_contact_icon_1' => array(
				'title'           => esc_html__( 'Contact item 1', 'frameme' ),
				'description'     => esc_html__( 'Choose icon', 'frameme' ),
				'section'         => 'header_contact_block',
				'field'           => 'iconpicker',
				'default'         => 'ui-2_time-clock',
				'icon_data'       => frameme_get_nc_mini_icons_data(),
				'type'            => 'control',
				'active_callback' => 'frameme_is_header_contact_block_enable',
			),
			'header_contact_label_1' => array(
				'title'           => '',
				'description'     => esc_html__( 'Label', 'frameme' ),
				'section'         => 'header_contact_block',
				'default'         => false,
				'field'           => 'text',
				'type'            => 'control',
				'active_callback' => 'frameme_is_header_contact_block_enable',
			),
			'header_contact_text_1' => array(
				'title'           => '',
				'description'     => esc_html__( 'Description', 'frameme' ),
				'section'         => 'header_contact_block',
				'default'         => frameme_get_default_contact_information( 'work-time' ),
				'field'           => 'textarea',
				'type'            => 'control',
				'active_callback' => 'frameme_is_header_contact_block_enable',
			),
			'header_contact_icon_2' => array(
				'title'           => esc_html__( 'Contact item 2', 'frameme' ),
				'description'     => esc_html__( 'Choose icon', 'frameme' ),
				'section'         => 'header_contact_block',
				'field'           => 'iconpicker',
				'default'         => 'location_pin',
				'icon_data'       => frameme_get_nc_mini_icons_data(),
				'type'            => 'control',
				'active_callback' => 'frameme_is_header_contact_block_enable',
			),
			'header_contact_label_2' => array(
				'title'           => '',
				'description'     => esc_html__( 'Label', 'frameme' ),
				'section'         => 'header_contact_block',
				'default'         => false,
				'field'           => 'text',
				'type'            => 'control',
				'active_callback' => 'frameme_is_header_contact_block_enable',
			),
			'header_contact_text_2' => array(
				'title'           => '',
				'description'     => esc_html__( 'Description', 'frameme' ),
				'section'         => 'header_contact_block',
				'default'         => frameme_get_default_contact_information( 'address' ),
				'field'           => 'textarea',
				'type'            => 'control',
				'active_callback' => 'frameme_is_header_contact_block_enable',
			),
			'header_contact_icon_3' => array(
				'title'           => esc_html__( 'Contact item 3', 'frameme' ),
				'description'     => esc_html__( 'Choose icon', 'frameme' ),
				'section'         => 'header_contact_block',
				'field'           => 'iconpicker',
				'default'         => 'ui-3_phone',
				'icon_data'       => frameme_get_nc_mini_icons_data(),
				'type'            => 'control',
				'active_callback' => 'frameme_is_header_contact_block_enable',
			),
			'header_contact_label_3' => array(
				'title'           => '',
				'description'     => esc_html__( 'Label', 'frameme' ),
				'section'         => 'header_contact_block',
				'default'         => esc_html__( 'Call Us:', 'frameme' ),
				'field'           => 'text',
				'type'            => 'control',
				'active_callback' => 'frameme_is_header_contact_block_enable',
			),
			'header_contact_text_3' => array(
				'title'           => '',
				'description'     => esc_html__( 'Description', 'frameme' ),
				'section'         => 'header_contact_block',
				'default'         => frameme_get_default_contact_information( 'phones' ),
				'field'           => 'textarea',
				'type'            => 'control',
				'active_callback' => 'frameme_is_header_contact_block_enable',
			),

			/** `Top Panel` section */
			'header_top_panel' => array(
				'title'    => esc_html__( 'Top Panel', 'frameme' ),
				'priority' => 20,
				'panel'    => 'header_options',
				'type'     => 'section',
			),
			'top_panel_visibility' => array(
				'title'   => esc_html__( 'Enable top panel', 'frameme' ),
				'section' => 'header_top_panel',
				'default' => true,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'top_panel_text' => array(
				'title'           => esc_html__( 'Disclaimer Text', 'frameme' ),
				'description'     => esc_html__( 'HTML formatting support', 'frameme' ),
				'section'         => 'header_top_panel',
				'default'         => false,
				'field'           => 'textarea',
				'type'            => 'control',
				'active_callback' => 'frameme_is_top_panel_enable',
			),
			'top_panel_bg'        => array(
				'title'           => esc_html__( 'Background color', 'frameme' ),
				'section'         => 'header_top_panel',
				'default'         => '#f1ede8',
				'field'           => 'hex_color',
				'type'            => 'control',
				'active_callback' => 'frameme_is_top_panel_enable',
			),
			'top_menu_visibility' => array(
				'title'           => esc_html__( 'Show top menu', 'frameme' ),
				'section'         => 'header_top_panel',
				'default'         => false,
				'field'           => 'checkbox',
				'type'            => 'control',
				'active_callback' => 'frameme_is_top_panel_enable',
			),
			'login_link_visibility' => array(
				'title'           => esc_html__( 'Show login link', 'frameme' ),
				'section'         => 'header_top_panel',
				'default'         => true,
				'field'           => 'checkbox',
				'type'            => 'control',
				'active_callback' => 'frameme_is_top_panel_enable',
			),

			/** `Header contact block` section */
			'header_top_panel_contact_block' => array(
				'title'       => esc_html__( 'Top Panel Contact Block', 'frameme' ),
				'description' => esc_html__( 'This block shows only if Top Panel section is enabled!', 'frameme' ),
				'priority'    => 25,
				'panel'       => 'header_options',
				'type'        => 'section',
			),
			'header_top_panel_contact_block_visibility' => array(
				'title'   => esc_html__( 'Show Header Contact Block', 'frameme' ),
				'section' => 'header_top_panel_contact_block',
				'default' => true,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'header_top_panel_contact_icon_1' => array(
				'title'           => esc_html__( 'Contact item 1', 'frameme' ),
				'description'     => esc_html__( 'Choose icon', 'frameme' ),
				'section'         => 'header_top_panel_contact_block',
				'field'           => 'iconpicker',
				'default'         => false,
				'icon_data'       => frameme_get_nc_mini_icons_data(),
				'type'            => 'control',
				'active_callback' => 'frameme_is_top_panel_contact_block_enable',
			),
			'header_top_panel_contact_label_1' => array(
				'title'           => '',
				'description'     => esc_html__( 'Label', 'frameme' ),
				'section'         => 'header_top_panel_contact_block',
				'default'         => false,
				'field'           => 'text',
				'type'            => 'control',
				'active_callback' => 'frameme_is_top_panel_contact_block_enable',
			),
			'header_top_panel_contact_text_1' => array(
				'title'           => '',
				'description'     => esc_html__( 'Description', 'frameme' ),
				'section'         => 'header_top_panel_contact_block',
				'default'         => false,
				'field'           => 'textarea',
				'type'            => 'control',
				'active_callback' => 'frameme_is_top_panel_contact_block_enable',
			),
			'header_top_panel_contact_icon_2' => array(
				'title'           => esc_html__( 'Contact item 2', 'frameme' ),
				'description'     => esc_html__( 'Choose icon', 'frameme' ),
				'section'         => 'header_top_panel_contact_block',
				'field'           => 'iconpicker',
				'default'         => 'ui-3_phone',
				'icon_data'       => frameme_get_nc_mini_icons_data(),
				'type'            => 'control',
				'active_callback' => 'frameme_is_top_panel_contact_block_enable',
			),
			'header_top_panel_contact_label_2' => array(
				'title'           => '',
				'description'     => esc_html__( 'Label', 'frameme' ),
				'section'         => 'header_top_panel_contact_block',
				'default'         => 'Call:',
				'field'           => 'text',
				'type'            => 'control',
				'active_callback' => 'frameme_is_top_panel_contact_block_enable',
			),
			'header_top_panel_contact_text_2' => array(
				'title'           => '',
				'description'     => esc_html__( 'Description', 'frameme' ),
				'section'         => 'header_top_panel_contact_block',
				'default'         => frameme_get_default_contact_information( 'phones' ),
				'field'           => 'textarea',
				'type'            => 'control',
				'active_callback' => 'frameme_is_top_panel_contact_block_enable',
			),
			'header_top_panel_contact_icon_3' => array(
				'title'           => esc_html__( 'Contact item 3', 'frameme' ),
				'description'     => esc_html__( 'Choose icon', 'frameme' ),
				'section'         => 'header_top_panel_contact_block',
				'field'           => 'iconpicker',
				'default'         => 'ui-2_time-clock',
				'icon_data'       => frameme_get_nc_mini_icons_data(),
				'type'            => 'control',
				'active_callback' => 'frameme_is_top_panel_contact_block_enable',
			),
			'header_top_panel_contact_label_3' => array(
				'title'           => '',
				'description'     => esc_html__( 'Label', 'frameme' ),
				'section'         => 'header_top_panel_contact_block',
				'default'         => false,
				'field'           => 'text',
				'type'            => 'control',
				'active_callback' => 'frameme_is_top_panel_contact_block_enable',
			),
			'header_top_panel_contact_text_3' => array(
				'title'           => '',
				'description'     => esc_html__( 'Description', 'frameme' ),
				'section'         => 'header_top_panel_contact_block',
				'default'         => frameme_get_default_contact_information( 'info' ),
				'field'           => 'textarea',
				'type'            => 'control',
				'active_callback' => 'frameme_is_top_panel_contact_block_enable',
			),
			'header_top_panel_contact_icon_4' => array(
				'title'           => esc_html__( 'Contact item 4', 'frameme' ),
				'description'     => esc_html__( 'Choose icon', 'frameme' ),
				'section'         => 'header_top_panel_contact_block',
				'field'           => 'iconpicker',
				'default'         => false,
				'icon_data'       => frameme_get_nc_mini_icons_data(),
				'type'            => 'control',
				'active_callback' => 'frameme_is_top_panel_contact_block_enable',
			),
			'header_top_panel_contact_label_4' => array(
				'title'           => '',
				'description'     => esc_html__( 'Label', 'frameme' ),
				'section'         => 'header_top_panel_contact_block',
				'default'         => false,
				'field'           => 'text',
				'type'            => 'control',
				'active_callback' => 'frameme_is_top_panel_contact_block_enable',
			),
			'header_top_panel_contact_text_4' => array(
				'title'           => '',
				'description'     => esc_html__( 'Description', 'frameme' ),
				'section'         => 'header_top_panel_contact_block',
				'default'         => false,
				'field'           => 'textarea',
				'type'            => 'control',
				'active_callback' => 'frameme_is_top_panel_contact_block_enable',
			),

			/** `Main Menu` section */
			'header_main_menu' => array(
				'title'    => esc_html__( 'Main Menu', 'frameme' ),
				'priority' => 30,
				'panel'    => 'header_options',
				'type'     => 'section',
			),
			'header_menu_sticky' => array(
				'title'   => esc_html__( 'Enable sticky menu', 'frameme' ),
				'section' => 'header_main_menu',
				'default' => false,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'header_menu_attributes' => array(
				'title'   => esc_html__( 'Enable description', 'frameme' ),
				'section' => 'header_main_menu',
				'default' => false,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'header_menu_style' => array(
				'title'   => esc_html__( 'Menu style', 'frameme' ),
				'section' => 'header_main_menu',
				'default' => 'style-1',
				'field'   => 'radio',
				'choices' => array(
					'style-1' => esc_html__( 'Style 1', 'frameme' ),
					'style-2' => esc_html__( 'Style 2', 'frameme' ),
				),
				'type'    => 'control',
			),
			'more_button_type' => array(
				'title'   => esc_html__( 'More Menu Button Type', 'frameme' ),
				'section' => 'header_main_menu',
				'default' => 'text',
				'field'   => 'radio',
				'choices' => array(
					'image' => esc_html__( 'Image', 'frameme' ),
					'icon'  => esc_html__( 'Icon', 'frameme' ),
					'text'  => esc_html__( 'Text', 'frameme' ),
				),
				'type'    => 'control',
			),
			'more_button_text' => array(
				'title'           => esc_html__( 'More Menu Button Text', 'frameme' ),
				'section'         => 'header_main_menu',
				'default'         => esc_html__( 'More', 'frameme' ),
				'field'           => 'input',
				'type'            => 'control',
				'active_callback' => 'frameme_is_more_button_type_text',
			),
			'more_button_icon' => array(
				'title'           => esc_html__( 'More Menu Button Icon', 'frameme' ),
				'section'         => 'header_main_menu',
				'field'           => 'iconpicker',
				'type'            => 'control',
				'default'         => 'arrows-1_minimal-down',
				'active_callback' => 'frameme_is_more_button_type_icon',
				'icon_data'       => frameme_get_nc_mini_icons_data(),
			),
			'more_button_image_url' => array(
				'title'           => esc_html__( 'More Button Image Upload', 'frameme' ),
				'description'     => esc_html__( 'Upload More Button image', 'frameme' ),
				'section'         => 'header_main_menu',
				'default'         => false,
				'field'           => 'image',
				'type'            => 'control',
				'active_callback' => 'frameme_is_more_button_type_image',
			),
			'retina_more_button_image_url' => array(
				'title'           => esc_html__( 'Retina More Button Image Upload', 'frameme' ),
				'description'     => esc_html__( 'Upload More Button image for retina-ready devices', 'frameme' ),
				'section'         => 'header_main_menu',
				'field'           => 'image',
				'type'            => 'control',
				'active_callback' => 'frameme_is_more_button_type_image',
			),

			/** `Sidebar` section */
			'sidebar_settings' => array(
				'title'    => esc_html__( 'Sidebar', 'frameme' ),
				'priority' => 105,
				'type'     => 'section',
			),
			'sidebar_position' => array(
				'title'   => esc_html__( 'Sidebar Position', 'frameme' ),
				'section' => 'sidebar_settings',
				'default' => 'fullwidth',
				'field'   => 'select',
				'choices' => array(
					'one-left-sidebar'  => esc_html__( 'Sidebar on left side', 'frameme' ),
					'one-right-sidebar' => esc_html__( 'Sidebar on right side', 'frameme' ),
					'fullwidth'         => esc_html__( 'No sidebars', 'frameme' ),
				),
				'type' => 'control',
			),
			'sidebar_services' => array(
				'title'           => esc_html__( 'Enable services sidebar area on single service. If disbled will display default sidebar area.', 'frameme' ),
				'section'         => 'sidebar_settings',
				'default'         => true,
				'field'           => 'checkbox',
				'type'            => 'control',
				'active_callback' => 'frameme_is_services_activated',
			),
			'sidebar_projects' => array(
				'title'           => esc_html__( 'Enable projects sidebar area on single project. If disbled will display default sidebar area.', 'frameme' ),
				'section'         => 'sidebar_settings',
				'default'         => true,
				'field'           => 'checkbox',
				'type'            => 'control',
				'active_callback' => 'frameme_is_projects_activated',
			),

			/** `MailChimp` section */
			'mailchimp' => array(
				'title'       => esc_html__( 'MailChimp', 'frameme' ),
				'description' => esc_html__( 'Setup MailChimp settings for subscribe widget', 'frameme' ),
				'priority'    => 109,
				'type'        => 'section',
			),
			'mailchimp_api_key' => array(
				'title'   => esc_html__( 'MailChimp API key', 'frameme' ),
				'section' => 'mailchimp',
				'field'   => 'text',
				'type'    => 'control',
			),
			'mailchimp_list_id' => array(
				'title'   => esc_html__( 'MailChimp list ID', 'frameme' ),
				'section' => 'mailchimp',
				'field'   => 'text',
				'type'    => 'control',
			),

			/** `Ads Management` panel */
			'ads_management' => array(
				'title'    => esc_html__( 'Ads Management', 'frameme' ),
				'priority' => 110,
				'type'     => 'section',
			),
			'ads_header' => array(
				'title'             => esc_html__( 'Header', 'frameme' ),
				'section'           => 'ads_management',
				'field'             => 'textarea',
				'default'           => false,
				'sanitize_callback' => 'esc_html',
				'type'              => 'control',
			),
			'ads_home_before_loop' => array(
				'title'             => esc_html__( 'Front Page Before Loop', 'frameme' ),
				'section'           => 'ads_management',
				'field'             => 'textarea',
				'default'           => false,
				'sanitize_callback' => 'esc_html',
				'type'              => 'control',
			),
			'ads_post_before_content' => array(
				'title'             => esc_html__( 'Post Before Content', 'frameme' ),
				'section'           => 'ads_management',
				'field'             => 'textarea',
				'default'           => false,
				'sanitize_callback' => 'esc_html',
				'type'              => 'control',
			),
			'ads_post_before_comments' => array(
				'title'             => esc_html__( 'Post Before Comments', 'frameme' ),
				'section'           => 'ads_management',
				'field'             => 'textarea',
				'default'           => false,
				'sanitize_callback' => 'esc_html',
				'type'              => 'control',
			),

			/** `Footer` panel */
			'footer_options' => array(
				'title'    => esc_html__( 'Footer', 'frameme' ),
				'priority' => 110,
				'type'     => 'panel',
			),

			/** `Footer styles` section */
			'footer_styles' => array(
				'title'    => esc_html__( 'Footer Styles', 'frameme' ),
				'priority' => 5,
				'panel'    => 'footer_options',
				'type'     => 'section',
			),
			'footer_logo_visibility' => array(
				'title'   => esc_html__( 'Show Footer Logo', 'frameme' ),
				'section' => 'footer_styles',
				'default' => false,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'footer_logo_url' => array(
				'title'           => esc_html__( 'Logo upload', 'frameme' ),
				'section'         => 'footer_styles',
				'field'           => 'image',
				'default'         => '%s/assets/images/footer-logo.png',
				'type'            => 'control',
				'active_callback' => 'frameme_is_footer_logo_enable',
			),
			'invert_footer_logo_url' => array(
				'title'           => esc_html__( 'Invert Logo Upload', 'frameme' ),
				'description'     => esc_html__( 'Upload logo image', 'frameme' ),
				'section'         => 'footer_styles',
				'default'         => '%s/assets/images/invert-logo.png',
				'field'           => 'image',
				'type'            => 'control',
				'active_callback' => 'frameme_is_header_logo_image',
			),
			'footer_copyright' => array(
				'title'   => esc_html__( 'Copyright text', 'frameme' ),
				'section' => 'footer_styles',
				'default' => frameme_get_default_footer_copyright(),
				'field'   => 'textarea',
				'type'    => 'control',
			),
			'footer_layout_type' => array(
				'title'   => esc_html__( 'Layout', 'frameme' ),
				'section' => 'footer_styles',
				'default' => 'style-1',
				'field'   => 'select',
				'choices' => frameme_get_footer_layout_options(),
				'type' => 'control',
			),
			'footer_bg_first' => array(
				'title'           => esc_html__( 'Footer Background first row color', 'frameme' ),
				'section'         => 'footer_styles',
				'default'         => '#ffffff',
				'field'           => 'hex_color',
				'type'            => 'control',
				'active_callback' => 'frameme_is_footer_style_1_enable',
			),
			'footer_bg' => array(
				'title'   => esc_html__( 'Footer Background color', 'frameme' ),
				'section' => 'footer_styles',
				'default' => '#ffffff',
				'field'   => 'hex_color',
				'type'    => 'control',
			),
			'footer_widget_area_visibility' => array(
				'title'   => esc_html__( 'Show Footer Widgets Area', 'frameme' ),
				'section' => 'footer_styles',
				'default' => true,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'footer_widget_columns' => array(
				'title'           => esc_html__( 'Widget Area Columns', 'frameme' ),
				'section'         => 'footer_styles',
				'default'         => '4',
				'field'           => 'select',
				'choices'         => array(
					'1' => '1',
					'2' => '2',
					'3' => '3',
					'4' => '4',
				),
				'type'            => 'control',
				'active_callback' => 'frameme_is_footer_area_enable',
			),
			'footer_widgets_bg' => array(
				'title'           => esc_html__( 'Footer Widgets Area Background color', 'frameme' ),
				'section'         => 'footer_styles',
				'default'         => '#f1ede8',
				'field'           => 'hex_color',
				'type'            => 'control',
				'active_callback' => 'frameme_is_footer_area_enable',
			),
			'footer_menu_visibility' => array(
				'title'   => esc_html__( 'Show Footer Menu', 'frameme' ),
				'section' => 'footer_styles',
				'default' => false,
				'field'   => 'checkbox',
				'type'    => 'control',
			),

			/** `Footer contact block` section */
			'footer_contact_block' => array(
				'title'    => esc_html__( 'Footer Contact Block', 'frameme' ),
				'priority' => 10,
				'panel'    => 'footer_options',
				'type'     => 'section',
			),
			'footer_contact_block_visibility' => array(
				'title'   => esc_html__( 'Show Footer Contact Block', 'frameme' ),
				'section' => 'footer_contact_block',
				'default' => false,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'footer_contact_icon_1' => array(
				'title'           => esc_html__( 'Contact item 1', 'frameme' ),
				'description'     => esc_html__( 'Choose icon', 'frameme' ),
				'section'         => 'footer_contact_block',
				'field'           => 'iconpicker',
				'default'         => false,
				'icon_data'       => frameme_get_nc_outline_icons_data(),
				'type'            => 'control',
				'active_callback' => 'frameme_is_footer_contact_block_enable',
			),
			'footer_contact_label_1' => array(
				'title'           => '',
				'description'     => esc_html__( 'Label', 'frameme' ),
				'section'         => 'footer_contact_block',
				'default'         => false,
				'field'           => 'text',
				'type'            => 'control',
				'active_callback' => 'frameme_is_footer_contact_block_enable',
			),
			'footer_contact_text_1' => array(
				'title'           => '',
				'description'     => esc_html__( 'Value (HTML formatting support)', 'frameme' ),
				'section'         => 'footer_contact_block',
				'default'         => false,
				'field'           => 'textarea',
				'type'            => 'control',
				'active_callback' => 'frameme_is_footer_contact_block_enable',
			),
			'footer_contact_icon_2' => array(
				'title'           => esc_html__( 'Contact item 2', 'frameme' ),
				'description'     => esc_html__( 'Choose icon', 'frameme' ),
				'section'         => 'footer_contact_block',
				'field'           => 'iconpicker',
				'default'         => false,
				'icon_data'       => frameme_get_nc_outline_icons_data(),
				'type'            => 'control',
				'active_callback' => 'frameme_is_footer_contact_block_enable',
			),
			'footer_contact_label_2' => array(
				'title'           => '',
				'description'     => esc_html__( 'Label', 'frameme' ),
				'section'         => 'footer_contact_block',
				'default'         => false,
				'field'           => 'text',
				'type'            => 'control',
				'active_callback' => 'frameme_is_footer_contact_block_enable',
			),
			'footer_contact_text_2' => array(
				'title'           => '',
				'description'     => esc_html__( 'Value (HTML formatting support)', 'frameme' ),
				'section'         => 'footer_contact_block',
				'default'         => false,
				'field'           => 'textarea',
				'type'            => 'control',
				'active_callback' => 'frameme_is_footer_contact_block_enable',
			),
			'footer_contact_icon_3' => array(
				'title'           => esc_html__( 'Contact item 3', 'frameme' ),
				'description'     => esc_html__( 'Choose icon', 'frameme' ),
				'section'         => 'footer_contact_block',
				'field'           => 'iconpicker',
				'default'         => false,
				'icon_data'       => frameme_get_nc_outline_icons_data(),
				'type'            => 'control',
				'active_callback' => 'frameme_is_footer_contact_block_enable',
			),
			'footer_contact_label_3' => array(
				'title'           => '',
				'description'     => esc_html__( 'Label', 'frameme' ),
				'section'         => 'footer_contact_block',
				'default'         => false,
				'field'           => 'text',
				'type'            => 'control',
				'active_callback' => 'frameme_is_footer_contact_block_enable',
			),
			'footer_contact_text_3' => array(
				'title'           => '',
				'description'     => esc_html__( 'Value (HTML formatting support)', 'frameme' ),
				'section'         => 'footer_contact_block',
				'default'         => false,
				'field'           => 'textarea',
				'type'            => 'control',
				'active_callback' => 'frameme_is_footer_contact_block_enable',
			),

			/** `Blog Settings` panel */
			'blog_settings' => array(
				'title'    => esc_html__( 'Blog Settings', 'frameme' ),
				'priority' => 115,
				'type'     => 'panel',
			),

			/** `Blog` section */
			'blog' => array(
				'title'           => esc_html__( 'Blog', 'frameme' ),
				'panel'           => 'blog_settings',
				'priority'        => 10,
				'type'            => 'section',
				'active_callback' => 'is_home',
			),
			'blog_layout_type' => array(
				'title'   => esc_html__( 'Layout', 'frameme' ),
				'section' => 'blog',
				'default' => 'default',
				'field'   => 'select',
				'choices' => array(
					'default'          => esc_html__( 'Listing', 'frameme' ),
					'default-modern'   => esc_html__( 'Modern Listing', 'frameme' ),
					'grid'             => esc_html__( 'Grid', 'frameme' ),
					'masonry'          => esc_html__( 'Masonry', 'frameme' ),
					'vertical-justify' => esc_html__( 'Vertical Justify', 'frameme' ),
				),
				'type' => 'control',
			),
			'blog_layout_columns' => array(
				'title'           => esc_html__( 'Columns', 'frameme' ),
				'section'         => 'blog',
				'default'         => '3-cols',
				'field'           => 'select',
				'choices'         => array(
					'2-cols' => esc_html__( '2 columns', 'frameme' ),
					'3-cols' => esc_html__( '3 columns', 'frameme' ),
				),
				'type'            => 'control',
				'active_callback' => 'frameme_is_blog_layout_type_grid_masonry',
			),
			'blog_sticky_type' => array(
				'title'   => esc_html__( 'Sticky label type', 'frameme' ),
				'section' => 'blog',
				'default' => 'icon',
				'field'   => 'select',
				'choices' => array(
					'label' => esc_html__( 'Text Label', 'frameme' ),
					'icon'  => esc_html__( 'Font Icon', 'frameme' ),
					'both'  => esc_html__( 'Text with Icon', 'frameme' ),
				),
				'type' => 'control',
			),
			'blog_sticky_icon' => array(
				'title'           => esc_html__( 'Icon for sticky post', 'frameme' ),
				'section'         => 'blog',
				'field'           => 'iconpicker',
				'default'         => 'ui-2_favourite-31',
				'icon_data'       => frameme_get_nc_mini_icons_data(),
				'type'            => 'control',
				'active_callback' => 'frameme_is_sticky_icon',
			),
			'blog_sticky_label' => array(
				'title'           => esc_html__( 'Featured Post Label', 'frameme' ),
				'description'     => esc_html__( 'Label for sticky post', 'frameme' ),
				'section'         => 'blog',
				'default'         => esc_html__( 'Featured', 'frameme' ),
				'field'           => 'text',
				'active_callback' => 'frameme_is_sticky_text',
				'type'            => 'control',
			),
			'blog_featured_image' => array(
				'title'           => esc_html__( 'Featured image', 'frameme' ),
				'section'         => 'blog',
				'default'         => 'fullwidth',
				'field'           => 'select',
				'choices'         => array(
					'small'     => esc_html__( 'Small', 'frameme' ),
					'fullwidth' => esc_html__( 'Fullwidth', 'frameme' ),
				),
				'type'            => 'control',
				'active_callback' => 'frameme_is_blog_featured_image',
			),
			'blog_posts_content' => array(
				'title'   => esc_html__( 'Post content', 'frameme' ),
				'section' => 'blog',
				'default' => 'excerpt',
				'field'   => 'select',
				'choices' => array(
					'excerpt' => esc_html__( 'Only excerpt', 'frameme' ),
					'full'    => esc_html__( 'Full content', 'frameme' ),
					'none'    => esc_html__( 'Hide', 'frameme' ),
				),
				'type' => 'control',
			),
			'blog_posts_content_length' => array(
				'title'           => esc_html__( 'Number of words in the excerpt', 'frameme' ),
				'section'         => 'blog',
				'default'         => '30',
				'field'           => 'number',
				'input_attrs'     => array(
					'min'  => 1,
					'max'  => 100,
					'step' => 1,
				),
				'type'            => 'control',
				'active_callback' => 'frameme_is_blog_posts_content_type_excerpt',
			),
			'blog_read_more_btn' => array(
				'title'   => esc_html__( 'Show Read More button', 'frameme' ),
				'section' => 'blog',
				'default' => false,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'blog_read_more_text' => array(
				'title'           => esc_html__( 'Read More button text', 'frameme' ),
				'section'         => 'blog',
				'default'         => esc_html__( 'Read more', 'frameme' ),
				'field'           => 'text',
				'type'            => 'control',
				'active_callback' => 'frameme_is_blog_read_more_btn_enable',
			),
			'blog_post_author' => array(
				'title'   => esc_html__( 'Show post author', 'frameme' ),
				'section' => 'blog',
				'default' => true,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'blog_post_publish_date' => array(
				'title'   => esc_html__( 'Show publish date', 'frameme' ),
				'section' => 'blog',
				'default' => true,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'blog_post_categories' => array(
				'title'   => esc_html__( 'Show categories', 'frameme' ),
				'section' => 'blog',
				'default' => true,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'blog_post_tags' => array(
				'title'   => esc_html__( 'Show tags', 'frameme' ),
				'section' => 'blog',
				'default' => false,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'blog_post_comments' => array(
				'title'   => esc_html__( 'Show comments', 'frameme' ),
				'section' => 'blog',
				'default' => false,
				'field'   => 'checkbox',
				'type'    => 'control',
			),

			/** `Post` section */
			'blog_post' => array(
				'title'           => esc_html__( 'Post', 'frameme' ),
				'panel'           => 'blog_settings',
				'priority'        => 20,
				'type'            => 'section',
				'active_callback' => 'callback_single',
			),
			'single_post_author' => array(
				'title'   => esc_html__( 'Show post author', 'frameme' ),
				'section' => 'blog_post',
				'default' => true,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'single_post_publish_date' => array(
				'title'   => esc_html__( 'Show publish date', 'frameme' ),
				'section' => 'blog_post',
				'default' => true,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'single_post_categories' => array(
				'title'   => esc_html__( 'Show categories', 'frameme' ),
				'section' => 'blog_post',
				'default' => true,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'single_post_tags' => array(
				'title'   => esc_html__( 'Show tags', 'frameme' ),
				'section' => 'blog_post',
				'default' => true,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'single_post_comments' => array(
				'title'   => esc_html__( 'Show comments', 'frameme' ),
				'section' => 'blog_post',
				'default' => false,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'single_author_block' => array(
				'title'   => esc_html__( 'Enable the author block after each post', 'frameme' ),
				'section' => 'blog_post',
				'default' => true,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'single_post_navigation' => array(
				'title'   => esc_html__( 'Enable post navigation', 'frameme' ),
				'section' => 'blog_post',
				'default' => true,
				'field'   => 'checkbox',
				'type'    => 'control',
			),

			/** `Related Posts` section */
			'related_posts' => array(
				'title'           => esc_html__( 'Related posts block', 'frameme' ),
				'panel'           => 'blog_settings',
				'priority'        => 30,
				'type'            => 'section',
				'active_callback' => 'callback_single',
			),
			'related_posts_visible' => array(
				'title'   => esc_html__( 'Show related posts block', 'frameme' ),
				'section' => 'related_posts',
				'default' => true,
				'field'   => 'checkbox',
				'type'    => 'control',
			),
			'related_posts_block_title' => array(
				'title'           => esc_html__( 'Related posts block title', 'frameme' ),
				'section'         => 'related_posts',
				'default'         => esc_html__( 'Latest posts', 'frameme' ),
				'field'           => 'text',
				'type'            => 'control',
				'active_callback' => 'frameme_is_related_posts_enable',
			),
			'related_posts_count' => array(
				'title'           => esc_html__( 'Number of post', 'frameme' ),
				'section'         => 'related_posts',
				'default'         => '2',
				'field'           => 'text',
				'type'            => 'control',
				'active_callback' => 'frameme_is_related_posts_enable',
			),
			'related_posts_grid' => array(
				'title'           => esc_html__( 'Layout', 'frameme' ),
				'section'         => 'related_posts',
				'default'         => '2',
				'field'           => 'select',
				'choices'         => array(
					'2' => esc_html__( '2 columns', 'frameme' ),
					'3' => esc_html__( '3 columns', 'frameme' ),
					'4' => esc_html__( '4 columns', 'frameme' ),
				),
				'type'            => 'control',
				'active_callback' => 'frameme_is_related_posts_enable',
			),
			'related_posts_title' => array(
				'title'           => esc_html__( 'Show post title', 'frameme' ),
				'section'         => 'related_posts',
				'default'         => true,
				'field'           => 'checkbox',
				'type'            => 'control',
				'active_callback' => 'frameme_is_related_posts_enable',
			),
			'related_posts_title_length' => array(
				'title'           => esc_html__( 'Number of words in the title', 'frameme' ),
				'section'         => 'related_posts',
				'default'         => '10',
				'field'           => 'text',
				'type'            => 'control',
				'active_callback' => 'frameme_is_related_posts_enable',
			),
			'related_posts_image' => array(
				'title'           => esc_html__( 'Show post image', 'frameme' ),
				'section'         => 'related_posts',
				'default'         => true,
				'field'           => 'checkbox',
				'type'            => 'control',
				'active_callback' => 'frameme_is_related_posts_enable',
			),
			'related_posts_content' => array(
				'title'           => esc_html__( 'Display content', 'frameme' ),
				'section'         => 'related_posts',
				'default'         => 'hide',
				'field'           => 'select',
				'choices'         => array(
					'hide'         => esc_html__( 'Hide', 'frameme' ),
					'post_excerpt' => esc_html__( 'Excerpt', 'frameme' ),
					'post_content' => esc_html__( 'Content', 'frameme' ),
				),
				'type'            => 'control',
				'active_callback' => 'frameme_is_related_posts_enable',
			),
			'related_posts_content_length' => array(
				'title'           => esc_html__( 'Number of words in the content', 'frameme' ),
				'section'         => 'related_posts',
				'default'         => '10',
				'field'           => 'text',
				'type'            => 'control',
				'active_callback' => 'frameme_is_related_posts_enable',
			),
			'related_posts_categories' => array(
				'title'           => esc_html__( 'Show post categories', 'frameme' ),
				'section'         => 'related_posts',
				'default'         => true,
				'field'           => 'checkbox',
				'type'            => 'control',
				'active_callback' => 'frameme_is_related_posts_enable',
			),
			'related_posts_tags' => array(
				'title'           => esc_html__( 'Show post tags', 'frameme' ),
				'section'         => 'related_posts',
				'default'         => false,
				'field'           => 'checkbox',
				'type'            => 'control',
				'active_callback' => 'frameme_is_related_posts_enable',
			),
			'related_posts_author' => array(
				'title'           => esc_html__( 'Show post author', 'frameme' ),
				'section'         => 'related_posts',
				'default'         => true,
				'field'           => 'checkbox',
				'type'            => 'control',
				'active_callback' => 'frameme_is_related_posts_enable',
			),
			'related_posts_publish_date' => array(
				'title'           => esc_html__( 'Show post publish date', 'frameme' ),
				'section'         => 'related_posts',
				'default'         => true,
				'field'           => 'checkbox',
				'type'            => 'control',
				'active_callback' => 'frameme_is_related_posts_enable',
			),
			'related_posts_comment_count' => array(
				'title'           => esc_html__( 'Show post comment count', 'frameme' ),
				'section'         => 'related_posts',
				'default'         => false,
				'field'           => 'checkbox',
				'type'            => 'control',
				'active_callback' => 'frameme_is_related_posts_enable',
			),
			/** `404` panel */
			'page_404_options' => array(
				'title'    => esc_html__( '404 Page Style', 'frameme' ),
				'priority' => 130,
				'type'     => 'section',
			),
			'page_404_bg_color' => array(
				'title'   => esc_html__( 'Background Color', 'frameme' ),
				'section' => 'page_404_options',
				'field'   => 'hex_color',
				'default' => '#ffffff',
				'type'    => 'control',
			),
			'page_404_image' => array(
				'title'   => esc_html__( '404 Image', 'frameme' ),
				'section' => 'page_404_options',
				'field'   => 'image',
				'default' => '%s/assets/images/404.jpg',
				'type'    => 'control',
			),
			'page_404_text_color' => array(
				'title'       => esc_html__( 'Text Color', 'frameme' ),
				'description' => esc_html__( 'Here you can choose whether your text should be light or dark. If you are working with a dark background, then your text should be light. If your background is light, then your text should be set to dark.', 'frameme' ),
				'section'     => 'page_404_options',
				'default'     => 'light',
				'field'       => 'select',
				'choices'     => frameme_get_text_color(),
				'type'        => 'control',
			),
			'page_404_btn_style_preset' => array(
				'title'   => esc_html__( 'Button Style Preset', 'frameme' ),
				'section' => 'page_404_options',
				'default' => 'accent-1',
				'field'   => 'select',
				'choices' => frameme_get_btn_style_presets(),
				'type'    => 'control',
			),
		),
	) );
}

/**
 * Return true if setting is value. Otherwise - return false.
 *
 * @param  object $control Parent control.
 * @param  string $setting Setting name to check.
 * @param  string $value   Setting value to compare.
 * @return bool
 */
function frameme_is_setting( $control, $setting, $value ) {

	if ( $value == $control->manager->get_setting( $setting )->value() ) {
		return true;
	}

	return false;
}

/**
 * Return true if value of passed setting is not equal with passed value.
 *
 * @param  object $control Parent control.
 * @param  string $setting Setting name to check.
 * @param  string $value   Setting value to compare.
 * @return bool
 */
function frameme_is_not_setting( $control, $setting, $value ) {

	if ( $value !== $control->manager->get_setting( $setting )->value() ) {
		return true;
	}

	return false;
}

/**
 * Return true if logo in header has image type. Otherwise - return false.
 *
 * @param  object $control Parent control.
 * @return bool
 */
function frameme_is_header_logo_image( $control ) {
	return frameme_is_setting( $control, 'header_logo_type', 'image' );
}

/**
 * Return true if logo in header has text type. Otherwise - return false.
 *
 * @param  object $control Parent control.
 * @return bool
 */
function frameme_is_header_logo_text( $control ) {
	return frameme_is_setting( $control, 'header_logo_type', 'text' );
}

/**
 * Return blog-featured-image true if blog layout type is default. Otherwise - return false.
 *
 * @param  object $control Parent control.
 * @return bool
 */
function frameme_is_blog_featured_image( $control ) {
	return frameme_is_setting( $control, 'blog_layout_type', 'default' );
}

/**
 * Return true if sticky label type set to text or text with icon.
 *
 * @param  object $control Parent control.
 * @return bool
 */
function frameme_is_sticky_text( $control ) {
	return frameme_is_not_setting( $control, 'blog_sticky_type', 'icon' );
}

/**
 * Return true if sticky label type set to icon or text with icon.
 *
 * @param  object $control Parent control.
 * @return bool
 */
function frameme_is_sticky_icon( $control ) {
	return frameme_is_not_setting( $control, 'blog_sticky_type', 'label' );
}

/**
 * Return true if More button (in the main menu) has image type. Otherwise - return false.
 *
 * @param  object $control Parent control.
 * @return bool
 */
function frameme_is_more_button_type_image( $control ) {
	return frameme_is_setting( $control, 'more_button_type', 'image' );
}

/**
 * Return true if More button (in the main menu) has text type. Otherwise - return false.
 *
 * @param  object $control Parent control.
 * @return bool
 */
function frameme_is_more_button_type_text( $control ) {
	return frameme_is_setting( $control, 'more_button_type', 'text' );
}

/**
 * Return true if More button (in the main menu) has icon type. Otherwise - return false.
 *
 * @param  object $control Parent control.
 * @return bool
 */
function frameme_is_more_button_type_icon( $control ) {
	return frameme_is_setting( $control, 'more_button_type', 'icon' );
}

/**
 * Return true if option Show header call to action button is enable. Otherwise - return false.
 *
 * @param  object $control Parent control.
 * @return bool
 */
function frameme_is_header_btn_enable( $control ) {
	return frameme_is_setting( $control, 'header_btn_visibility', true );
}

/**
 * Return true if option Add button icon is enable. Otherwise - return false.
 *
 * @param  object $control Parent control.
 * @return bool
 */
function frameme_is_header_btn_icon_enable( $control ) {
	return frameme_is_setting( $control, 'header_btn_visibility', true ) && frameme_is_setting( $control, 'header_btn_add_btn_icon', true );
}

/**
 * Return true if option Show Header Contact Block is enable. Otherwise - return false.
 *
 * @param  object $control Parent control.
 * @return bool
 */
function frameme_is_header_contact_block_enable( $control ) {
	return frameme_is_setting( $control, 'header_contact_block_visibility', true );
}

/**
 * Return true if option Show Top panel Contact Block is enable. Otherwise - return false.
 *
 * @param  object $control Parent control.
 * @return bool
 */
function frameme_is_top_panel_contact_block_enable( $control ) {
	return frameme_is_setting( $control, 'header_top_panel_contact_block_visibility', true );
}

/**
 * Return true if option Show Footer Contact Block is enable. Otherwise - return false.
 *
 * @param  object $control Parent control.
 * @return bool
 */
function frameme_is_footer_contact_block_enable( $control ) {
	return frameme_is_setting( $control, 'footer_contact_block_visibility', true );
}

/**
 * Return true if option Show Related Posts Block is enable. Otherwise - return false.
 *
 * @param  object $control Parent control.
 * @return bool
 */
function frameme_is_related_posts_enable( $control ) {
	return frameme_is_setting( $control, 'related_posts_visible', true );
}

/**
 * Return true if option Enable Top Panel is enable. Otherwise - return false.
 *
 * @param  object $control Parent control.
 * @return bool
 */
function frameme_is_top_panel_enable( $control ) {
	return frameme_is_setting( $control, 'top_panel_visibility', true );
}

/**
 * Return true if option Show header call to action button is enable. Otherwise - return false.
 *
 * @param  object $control Parent control.
 * @return bool
 */
function frameme_is_header_btn_visible( $control ) {
	return frameme_is_setting( $control, 'header_btn_visibility', true );
}

/**
 * Return true if option Show Footer Logo is enable. Otherwise - return false.
 *
 * @param  object $control Parent control.
 * @return bool
 */
function frameme_is_footer_logo_enable( $control ) {
	return frameme_is_setting( $control, 'footer_logo_visibility', true );
}

/**
 * Return true if option Show Footer Widgets Area is enable. Otherwise - return false.
 *
 * @param  object $control Parent control.
 * @return bool
 */
function frameme_is_footer_area_enable( $control ) {
	return frameme_is_setting( $control, 'footer_widget_area_visibility', true );
}

/**
 * Return true if option Footer style is layout-1. Otherwise - return false.
 *
 * @param  object $control Parent control.
 * @return bool
 */
function frameme_is_footer_style_1_enable( $control ) {
	return frameme_is_setting( $control, 'footer_layout_type', 'style-1' );
}

/**
 * Return true if option Blog posts content is excerpt. Otherwise - return false.
 *
 * @param  object $control Parent control.
 * @return bool
 */
function frameme_is_blog_posts_content_type_excerpt( $control ) {
	return frameme_is_setting( $control, 'blog_posts_content', 'excerpt' );
}

/**
 * Return true if option Show Read More button is enable. Otherwise - return false.
 *
 * @param  object $control Parent control.
 * @return bool
 */
function frameme_is_blog_read_more_btn_enable( $control ) {
	return frameme_is_setting( $control, 'blog_read_more_btn', true );
}

/**
 * Return true if Blog layout selected Grid or Masonry. Otherwise - return false.
 *
 * @param  object $control Parent control.
 * @return bool
 */
function frameme_is_blog_layout_type_grid_masonry( $control ) {
	if ( in_array( $control->manager->get_setting( 'blog_layout_type' )->value(), array( 'grid', 'masonry' ) ) ) {
		return true;
	}

	return false;
}

/**
 * Return true if option Header Layout type is style-5. Otherwise - return false.
 *
 * @param  object $control Parent control.
 * @return bool
 */
function frameme_is_header_layout_style_5( $control ) {
	return frameme_is_setting( $control, 'header_layout_type', 'style-5' );
}

/**
 * Get default header layouts.
 *
 * @since  1.0.0
 * @return array
 */
function frameme_get_header_layout_options() {
	return apply_filters( 'frameme_header_layout_options', array(
		'style-1' => esc_html__( 'Style 1', 'frameme' ),
		'style-2' => esc_html__( 'Style 2', 'frameme' ),
		'style-3' => esc_html__( 'Style 3', 'frameme' ),
		'style-4' => esc_html__( 'Style 4', 'frameme' ),
		'style-5' => esc_html__( 'Style 5', 'frameme' ),
		'style-6' => esc_html__( 'Style 6', 'frameme' ),
		'style-7' => esc_html__( 'Style 7', 'frameme' ),
	) );
}

/**
 * Get default footer layouts.
 *
 * @since  1.0.0
 * @return array
 */
function frameme_get_footer_layout_options() {
	return apply_filters( 'frameme_footer_layout_options', array(
		'style-1' => esc_html__( 'Style 1', 'frameme' ),
		'style-2' => esc_html__( 'Style 2', 'frameme' ),
		'style-3' => esc_html__( 'Style 3', 'frameme' ),
	) );
}

/**
 * Get default header layouts options for Post Meta boxes
 *
 * @return array
 */
function frameme_get_header_layout_pm_options() {
	$inherit_option = array(
		'inherit' => array(
			'label' => esc_html__( 'Inherit', 'frameme' ),
		),
	);

	$header_layouts = frameme_get_header_layout_options();
	$options        = array();

	foreach ( $header_layouts as $layout => $label ) {
		$options[ $layout ] = array(
			'label' => $label,
			'slave' => 'header_layout_type_' . str_replace( '-', '_', $layout ),
		);
	}

	return array_merge( $inherit_option, $options );
}

/**
 * Get default footer layouts options for Post Meta boxes
 *
 * @return array
 */
function frameme_get_footer_layout_pm_options() {
	$inherit_option = array(
		'inherit' => esc_html__( 'Inherit', 'frameme' ),
	);

	$options = frameme_get_footer_layout_options();

	return array_merge( $inherit_option, $options );
}

// Change native customizer control (based on WordPress core).
add_action( 'customize_register', 'frameme_customizer_change_core_controls', 20 );

// Bind JS handlers to instantly live-preview changes.
add_action( 'customize_preview_init', 'frameme_customize_preview_js' );

/**
 * Change native customize control (based on WordPress core).
 *
 * @since 1.0.0
 * @param  object $wp_customize Object wp_customize.
 * @return void
 */
function frameme_customizer_change_core_controls( $wp_customize ) {
	$wp_customize->get_control( 'site_icon' )->section         = 'frameme_logo_favicon';
	$wp_customize->get_section( 'background_image' )->priority = 45;
	$wp_customize->get_control( 'background_color' )->label    = esc_html__( 'Body Background Color', 'frameme' );

	$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
}

/**
 * Bind JS handlers to instantly live-preview changes.
 */
function frameme_customize_preview_js() {
	wp_enqueue_script( 'frameme-customize-preview', FRAMEME_THEME_JS . '/customize-preview.js', array( 'customize-preview' ), '1.0', true );
}

// Typography utility function
/**
 * Get font styles
 *
 * @since 1.0.0
 * @return array
 */
function frameme_get_font_styles() {
	return apply_filters( 'frameme_get_font_styles', array(
		'normal'  => esc_html__( 'Normal', 'frameme' ),
		'italic'  => esc_html__( 'Italic', 'frameme' ),
		'oblique' => esc_html__( 'Oblique', 'frameme' ),
		'inherit' => esc_html__( 'Inherit', 'frameme' ),
	) );
}

/**
 * Get character sets
 *
 * @since 1.0.0
 * @return array
 */
function frameme_get_character_sets() {
	return apply_filters( 'frameme_get_character_sets', array(
		'latin'        => esc_html__( 'Latin', 'frameme' ),
		'greek'        => esc_html__( 'Greek', 'frameme' ),
		'greek-ext'    => esc_html__( 'Greek Extended', 'frameme' ),
		'vietnamese'   => esc_html__( 'Vietnamese', 'frameme' ),
		'cyrillic-ext' => esc_html__( 'Cyrillic Extended', 'frameme' ),
		'latin-ext'    => esc_html__( 'Latin Extended', 'frameme' ),
		'cyrillic'     => esc_html__( 'Cyrillic', 'frameme' ),
	) );
}

/**
 * Get text aligns
 *
 * @since 1.0.0
 * @return array
 */
function frameme_get_text_aligns() {
	return apply_filters( 'frameme_get_text_aligns', array(
		'inherit' => esc_html__( 'Inherit', 'frameme' ),
		'center'  => esc_html__( 'Center', 'frameme' ),
		'justify' => esc_html__( 'Justify', 'frameme' ),
		'left'    => esc_html__( 'Left', 'frameme' ),
		'right'   => esc_html__( 'Right', 'frameme' ),
	) );
}

/**
 * Get font weights
 *
 * @since 1.0.0
 * @return array
 */
function frameme_get_font_weight() {
	return apply_filters( 'frameme_get_font_weight', array(
		'100' => '100',
		'200' => '200',
		'300' => '300',
		'400' => '400',
		'500' => '500',
		'600' => '600',
		'700' => '700',
		'800' => '800',
		'900' => '900',
	) );
}

// Background utility function
/**
 * Get background position
 *
 * @since 1.0.0
 * @return array
 */
function frameme_get_bg_position() {
	return apply_filters( 'frameme_get_bg_position', array(
		'top-left'      => esc_html__( 'Top Left', 'frameme' ),
		'top-center'    => esc_html__( 'Top Center', 'frameme' ),
		'top-right'     => esc_html__( 'Top Right', 'frameme' ),
		'center-left'   => esc_html__( 'Middle Left', 'frameme' ),
		'center'        => esc_html__( 'Middle Center', 'frameme' ),
		'center-right'  => esc_html__( 'Middle Right', 'frameme' ),
		'bottom-left'   => esc_html__( 'Bottom Left', 'frameme' ),
		'bottom-center' => esc_html__( 'Bottom Center', 'frameme' ),
		'bottom-right'  => esc_html__( 'Bottom Right', 'frameme' ),
	) );
}

/**
 * Get background size
 *
 * @since 1.0.0
 * @return array
 */
function frameme_get_bg_size() {
	return apply_filters( 'frameme_get_bg_size', array(
		'auto'    => esc_html__( 'Auto', 'frameme' ),
		'cover'   => esc_html__( 'Cover', 'frameme' ),
		'contain' => esc_html__( 'Contain', 'frameme' ),
	) );
}

/**
 * Get background repeat
 *
 * @since 1.0.0
 * @return array
 */
function frameme_get_bg_repeat() {
	return apply_filters( 'frameme_get_bg_repeat', array(
		'no-repeat' => esc_html__( 'No Repeat', 'frameme' ),
		'repeat'    => esc_html__( 'Tile', 'frameme' ),
		'repeat-x'  => esc_html__( 'Tile Horizontally', 'frameme' ),
		'repeat-y'  => esc_html__( 'Tile Vertically', 'frameme' ),
	) );
}

/**
 * Get background attachment
 *
 * @since 1.0.0
 * @return array
 */
function frameme_get_bg_attachment() {
	return apply_filters( 'frameme_get_bg_attachment', array(
		'scroll' => esc_html__( 'Scroll', 'frameme' ),
		'fixed'  => esc_html__( 'Fixed', 'frameme' ),
	) );
}

/**
 * Get text color
 *
 * @since 1.0.0
 * @return array
 */
function frameme_get_text_color() {
	return apply_filters( 'frameme_get_text_color', array(
		'light' => esc_html__( 'Light', 'frameme' ),
		'dark'  => esc_html__( 'Dark', 'frameme' ),
	) );
}

/**
 * Return array of arguments for dynamic CSS module
 *
 * @return array
 */
function frameme_get_dynamic_css_options() {
	return apply_filters( 'frameme_get_dynamic_css_options', array(
		'prefix'        => 'frameme',
		'type'          => 'theme_mod',
		'parent_handle' => 'frameme-theme-style',
		'single'        => true,
		'css_files'     => array(
			FRAMEME_THEME_DIR . '/assets/css/dynamic.css',

			FRAMEME_THEME_DIR . '/assets/css/dynamic/site/elements.css',
			FRAMEME_THEME_DIR . '/assets/css/dynamic/site/header.css',
			FRAMEME_THEME_DIR . '/assets/css/dynamic/site/forms.css',
			FRAMEME_THEME_DIR . '/assets/css/dynamic/site/social.css',
			FRAMEME_THEME_DIR . '/assets/css/dynamic/site/menus.css',
			FRAMEME_THEME_DIR . '/assets/css/dynamic/site/post.css',
			FRAMEME_THEME_DIR . '/assets/css/dynamic/site/navigation.css',
			FRAMEME_THEME_DIR . '/assets/css/dynamic/site/footer.css',
			FRAMEME_THEME_DIR . '/assets/css/dynamic/site/misc.css',
			FRAMEME_THEME_DIR . '/assets/css/dynamic/site/buttons.css',

			FRAMEME_THEME_DIR . '/assets/css/dynamic/widgets/widget-default.css',
			FRAMEME_THEME_DIR . '/assets/css/dynamic/widgets/taxonomy-tiles.css',
			FRAMEME_THEME_DIR . '/assets/css/dynamic/widgets/image-grid.css',
			FRAMEME_THEME_DIR . '/assets/css/dynamic/widgets/carousel.css',
			FRAMEME_THEME_DIR . '/assets/css/dynamic/widgets/smart-slider.css',
			FRAMEME_THEME_DIR . '/assets/css/dynamic/widgets/instagram.css',
			FRAMEME_THEME_DIR . '/assets/css/dynamic/widgets/subscribe.css',
			FRAMEME_THEME_DIR . '/assets/css/dynamic/widgets/custom-posts.css',
			FRAMEME_THEME_DIR . '/assets/css/dynamic/widgets/playlist-slider.css',
			FRAMEME_THEME_DIR . '/assets/css/dynamic/widgets/featured-posts-block.css',
			FRAMEME_THEME_DIR . '/assets/css/dynamic/widgets/news-smart-box.css',
			FRAMEME_THEME_DIR . '/assets/css/dynamic/widgets/contact-information.css',
		),
		'options' => array(
			'header_logo_font_style',
			'header_logo_font_weight',
			'header_logo_font_size',
			'header_logo_font_family',

			'body_font_style',
			'body_font_weight',
			'body_font_size',
			'body_line_height',
			'body_font_family',
			'body_letter_spacing',
			'body_text_align',

			'h1_font_style',
			'h1_font_weight',
			'h1_font_size',
			'h1_line_height',
			'h1_font_family',
			'h1_letter_spacing',
			'h1_text_align',

			'h2_font_style',
			'h2_font_weight',
			'h2_font_size',
			'h2_line_height',
			'h2_font_family',
			'h2_letter_spacing',
			'h2_text_align',

			'h3_font_style',
			'h3_font_weight',
			'h3_font_size',
			'h3_line_height',
			'h3_font_family',
			'h3_letter_spacing',
			'h3_text_align',

			'h4_font_style',
			'h4_font_weight',
			'h4_font_size',
			'h4_line_height',
			'h4_font_family',
			'h4_letter_spacing',
			'h4_text_align',

			'h5_font_style',
			'h5_font_weight',
			'h5_font_size',
			'h5_line_height',
			'h5_font_family',
			'h5_letter_spacing',
			'h5_text_align',

			'h6_font_style',
			'h6_font_weight',
			'h6_font_size',
			'h6_line_height',
			'h6_font_family',
			'h6_letter_spacing',
			'h6_text_align',

			'breadcrumbs_font_style',
			'breadcrumbs_font_weight',
			'breadcrumbs_font_size',
			'breadcrumbs_line_height',
			'breadcrumbs_font_family',
			'breadcrumbs_letter_spacing',
			'breadcrumbs_bg_color',
			'breadcrumbs_bg_repeat',
			'breadcrumbs_bg_position',
			'breadcrumbs_bg_attachment',
			'breadcrumbs_bg_size',
			'breadcrumbs_bg_image_opacity',

			'meta_font_style',
			'meta_font_weight',
			'meta_font_size',
			'meta_line_height',
			'meta_font_family',
			'meta_letter_spacing',

			'main_menu_font_style',
			'main_menu_font_weight',
			'main_menu_font_size',
			'main_menu_line_height',
			'main_menu_font_family',
			'main_menu_letter_spacing',

			'regular_accent_color_1',
			'regular_accent_color_2',
			'regular_accent_color_3',
			'regular_accent_color_4',
			'regular_text_color',
			'regular_link_color',
			'regular_link_hover_color',
			'regular_h1_color',
			'regular_h2_color',
			'regular_h3_color',
			'regular_h4_color',
			'regular_h5_color',
			'regular_h6_color',

			'invert_accent_color_1',
			'invert_text_color',
			'invert_link_color',
			'invert_link_hover_color',
			'invert_h1_color',
			'invert_h2_color',
			'invert_h3_color',
			'invert_h4_color',
			'invert_h5_color',
			'invert_h6_color',

			'grey_color_1',
			'grey_color_2',
			'grey_color_3',

			'header_bg_color',
			'header_bg_image',
			'header_bg_repeat',
			'header_bg_position',
			'header_bg_attachment',
			'header_bg_size',

			'page_404_bg_color',

			'top_panel_bg',

			'container_width',

			'footer_widgets_bg',
			'footer_bg_first',
			'footer_bg',

			'onsale_badge_bg',
			'featured_badge_bg',
			'new_badge_bg',
		),
	) );
}

/**
 * Return array of arguments for Google Font loader module.
 *
 * @since  1.0.0
 * @return array
 */
function frameme_get_fonts_options() {
	return apply_filters( 'frameme_get_fonts_options', array(
		'prefix'  => 'frameme',
		'type'    => 'theme_mod',
		'single'  => true,
		'options' => array(
			'body' => array(
				'family'  => 'body_font_family',
				'style'   => 'body_font_style',
				'weight'  => 'body_font_weight',
				'charset' => 'body_character_set',
			),
			'h1' => array(
				'family'  => 'h1_font_family',
				'style'   => 'h1_font_style',
				'weight'  => 'h1_font_weight',
				'charset' => 'h1_character_set',
			),
			'h2' => array(
				'family'  => 'h2_font_family',
				'style'   => 'h2_font_style',
				'weight'  => 'h2_font_weight',
				'charset' => 'h2_character_set',
			),
			'h3' => array(
				'family'  => 'h3_font_family',
				'style'   => 'h3_font_style',
				'weight'  => 'h3_font_weight',
				'charset' => 'h3_character_set',
			),
			'h4' => array(
				'family'  => 'h4_font_family',
				'style'   => 'h4_font_style',
				'weight'  => 'h4_font_weight',
				'charset' => 'h4_character_set',
			),
			'h5' => array(
				'family'  => 'h5_font_family',
				'style'   => 'h5_font_style',
				'weight'  => 'h5_font_weight',
				'charset' => 'h5_character_set',
			),
			'h6' => array(
				'family'  => 'h6_font_family',
				'style'   => 'h6_font_style',
				'weight'  => 'h6_font_weight',
				'charset' => 'h6_character_set',
			),
			'meta' => array(
				'family'  => 'meta_font_family',
				'style'   => 'meta_font_style',
				'weight'  => 'meta_font_weight',
				'charset' => 'meta_character_set',
			),
			'header_logo' => array(
				'family'  => 'header_logo_font_family',
				'style'   => 'header_logo_font_style',
				'weight'  => 'header_logo_font_weight',
				'charset' => 'header_logo_character_set',
			),
			'breadcrumbs' => array(
				'family'  => 'breadcrumbs_font_family',
				'style'   => 'breadcrumbs_font_style',
				'weight'  => 'breadcrumbs_font_weight',
				'charset' => 'breadcrumbs_character_set',
			),
		),
	) );
}

/**
 * Get default footer copyright.
 *
 * @since  1.0.0
 * @return string
 */
function frameme_get_default_footer_copyright() {
	return esc_html__( '&copy; %%year%% %%site-name%%. All Rights Reserved.', 'frameme' );
}

/**
 * Get default contact information.
 *
 * @since  1.0.0
 * @return string
 */
function frameme_get_default_contact_information( $value ) {
	$contact_information = array(
		'work-time' => sprintf( '%1$s<br>%2$s', esc_html__( 'Mon – Fri: 10AM – 7PM;', 'frameme' ), esc_html__( 'Sat – Sun: 10AM – 3PM', 'frameme' ) ),
		'phones'    => sprintf( '<a href="tel:#">%1$s</a>', esc_html__( '(719) 445-2808', 'frameme' ) ),
		'info'      => esc_html__( '24/7 Emergency Service', 'frameme' ),
		'address'   => sprintf( '%1$s<br>%2$s', esc_html__( '4578 Marmora Road,', 'frameme' ), esc_html__( 'Glasgow', 'frameme' ) ),
	);

	return $contact_information[ $value ];
}

/**
 * Get FontAwesome icons set
 *
 * @return array
 */
function frameme_get_icons_set() {

	static $font_icons;

	if ( ! $font_icons ) {

		ob_start();

		include FRAMEME_THEME_DIR . '/assets/js/icons.json';
		$json = ob_get_clean();

		$font_icons = array();
		$icons      = json_decode( $json, true );

		foreach ( $icons['icons'] as $icon ) {
			$font_icons[] = $icon['id'];
		}
	}

	return $font_icons;
}

/**
 * Get nc-outline icons set.
 *
 * @return array
 */
function frameme_get_nc_outline_icons_set() {

	static $nc_outline_icons;

	if ( ! $nc_outline_icons ) {
		ob_start();

		include FRAMEME_THEME_DIR . '/assets/css/nucleo-outline.css';

		$result = ob_get_clean();

		preg_match_all( '/\.([-_a-zA-Z0-9]+):before[, {]/', $result, $matches );

		if ( ! is_array( $matches ) || empty( $matches[1] ) ) {
			return;
		}

		$nc_outline_icons = $matches[1];
	}

	return $nc_outline_icons;
}

/**
 * Get nc-mini icons set.
 *
 * @return array
 */
function frameme_get_nc_mini_icons_set() {

	static $nc_mini_icons;

	if ( ! $nc_mini_icons ) {
		ob_start();

		include FRAMEME_THEME_DIR . '/assets/css/nucleo-mini.css';

		$result = ob_get_clean();

		preg_match_all( '/\.([-_a-zA-Z0-9]+):before[, {]/', $result, $matches );

		if ( ! is_array( $matches ) || empty( $matches[1] ) ) {
			return;
		}

		$nc_mini_icons = $matches[1];
	}

	return $nc_mini_icons;
}

/**
 * Get nc-outline icons data for iconpicker control.
 *
 * @return array
 */
function frameme_get_nc_outline_icons_data() {
	return apply_filters( 'frameme_nc_outline_icons_data', array(
		'icon_set'    => 'framemeNucleoOutlineIcons',
		'icon_css'    => FRAMEME_THEME_URI . '/assets/css/nucleo-outline.css',
		'icon_base'   => 'nc-icon-outline',
		'icon_prefix' => '',
		'icons'       => frameme_get_nc_outline_icons_set(),
	) );
}

/**
 * Get nc-mini icons data for iconpicker control.
 *
 * @return array
 */
function frameme_get_nc_mini_icons_data() {
	return apply_filters( 'frameme_nc_mini_icons_data', array(
		'icon_set'    => 'framemeNucleoMiniIcons',
		'icon_css'    => FRAMEME_THEME_URI . '/assets/css/nucleo-mini.css',
		'icon_base'   => 'nc-icon-mini',
		'icon_prefix' => '',
		'icons'       => frameme_get_nc_mini_icons_set(),
	) );
}

/**
 * Get header button style presets.
 *
 * @return array
 */
function frameme_get_btn_style_presets() {
	return apply_filters( 'frameme_get_btn_style_presets', array(
		'accent-1' => esc_html__( 'Accent button 1', 'frameme' ),
		'accent-2' => esc_html__( 'Accent button 2', 'frameme' ),
	) );
}

/**
 * Check if Cherry Services plugin is activated.
 */
function frameme_is_services_activated() {
	return class_exists( 'Cherry_Services_List' );
}

/**
 * Check if Cherry Projects plugin is activated.
 */
function frameme_is_projects_activated() {
	return class_exists( 'Cherry_Projects' );
}
