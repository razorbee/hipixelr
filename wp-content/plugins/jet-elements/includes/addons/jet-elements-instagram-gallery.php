<?php
namespace Elementor;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Widget_Base;
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Jet_Elements_Instagram_Gallery extends Jet_Elements_Base {

	/**
	 * Instagram API-server URL.
	 *
	 * @since 1.0.0
	 * @var string
	 */
	private $api_url = 'https://www.instagram.com/';

	/**
	 * Instagram CDN-server URL.
	 *
	 * @since 1.0.0
	 * @var string
	 */
	private $cdn_url = 'https://scontent.cdninstagram.com/';

	/**
	 * Request config
	 *
	 * @var array
	 */
	public $config = array();

	public function get_name() {
		return 'jet-instagram-gallery';
	}

	public function get_title() {
		return esc_html__( 'Instagram', 'jet-elements' );
	}

	public function get_icon() {
		return 'jetelements-icon-37';
	}

	public function get_categories() {
		return array( 'cherry' );
	}

	public function get_script_depends() {
		return array( 'jet-salvattore' );
	}

	protected function _register_controls() {

		$css_scheme = apply_filters(
			'jet-elements/instagram-gallery/css-scheme',
			array(
				'instance'       => '.jet-instagram-gallery__instance',
				'image_instance' => '.jet-instagram-gallery__image',
				'inner'          => '.jet-instagram-gallery__inner',
				'content'        => '.jet-instagram-gallery__content',
				'caption'        => '.jet-instagram-gallery__caption',
				'meta'           => '.jet-instagram-gallery__meta',
				'meta_item'      => '.jet-instagram-gallery__meta-item',
				'meta_icon'      => '.jet-instagram-gallery__meta-icon',
				'meta_label'     => '.jet-instagram-gallery__meta-label',
			)
		);

		$this->start_controls_section(
			'section_instagram_settings',
			array(
				'label' => esc_html__( 'Instagram Settings', 'jet-elements' ),
			)
		);

		$this->add_control(
			'endpoint',
			array(
				'label'   => esc_html__( 'What to display', 'jet-elements' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'hashtag',
				'options' => array(
					'hashtag'  => esc_html__( 'Tagged Photos', 'jet-elements' ),
					'self'     => esc_html__( 'My Photos', 'jet-elements' ),
				),
			)
		);

		$this->add_control(
			'hashtag',
			array(
				'label' => esc_html__( 'Hashtag (enter without `#` symbol)', 'jet-elements' ),
				'type'  => Controls_Manager::TEXT,
				'condition' => array(
					'endpoint' => 'hashtag',
				),
			)
		);

		$this->add_control(
			'self',
			array(
				'label' => esc_html__( 'Username', 'jet-elements' ),
				'type'  => Controls_Manager::TEXT,
				'condition' => array(
					'endpoint' => 'self',
				),
			)
		);

		$this->add_control(
			'cache_timeout',
			array(
				'label'   => esc_html__( 'Cache Timeout', 'jet-elements' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'hour',
				'options' => array(
					'none'   => esc_html__( 'None', 'jet-elements' ),
					'minute' => esc_html__( 'Minute', 'jet-elements' ),
					'hour'   => esc_html__( 'Hour', 'jet-elements' ),
					'day'    => esc_html__( 'Day', 'jet-elements' ),
					'week'   => esc_html__( 'Week', 'jet-elements' ),
				),
			)
		);

		$this->add_control(
			'photo_size',
			array(
				'label'   => esc_html__( 'Photo Size', 'jet-elements' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'high',
				'options' => array(
					'thumbnail' => esc_html__( 'Thumbnail (150x150)', 'jet-elements' ),
					'low'       => esc_html__( 'Low (320x320)', 'jet-elements' ),
					'standard'  => esc_html__( 'Standard (640x640)', 'jet-elements' ),
					'high'      => esc_html__( 'High (original)', 'jet-elements' ),
				),
			)
		);

		$this->add_control(
			'posts_counter',
			array(
				'label'   => esc_html__( 'Number of instagram posts', 'jet-elements' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 6,
				'min'     => 1,
				'max'     => 18,
				'step'    => 1,
			)
		);

		$this->add_control(
			'post_link',
			array(
				'label'        => esc_html__( 'Enable linking photos', 'jet-elements' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'jet-elements' ),
				'label_off'    => esc_html__( 'No', 'jet-elements' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);

		$this->add_control(
			'post_caption',
			array(
				'label'        => esc_html__( 'Enable caption', 'jet-elements' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'jet-elements' ),
				'label_off'    => esc_html__( 'No', 'jet-elements' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);

		$this->add_control(
			'post_caption_length',
			array(
				'label'   => esc_html__( 'Caption length', 'jet-elements' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 50,
				'min'     => 1,
				'max'     => 300,
				'step'    => 1,
				'condition' => array(
					'post_caption' => 'yes',
				),
			)
		);

		$this->add_control(
			'post_comments_count',
			array(
				'label'        => esc_html__( 'Enable Comments Count', 'jet-elements' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'jet-elements' ),
				'label_off'    => esc_html__( 'No', 'jet-elements' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);

		$this->add_control(
			'post_likes_count',
			array(
				'label'        => esc_html__( 'Enable Likes Count', 'jet-elements' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'jet-elements' ),
				'label_off'    => esc_html__( 'No', 'jet-elements' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_settings',
			array(
				'label' => esc_html__( 'Layout Settings', 'jet-elements' ),
			)
		);

		$this->add_control(
			'layout_type',
			array(
				'label'   => esc_html__( 'Layout type', 'jet-elements' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'masonry',
				'options' => array(
					'masonry' => esc_html__( 'Masonry', 'jet-elements' ),
					'grid'    => esc_html__( 'Grid', 'jet-elements' ),
					'list'    => esc_html__( 'List', 'jet-elements' ),
				),
			)
		);

		$this->add_responsive_control(
			'columns',
			array(
				'label'   => esc_html__( 'Columns', 'jet-elements' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 3,
				'options' => jet_elements_tools()->get_select_range( 6 ),
				'condition' => array(
					'layout_type' => array( 'masonry', 'grid' ),
				),
			)
		);

		$this->end_controls_section();

		/**
		 * General Style Section
		 */
		$this->start_controls_section(
			'section_general_style',
			array(
				'label'      => esc_html__( 'General', 'jet-elements' ),
				'tab'        => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			)
		);

		$this->add_responsive_control(
			'item_height',
			array(
				'label' => esc_html__( 'Item Height', 'jet-elements' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => array(
					'px' => array(
						'min' => 100,
						'max' => 1000,
					),
				),
				'default' => [
					'size' => 300,
				],
				'condition' => array(
					'layout_type' => 'grid',
				),
				'selectors' => array(
					'{{WRAPPER}} ' . $css_scheme['image_instance'] => 'height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'item_margin',
			array(
				'label' => esc_html__( 'Items Margin', 'jet-elements' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => array(
					'px' => array(
						'min' => 0,
						'max' => 50,
					),
				),
				'default' => [
					'size' => 10,
				],
				'selectors' => array(
					'{{WRAPPER}} ' . $css_scheme['inner']    => 'margin: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} ' . $css_scheme['instance'] => 'margin: -{{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'item_padding',
			array(
				'label'      => __( 'Padding', 'jet-elements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} ' . $css_scheme['inner'] => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'        => 'item_border',
				'label'       => esc_html__( 'Border', 'jet-elements' ),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} ' . $css_scheme['inner'],
			)
		);

		$this->add_responsive_control(
			'item_border_radius',
			array(
				'label'      => __( 'Border Radius', 'jet-elements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} ' . $css_scheme['inner'] => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name' => 'item_shadow',
				'exclude' => array(
					'box_shadow_position',
				),
				'selector' => '{{WRAPPER}} ' . $css_scheme['inner'],
			)
		);

		$this->end_controls_section();

		/**
		 * Caption Style Section
		 */
		$this->start_controls_section(
			'section_caption_style',
			array(
				'label'      => esc_html__( 'Caption', 'jet-elements' ),
				'tab'        => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			)
		);

		$this->add_control(
			'caption_color',
			array(
				'label'  => esc_html__( 'Color', 'jet-elements' ),
				'type'   => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} ' . $css_scheme['caption'] => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'caption_typography',
				'scheme'   => Scheme_Typography::TYPOGRAPHY_3,
				'selector' => '{{WRAPPER}} ' . $css_scheme['caption'],
			)
		);

		$this->add_responsive_control(
			'caption_padding',
			array(
				'label'      => __( 'Padding', 'jet-elements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} ' . $css_scheme['caption'] => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'caption_margin',
			array(
				'label'      => __( 'Margin', 'jet-elements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} ' . $css_scheme['caption'] => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'caption_width',
			array(
				'label' => esc_html__( 'Caption Width', 'jet-elements' ),
				'type'  => Controls_Manager::SLIDER,
				'size_units' => array(
					'px', 'em', '%',
				),
				'range'      => array(
					'px' => array(
						'min' => 50,
						'max' => 1000,
					),
					'%' => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'default' => [
					'size'  => 100,
					'units' => '%'
				],
				'selectors' => array(
					'{{WRAPPER}} ' . $css_scheme['caption'] => 'max-width: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'caption_alignment',
			array(
				'label'   => esc_html__( 'Alignment', 'jet-elements' ),
				'type'    => Controls_Manager::CHOOSE,
				'default' => 'center',
				'options' => array(
					'flex-start'    => array(
						'title' => esc_html__( 'Left', 'jet-elements' ),
						'icon'  => 'fa fa-align-left',
					),
					'center' => array(
						'title' => esc_html__( 'Center', 'jet-elements' ),
						'icon'  => 'fa fa-align-center',
					),
					'flex-end' => array(
						'title' => esc_html__( 'Right', 'jet-elements' ),
						'icon'  => 'fa fa-align-right',
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} ' . $css_scheme['caption'] => 'align-self: {{VALUE}};',
				),
			)
		);

		$this->add_responsive_control(
			'caption_text_alignment',
			array(
				'label'   => esc_html__( 'Text Alignment', 'jet-elements' ),
				'type'    => Controls_Manager::CHOOSE,
				'default' => 'center',
				'options' => array(
					'left'    => array(
						'title' => esc_html__( 'Left', 'jet-elements' ),
						'icon'  => 'fa fa-align-left',
					),
					'center' => array(
						'title' => esc_html__( 'Center', 'jet-elements' ),
						'icon'  => 'fa fa-align-center',
					),
					'right' => array(
						'title' => esc_html__( 'Right', 'jet-elements' ),
						'icon'  => 'fa fa-align-right',
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} ' . $css_scheme['caption'] => 'text-align: {{VALUE}};',
				),
			)
		);

		$this->end_controls_section();

		/**
		 * Meta Style Section
		 */
		$this->start_controls_section(
			'section_meta_style',
			array(
				'label'      => esc_html__( 'Meta', 'jet-elements' ),
				'tab'        => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			)
		);

		$this->add_control(
			'comments_icon',
			array(
				'label'       => esc_html__( 'Comments Icon', 'jet-elements' ),
				'type'        => Controls_Manager::ICON,
				'label_block' => true,
				'file'        => '',
				'default'     => 'fa fa-comment',
			)
		);

		$this->add_control(
			'likes_icon',
			array(
				'label'       => esc_html__( 'Likes Icon', 'jet-elements' ),
				'type'        => Controls_Manager::ICON,
				'label_block' => true,
				'file'        => '',
				'default'     => 'fa fa-heart',
			)
		);

		$this->add_control(
			'meta_icon_color',
			array(
				'label'  => esc_html__( 'Icon Color', 'jet-elements' ),
				'type'   => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} ' . $css_scheme['meta_icon'] => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_responsive_control(
			'meta_icon_size',
			array(
				'label'      => esc_html__( 'Icon Size', 'jet-elements' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array(
					'px', 'em', 'rem',
				),
				'range'      => array(
					'px' => array(
						'min' => 1,
						'max' => 100,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} ' . $css_scheme['meta_icon'] . ' i' => 'font-size: {{SIZE}}{{UNIT}}',
				),
			)
		);

		$this->add_control(
			'meta_label_color',
			array(
				'label'  => esc_html__( 'Text Color', 'jet-elements' ),
				'type'   => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} ' . $css_scheme['meta_label'] => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'meta_label_typography',
				'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} ' . $css_scheme['meta_label'],
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'meta_background',
				'selector' => '{{WRAPPER}} ' . $css_scheme['meta'],
			)
		);

		$this->add_responsive_control(
			'meta_padding',
			array(
				'label'      => __( 'Padding', 'jet-elements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} ' . $css_scheme['meta'] => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'meta_margin',
			array(
				'label'      => __( 'Margin', 'jet-elements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} ' . $css_scheme['meta'] => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_responsive_control(
			'meta_item_margin',
			array(
				'label'      => __( 'Item Margin', 'jet-elements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} ' . $css_scheme['meta_item'] => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			array(
				'name'        => 'meta_border',
				'label'       => esc_html__( 'Border', 'jet-elements' ),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} ' . $css_scheme['meta'],
			)
		);

		$this->add_responsive_control(
			'meta_radius',
			array(
				'label'      => __( 'Border Radius', 'jet-elements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} ' . $css_scheme['meta'] => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			array(
				'name'     => 'meta_shadow',
				'selector' => '{{WRAPPER}} ' . $css_scheme['meta'],
			)
		);

		$this->add_responsive_control(
			'meta_alignment',
			array(
				'label'   => esc_html__( 'Alignment', 'jet-elements' ),
				'type'    => Controls_Manager::CHOOSE,
				'default' => 'center',
				'options' => array(
					'flex-start'    => array(
						'title' => esc_html__( 'Left', 'jet-elements' ),
						'icon'  => 'fa fa-align-left',
					),
					'center' => array(
						'title' => esc_html__( 'Center', 'jet-elements' ),
						'icon'  => 'fa fa-align-center',
					),
					'flex-end' => array(
						'title' => esc_html__( 'Right', 'jet-elements' ),
						'icon'  => 'fa fa-align-right',
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} ' . $css_scheme['meta'] => 'align-self: {{VALUE}};',
				),
			)
		);

		$this->end_controls_section();

		/**
		 * Overlay Style Section
		 */
		$this->start_controls_section(
			'section_overlay_style',
			array(
				'label'      => esc_html__( 'Overlay', 'jet-elements' ),
				'tab'        => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			)
		);

		$this->add_control(
			'show_on_hover',
			array(
				'label'        => esc_html__( 'Show on hover', 'jet-elements' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Yes', 'jet-elements' ),
				'label_off'    => esc_html__( 'No', 'jet-elements' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'overlay_background',
				'fields_options' => array(
					'color' => array(
						'scheme' => array(
							'type'  => Scheme_Color::get_type(),
							'value' => Scheme_Color::COLOR_2,
						),
					),
				),
				'selector' => '{{WRAPPER}} ' . $css_scheme['content'] . ':before',
			)
		);

		$this->add_responsive_control(
			'overlay_paddings',
			array(
				'label'      => __( 'Padding', 'jet-elements' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} ' . $css_scheme['content'] => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();

		/**
		 * Order Style Section
		 */
		$this->start_controls_section(
			'section_order_style',
			array(
				'label'      => esc_html__( 'Content Order and Alignment', 'jet-elements' ),
				'tab'        => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			)
		);

		$this->add_control(
			'caption_order',
			array(
				'label'   => esc_html__( 'Caption Order', 'jet-elements' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 1,
				'min'     => 1,
				'max'     => 4,
				'step'    => 1,
				'selectors' => array(
					'{{WRAPPER}} '. $css_scheme['caption'] => 'order: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'meta_order',
			array(
				'label'   => esc_html__( 'Meta Order', 'jet-elements' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 2,
				'min'     => 1,
				'max'     => 4,
				'step'    => 1,
				'selectors' => array(
					'{{WRAPPER}} '. $css_scheme['meta'] => 'order: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'cover_alignment',
			array(
				'label'   => esc_html__( 'Cover Content Vertical Alignment', 'jet-elements' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'center',
				'options' => array(
					'flex-start'    => esc_html__( 'Top', 'jet-elements' ),
					'center'        => esc_html__( 'Center', 'jet-elements' ),
					'flex-end'      => esc_html__( 'Bottom', 'jet-elements' ),
					'space-between' => esc_html__( 'Space between', 'jet-elements' ),
				),
				'selectors'  => array(
					'{{WRAPPER}} '. $css_scheme['content'] => 'justify-content: {{VALUE}};',
				),
			)
		);

		$this->end_controls_section();

	}

	protected function render() {

		$this->__context = 'render';

		$this->__open_wrap();
		include $this->__get_global_template( 'index' );
		$this->__close_wrap();
	}


	public function render_gallery() {
		$settings = $this->get_settings();

		if ( 'hashtag' == $settings['endpoint'] && empty( $settings['hashtag'] ) ) {
			return print esc_html__( 'Please, enter #hashtag.', 'jet-elements' );
		}

		if ( 'self' == $settings['endpoint'] && empty( $settings['self'] ) ) {
			return print esc_html__( 'Please, enter User Name.', 'jet-elements' );
		}

		$html = '';
		$col_class = '';

		// Endpoint.
		$endpoint = $this->sanitize_endpoint();

		switch ( $settings['cache_timeout'] ) {
			case 'none':
				$cache_timeout = 1;
				break;

			case 'minute':
				$cache_timeout = MINUTE_IN_SECONDS;
				break;

			case 'hour':
				$cache_timeout = HOUR_IN_SECONDS;
				break;

			case 'day':
				$cache_timeout = DAY_IN_SECONDS;
				break;

			case 'week':
				$cache_timeout = WEEK_IN_SECONDS;
				break;

			default:
				$cache_timeout = HOUR_IN_SECONDS;
				break;
		}

		$this->config = array(
			'endpoint'            => $endpoint,
			'target'              => sanitize_text_field( $settings[ $endpoint ] ),
			'posts_counter'       => $settings['posts_counter'],
			'post_link'           => filter_var( $settings['post_link'], FILTER_VALIDATE_BOOLEAN ),
			'photo_size'          => $settings['photo_size'],
			'post_caption'        => filter_var( $settings['post_caption'], FILTER_VALIDATE_BOOLEAN ),
			'post_caption_length' => $settings['post_caption_length'],
			'post_comments_count' => filter_var( $settings['post_comments_count'], FILTER_VALIDATE_BOOLEAN ),
			'post_likes_count'    => filter_var( $settings['post_likes_count'], FILTER_VALIDATE_BOOLEAN ),
			'cache_timeout'       => $cache_timeout,
		);

		$posts = $this->get_posts( $this->config );

		foreach ( $posts as $post_data ) {
			$item_html   = '';
			$link        = sprintf( $this->get_post_url(), $post_data['link'] );
			$the_image   = $this->the_image( $post_data );
			$the_caption = $this->the_caption( $post_data );
			$the_meta    = $this->the_meta( $post_data );

			$item_html = sprintf(
				'<div class="jet-instagram-gallery__media">%1$s</div><div class="jet-instagram-gallery__content">%2$s%3$s</div>',
				$the_image,
				$the_caption,
				$the_meta
			);

			$link_format = '<a class="jet-instagram-gallery__link" href="%s" target="_blank" rel="nofollow">%s</a>';
			$link_format = apply_filters( 'jet-elements/instagram-gallery/link-format', $link_format );

			$item_html = sprintf( $link_format, esc_url( $link ), $item_html );

			if ( 'grid' === $settings['layout_type'] ) {
				$col_class = jet_elements_tools()->col_classes( array(
					'desk' => $settings['columns'],
					'tab'  => $settings['columns_tablet'],
					'mob'  => $settings['columns_mobile'],
				) );
			}

			$html .= sprintf( '<div class="jet-instagram-gallery__item %s"><div class="jet-instagram-gallery__inner">%s</div></div>', $col_class, $item_html );
		}

		echo $html;
	}

	/**
	 * Display a HTML link with image.
	 *
	 * @since  1.0.0
	 * @param  array $item Item photo data.
	 */
	public function the_image( $item ) {
		$size = $this->_get_relation_photo_size( $this->get_settings( 'photo_size' ) );

		// Get photo filename (name.jpg).
		$parse_url  = parse_url( $item['image'] );
		$parts      = explode( '/', $parse_url['path'] );
		$photo_name = $parts[ sizeof( $parts ) - 1 ];

		if ( ! empty( $size ) ) {
			$width     = $size[0];
			$height    = $size[1];
			$photo_url = sprintf(
				'%st/s%dx%d/%s',
				$this->cdn_url, absint( $width ), absint( $height ), $photo_name
			);

			$photo_format = "<img class='jet-instagram-gallery__image' src='%s' width='{$width}' height='{$height}' alt=''>";

		} else {
			$photo_url    = sprintf( '%st/%s', $this->cdn_url, $photo_name );
			$width = $item['dimensions']['width'];
			$height = $item['dimensions']['height'];
			$photo_format = "<img class='jet-instagram-gallery__image' src='%s' width='{$width}' height='{$height}' alt=''>";
		}

		$photo_format = apply_filters( 'jet-elements/instagram-gallery/photo-format', $photo_format );

		$image = sprintf( $photo_format, esc_url( $photo_url ) );

		return $image;
	}

	/**
	 * Display a caption.
	 *
	 * @since  1.0.0
	 * @param  array  $photo Item photo data.
	 * @return string
	 */
	public function the_caption( $item ) {

		if ( ! $this->config['post_caption'] || empty( $item['caption'] ) ) {
			return;
		}

		$format = apply_filters(
			'jet-elements/instagram-gallery/the-caption-format', '<div class="jet-instagram-gallery__caption">%s</div>'
		);

		return sprintf( $format, $item['caption'] );
	}

	/**
	 * Display a meta.
	 *
	 * @since  1.0.0
	 * @param  array  $photo Item photo data.
	 * @return string
	 */
	public function the_meta( $item ) {

		if ( ! $this->config['post_comments_count'] && ! $this->config['post_likes_count'] ) {
			return;
		}

		$meta_html = '';

		if ( $this->config['post_comments_count'] ) {
			$meta_html .= sprintf(
				'<div class="jet-instagram-gallery__meta-item jet-instagram-gallery__comments-count"><span class="jet-instagram-gallery__comments-icon jet-instagram-gallery__meta-icon"><i class="%s"></i></span><span class="jet-instagram-gallery__comments-label jet-instagram-gallery__meta-label">%s</span></div>',
				$this->get_settings( 'comments_icon' ),
				$item['comments']
			);
		}

		if ( $this->config['post_likes_count'] ) {
			$meta_html .= sprintf(
				'<div class="jet-instagram-gallery__meta-item jet-instagram-gallery__likes-count"><span class="jet-instagram-gallery__likes-icon jet-instagram-gallery__meta-icon"><i class="%s"></i></span><span class="jet-instagram-gallery__likes-label jet-instagram-gallery__meta-label">%s</span></div>',
				$this->get_settings( 'likes_icon' ),
				$item['likes']
			);
		}

		$format = apply_filters( 'jet-elements/instagram-gallery/the-meta-format', '<div class="jet-instagram-gallery__meta">%s</div>' );

		return sprintf( $format, $meta_html );
	}

	/**
	 * Retrieve a photos.
	 *
	 * @since  1.0.0
	 * @param  array $config Set of configuration.
	 * @return array
	 */
	public function get_posts( $config ) {

		$transient_key = md5( $this->get_transient_key() );

		$data = get_transient( $transient_key );

		if ( ! empty( $data ) && 1 !== $config['cache_timeout'] ) {
			return $data;
		}

		$response = $this->remote_get( $config );

		if ( is_wp_error( $response ) ) {
			throw new Exception( 'error' );
		}

		$key = 'hashtag' == $config['endpoint'] ? 'tag' : 'user';

		if ( empty( $response[ $key ] ) ) {
			throw new Exception( 'error' );
		}

		if ( empty( $response[ $key ]['media']['nodes'] ) ) {
			throw new Exception( 'error' );
		}

		$data  = array();
		$nodes = array_slice(
			$response[ $key ]['media']['nodes'],
			0,
			$config['posts_counter'],
			true
		);

		foreach ( $nodes as $post ) {
			$_post               = array();
			$_post['link']       = $post['code'];
			$_post['image']      = $post['thumbnail_src'];
			$_post['caption']    = wp_html_excerpt( $post['caption'], $this->config['post_caption_length'], '&hellip;' );
			$_post['comments']   = $post['comments']['count'];
			$_post['likes']      = $post['likes']['count'];
			$_post['dimensions'] = $post['dimensions'];

			array_push( $data, $_post );
		}

		set_transient( $transient_key, $data, $config['cache_timeout'] );

		return $data;
	}

	/**
	 * Retrieve the raw response from the HTTP request using the GET method.
	 *
	 * @since  1.0.0
	 * @return array|WP_Error
	 */
	public function remote_get( $config ) {

		$url = add_query_arg(
			array( '__a' => 1 ),
			$this->get_grab_url( $config )
		);

		$response      = wp_remote_get( $url );
		$response_code = wp_remote_retrieve_response_code( $response );

		if ( '' === $response_code ) {
			return new WP_Error;
		}

		$result = json_decode( wp_remote_retrieve_body( $response ), true );

		if ( ! is_array( $result ) ) {
			return new WP_Error;
		}

		return $result;
	}

	/**
	 * Retrieve a grab URL.
	 *
	 * @since  1.0.0
	 * @return string
	 */
	public function get_grab_url( $config ) {

		if ( 'hashtag' == $config['endpoint'] ) {
			$url = sprintf( $this->get_tags_url(), $config['target'] );
		} else {
			$url = sprintf( $this->get_self_url(), $config['target'] );
		}

		return $url;
	}

	/**
	 * Retrieve a URL for photos by hashtag.
	 *
	 * @since  1.0.0
	 * @return string
	 */
	public function get_tags_url() {
		return apply_filters( 'jet-elements/instagram-gallery/get-tags-url', $this->api_url . 'explore/tags/%s/' );
	}

	/**
	 * Retrieve a URL for self photos.
	 *
	 * @since  1.0.0
	 * @return string
	 */
	public function get_self_url() {
		return apply_filters( 'jet-elements/instagram-gallery/get-self-url', $this->api_url . '%s/' );
	}

	/**
	 * Retrieve a URL for post.
	 *
	 * @since  1.0.0
	 * @return string
	 */
	public function get_post_url() {
		return apply_filters( 'jet-elements/instagram-gallery/get-post-url', $this->api_url . 'p/%s/' );
	}

	/**
	 * sanitize endpoint.
	 *
	 * @since  1.0.0
	 * @return string
	 */
	public function sanitize_endpoint() {
		return in_array( $this->get_settings( 'endpoint' ) , array( 'hashtag', 'self' ) ) ? $this->get_settings( 'endpoint' ) : 'hashtag';
	}

	/**
	 * Retrieve a photo sizes (in px) by option name.
	 *
	 * @since  1.0.0
	 * @param  string $photo_size Photo size.
	 * @return array
	 */
	public function _get_relation_photo_size( $photo_size ) {
		switch ( $photo_size ) {

			case 'high':
				$size = array();
				break;

			case 'standard':
				$size = array( 640, 640 );
				break;

			case 'low':
				$size = array( 320, 320 );
				break;

			default:
				$size = array( 150, 150 );
				break;
		}

		return apply_filters( 'jet-elements/instagram-gallery/relation-photo-size', $size, $photo_size );
	}

	/**
	 * Get transient key.
	 *
	 * @since  1.0.0
	 * @return string
	 */
	public function get_transient_key() {
		return sprintf( 'jet_elements_instagram_%s_%s_posts_count_%s_caption_%s',
			$this->config['endpoint'],
			$this->config['target'],
			$this->config['posts_counter'],
			$this->config['post_caption_length']
		);
	}

	/**
	 * Generate setting json
	 *
	 * @return string
	 */
	public function generate_setting_json() {
		$module_settings = $this->get_settings();

		$settings = array(
			'layoutType'    => $module_settings['layout_type'],
			'columns'       => $module_settings['columns'],
			'columnsTablet' => $module_settings['columns_tablet'],
			'columnsMobile' => $module_settings['columns_mobile'],
		);

		$settings = json_encode( $settings );

		return sprintf( 'data-settings=\'%1$s\'', $settings );
	}

}
