<?php
/**
 * TM-Wizard configuration.
 *
 * @var array
 *
 * @package Pipemaster
 */

$plugins = array(
	'cherry-data-importer' => array(
		'name'   => esc_html__( 'Cherry Data Importer', 'frameme' ),
		'source' => 'remote', // 'local', 'remote', 'wordpress' (default).
		'path'   => 'https://github.com/CherryFramework/cherry-data-importer/archive/master.zip',
		'access' => 'base',
	),
	'cherry-projects' => array(
		'name'   => esc_html__( 'Cherry Projects', 'frameme' ),
		'access' => 'skins',
	),
	'cherry-popups' => array(
		'name'   => esc_html__( 'Cherry PopUps', 'frameme' ),
		'access' => 'base',
	),
	'cherry-team-members' => array(
		'name'   => esc_html__( 'Cherry Team Members', 'frameme' ),
		'access' => 'skins',
	),
	'cherry-testi' => array(
		'name'   => esc_html__( 'Cherry Testimonials', 'frameme' ),
		'access' => 'skins',
	),
	'cherry-search' => array(
		'name'   => esc_html__( 'Cherry Search', 'frameme' ),
		'access' => 'skins',
	),
	'cherry-services-list' => array(
		'name'   => esc_html__( 'Cherry Services List', 'frameme' ),
		'access' => 'skins',
	),
	'cherry-sidebars' => array(
		'name'   => esc_html__( 'Cherry Sidebars', 'frameme' ),
		'access' => 'base',
	),
	'cherry-socialize' => array(
		'name'   => esc_html__( 'Cherry Socialize', 'frameme' ),
		'access' => 'skins',
	),
	'cherry-trending-posts' => array(
		'name'   => esc_html__( 'Cherry Trending Posts', 'frameme' ),
		'access' => 'skins',
	),
	'booked' => array(
		'name'   => esc_html__( 'Booked Appointments', 'frameme' ),
		'source' => 'local',
		'path'   => FRAMEME_THEME_DIR . '/assets/includes/plugins/booked.zip',
		'access' => 'skins',
	),
	'elementor' => array(
		'name'   => esc_html__( 'Elementor Page Builder', 'frameme' ),
		'access' => 'base',
	),
	'tm-mega-menu' => array(
		'name'   => esc_html__( 'TM Mega Menu', 'frameme' ),
		'source' => 'remote',
		'path'   => 'http://cloud.cherryframework.com/downloads/free-plugins/tm-mega-menu.zip',
		'access' => 'skins',
	),
	'jet-elements' => array(
		'name'   => esc_html__( 'Jet Elements addon For Elementor', 'frameme' ),
		'source' => 'local',
		'path'   => FRAMEME_THEME_DIR . '/assets/includes/plugins/jet-elements.zip',
		'access' => 'base',
	),
	'tm-photo-gallery' => array(
		'name'   => esc_html__( 'TM Photo Gallery', 'frameme' ),
		'access' => 'skins',
	),
	'tm-timeline' => array(
		'name'   => esc_html__( 'TM Timeline', 'frameme' ),
		'access' => 'skins',
	),
	'contact-form-7' => array(
		'name'   => esc_html__( 'Contact Form 7', 'frameme' ),
		'access' => 'skins',
	),
	'shortcode-widget' => array(
		'name'   => esc_html__( 'Shortcode Widget', 'frameme' ),
		'access' => 'skins',
	),
	'wordpress-social-login' => array(
		'name'   => esc_html__( 'WordPress Social Login', 'frameme' ),
		'access' => 'skins',
	),
);

/**
 * Skins configuration example
 *
 * @var array
 */
$skins = array(
	'base' => array(
		'cherry-data-importer',
		'cherry-popups',
		'elementor',
		'cherry-sidebars',
		'jet-elements',
	),
	'advanced' => array(
		'default' => array(
			'full'  => array(
				'cherry-projects',
				'cherry-team-members',
				'cherry-testi',
				'cherry-search',
				'cherry-services-list',
				'cherry-socialize',
				'cherry-trending-posts',
				'booked',
				'tm-mega-menu',
				'tm-photo-gallery',
				'contact-form-7',
				'shortcode-widget',
				'wordpress-social-login',
			),
			'lite'  => false,
			'demo'  => 'http://ld-wp2.template-help.com/wptheme/frameme/',
			'thumb' => get_template_directory_uri() . '/assets/demo-content/default/default-thumb.png',
			'name'  => esc_html__( 'FrameMe', 'frameme' ),
		),


	),
);

$texts = array(
	'theme-name' => 'FrameMe'
);