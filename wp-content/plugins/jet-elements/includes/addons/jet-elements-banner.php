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

class Jet_Elements_Banner extends Jet_Elements_Base {

	public function get_name() {
		return 'jet-banner';
	}

	public function get_title() {
		return esc_html__( 'Banner', 'jet-elements' );
	}

	public function get_icon() {
		return 'jetelements-icon-17';
	}

	public function get_categories() {
		return array( 'cherry' );
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'section_content',
			array(
				'label' => esc_html__( 'Content', 'jet-elements' ),
			)
		);

		$this->add_control(
			'banner_image',
			array(
				'label'   => esc_html__( 'Image', 'jet-elements' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => array(
					'url' => Utils::get_placeholder_image_src(),
				),
			)
		);

		$this->add_control(
			'banner_image_size',
			array(
				'type'       => 'select',
				'label'      => esc_html__( 'Image Size', 'jet-elements' ),
				'default'    => 'full',
				'options'    => jet_elements_tools()->get_image_sizes(),
			)
		);

		$this->add_control(
			'banner_title',
			array(
				'label'   => esc_html__( 'Title', 'jet-elements' ),
				'type'    => Controls_Manager::TEXT,
			)
		);

		$this->add_control(
			'banner_text',
			array(
				'label'   => esc_html__( 'Description', 'jet-elements' ),
				'type'    => Controls_Manager::TEXTAREA,
			)
		);

		$this->add_control(
			'banner_link',
			array(
				'label'   => esc_html__( 'Link', 'jet-elements' ),
				'type'    => Controls_Manager::TEXT,
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_settings',
			array(
				'label' => esc_html__( 'Settings', 'jet-elements' ),
			)
		);

		$this->add_control(
			'animation_effect',
			array(
				'label'   => esc_html__( 'Animation Effect', 'jet-elements' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'lily',
				'options' => array(
					'lily'   => esc_html__( 'Lily', 'jet-elements' ),
					'sadie'  => esc_html__( 'Sadie', 'jet-elements' ),
					'layla'  => esc_html__( 'Layla', 'jet-elements' ),
					'oscar'  => esc_html__( 'Oscar', 'jet-elements' ),
					'marley' => esc_html__( 'Marley', 'jet-elements' ),
					'ruby'   => esc_html__( 'Ruby', 'jet-elements' ),
					'roxy'   => esc_html__( 'Roxy', 'jet-elements' ),
					'bubba'  => esc_html__( 'Bubba', 'jet-elements' ),
					'romeo'  => esc_html__( 'Romeo', 'jet-elements' ),
					'sarah'  => esc_html__( 'Sarah', 'jet-elements' ),
					'chico'  => esc_html__( 'Chico', 'jet-elements' ),
				),
			)
		);

		$this->end_controls_section();

		$css_scheme = apply_filters(
			'jet-elements/banner/css-scheme',
			array(
				'banner'         => '.jet-banner',
				'banner_content' => '.jet-banner__content',
				'banner_overlay' => '.jet-banner__overlay',
				'banner_title'   => '.jet-banner__title',
				'banner_text'    => '.jet-banner__text',
			)
		);

		$this->start_controls_section(
			'section_banner_item_style',
			array(
				'label'      => esc_html__( 'General', 'jet-elements' ),
				'tab'        => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			)
		);

		$this->start_controls_tabs( 'tabs_background' );

		$this->add_control(
			'items_content_color',
			array(
				'label'     => esc_html__( 'Additional Elements Color', 'jet-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .jet-effect-layla ' . $css_scheme['banner_content'] . '::before' => 'border-color: {{VALUE}}',
					'{{WRAPPER}} .jet-effect-layla ' . $css_scheme['banner_content'] . '::after' => 'border-color: {{VALUE}}',
					'{{WRAPPER}} .jet-effect-oscar ' . $css_scheme['banner_content'] . '::before' => 'border-color: {{VALUE}}',
					'{{WRAPPER}} .jet-effect-marley ' . $css_scheme['banner_title'] . '::after' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .jet-effect-ruby ' . $css_scheme['banner_text'] => 'border-color: {{VALUE}}',
					'{{WRAPPER}} .jet-effect-roxy ' . $css_scheme['banner_text'] . '::before' => 'border-color: {{VALUE}}',
					'{{WRAPPER}} .jet-effect-roxy ' . $css_scheme['banner_content'] . '::before' => 'border-color: {{VALUE}}',
					'{{WRAPPER}} .jet-effect-bubba ' . $css_scheme['banner_content'] . '::before' => 'border-color: {{VALUE}}',
					'{{WRAPPER}} .jet-effect-bubba ' . $css_scheme['banner_content'] . '::after' => 'border-color: {{VALUE}}',
					'{{WRAPPER}} .jet-effect-romeo ' . $css_scheme['banner_content'] . '::before' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .jet-effect-romeo ' . $css_scheme['banner_content'] . '::after' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .jet-effect-sarah ' . $css_scheme['banner_title'] . '::after' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .jet-effect-chico ' . $css_scheme['banner_content'] . '::before' => 'border-color: {{VALUE}}',
				),
			)
		);

		$this->start_controls_tab(
			'tab_background_normal',
			array(
				'label' => esc_html__( 'Normal', 'jet-elements' ),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'background',
				'selector' => '{{WRAPPER}} ' . $css_scheme['banner_overlay'],
			)
		);

		$this->add_control(
			'normal_opacity',
			array(
				'label'   => esc_html__( 'Opacity', 'jet-elements' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => '0',
				'min'     => 0,
				'max'     => 1,
				'step'    => 0.1,
				'selectors'  => array(
					'{{WRAPPER}} ' . $css_scheme['banner_overlay'] => 'opacity: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_background_hover',
			array(
				'label' => esc_html__( 'Hover', 'jet-elements' ),
			)
		);

		$this->add_control(
			'items_content_hover_color',
			array(
				'label'     => esc_html__( 'Additional Elements Color', 'jet-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .jet-effect-layla:hover ' . $css_scheme['banner_content'] . '::before' => 'border-color: {{VALUE}}',
					'{{WRAPPER}} .jet-effect-layla:hover ' . $css_scheme['banner_content'] . '::after' => 'border-color: {{VALUE}}',
					'{{WRAPPER}} .jet-effect-oscar:hover ' . $css_scheme['banner_content'] . '::before' => 'border-color: {{VALUE}}',
					'{{WRAPPER}} .jet-effect-marley:hover ' . $css_scheme['banner_title'] . '::after' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .jet-effect-ruby:hover ' . $css_scheme['banner_text'] => 'border-color: {{VALUE}}',
					'{{WRAPPER}} .jet-effect-roxy:hover ' . $css_scheme['banner_text'] . '::before' => 'border-color: {{VALUE}}',
					'{{WRAPPER}} .jet-effect-roxy:hover ' . $css_scheme['banner_content'] . '::before' => 'border-color: {{VALUE}}',
					'{{WRAPPER}} .jet-effect-bubba:hover ' . $css_scheme['banner_content'] . '::before' => 'border-color: {{VALUE}}',
					'{{WRAPPER}} .jet-effect-bubba:hover ' . $css_scheme['banner_content'] . '::after' => 'border-color: {{VALUE}}',
					'{{WRAPPER}} .jet-effect-romeo:hover ' . $css_scheme['banner_content'] . '::before' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .jet-effect-romeo:hover ' . $css_scheme['banner_content'] . '::after' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .jet-effect-sarah:hover ' . $css_scheme['banner_title'] . '::after' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .jet-effect-chico:hover ' . $css_scheme['banner_content'] . '::before' => 'border-color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			array(
				'name'     => 'background_hover',
				'selector' => '{{WRAPPER}} ' . $css_scheme['banner'] . ':hover ' . $css_scheme['banner_overlay'],
			)
		);

		$this->add_control(
			'hover_opacity',
			array(
				'label'   => esc_html__( 'Opacity', 'jet-elements' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => '0.4',
				'min'     => 0,
				'max'     => 1,
				'step'    => 0.1,
				'selectors'  => array(
					'{{WRAPPER}} ' . $css_scheme['banner'] . ':hover ' . $css_scheme['banner_overlay'] => 'opacity: {{VALUE}};',
				),
			)
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_banner_title_style',
			array(
				'label'      => esc_html__( 'Banner Title Typography', 'jet-elements' ),
				'tab'        => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			)
		);

		$this->add_control(
			'banner_title_color',
			array(
				'label'     => esc_html__( 'Title Color', 'jet-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} ' . $css_scheme['banner_title'] => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'banner_title_typography',
				'scheme'   => Scheme_Typography::TYPOGRAPHY_3,
				'selector' => '{{WRAPPER}} ' . $css_scheme['banner_title'],
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_banner_text_style',
			array(
				'label'      => esc_html__( 'Description Typography', 'jet-elements' ),
				'tab'        => Controls_Manager::TAB_STYLE,
				'show_label' => false,
			)
		);

		$this->add_control(
			'banner_text_color',
			array(
				'label'     => esc_html__( 'Description Color', 'jet-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} ' . $css_scheme['banner_text'] => 'color: {{VALUE}}',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'banner_text_typography',
				'scheme'   => Scheme_Typography::TYPOGRAPHY_3,
				'selector' => '{{WRAPPER}} ' . $css_scheme['banner_text'],
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

	public function __get_banner_image() {

		$image = $this->get_settings( 'banner_image' );

		if ( empty( $image['id'] ) && empty( $image['url'] ) ) {
			return;
		}

		$format = apply_filters( 'jet-elements/banner/image-format', '<img src="%s" alt="" class="jet-banner__img">' );

		if ( empty( $image['id'] ) ) {
			return sprintf( $format, $image['url'] );
		}

		$size = $this->get_settings( 'banner_image_size' );

		if ( ! $size ) {
			$size = 'full';
		}

		$image_url = wp_get_attachment_image_url( $image['id'], $size );

		return sprintf( $format, $image_url );
	}

}
