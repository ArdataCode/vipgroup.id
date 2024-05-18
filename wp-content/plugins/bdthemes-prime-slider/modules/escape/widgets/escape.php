<?php
namespace PrimeSlider\Modules\Escape\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Repeater;
use PrimeSlider\Utils;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Escape extends Widget_Base {

	public function get_name() {
		return 'prime-slider-escape';
	}

	public function get_title() {
		return BDTPS . esc_html__('Escape', 'bdthemes-prime-slider');
	}

	public function get_icon() {
		return 'bdt-widget-icon ps-wi-escape bdt-new';
	}

	public function get_categories() {
		return ['prime-slider'];
	}

	public function get_keywords() {
		return [ 'prime slider', 'slider', 'escape', 'prime' ];
	}

	public function get_style_depends() {
		return ['ps-escape', 'prime-slider-font'];
	}
	public function get_script_depends() {
		return ['ps-escape'];
	}

	public function get_custom_help_url() {
		return 'https://youtu.be/WTqtALRdhDc';
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_content_layout',
			[
				'label' => esc_html__('Layout', 'bdthemes-prime-slider'),
			]
		);

		$this->add_responsive_control(
			'item_height',
			[
				'label' => esc_html__('Height', 'bdthemes-prime-slider'),
				'type'  => Controls_Manager::SLIDER,
				'size_units' => [ '%', 'px', 'vh' ],
				'range' => [
					'px' => [
						'min' => 200,
						'max' => 1080,
					],
					'%' => [
						'min' => 10,
						'max' => 100,
					],
					'vh' => [
						'min' => 10,
						'max' => 100,
					],
				],
				'selectors'   => [
					'{{WRAPPER}}' => '--ps-slider-height: {{SIZE}}{{UNIT}};'
				],
			]
		);

		$this->add_responsive_control(
			'content_width',
			[
				'label' => esc_html__('Content Width', 'bdthemes-prime-slider'),
				'type'  => Controls_Manager::SLIDER,
				'size_units' => [ '%', 'px', 'vw' ],
				'range' => [
					'px' => [
						'min' => 200,
						'max' => 1080,
					],
					'%' => [
						'min' => 10,
						'max' => 100,
					],
					'vw' => [
						'min' => 10,
						'max' => 100,
					],
				],
				'selectors'   => [
					'{{WRAPPER}} .bdt-escape-slider .bdt-content' => 'max-width: {{SIZE}}{{UNIT}};',
				],
				'render_type' => 'template'
			]
		);

		$this->add_control(
			'show_title',
			[
				'label'   => esc_html__('Show Title', 'bdthemes-prime-slider'),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'title_html_tag',
			[
				'label'   => __( 'Title HTML Tag', 'bdthemes-prime-slider' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'h1',
				'options' => prime_slider_title_tags(),
				'condition' => [
					'show_title' => 'yes'
				]
			]
		);

		$this->add_control(
			'show_text',
			[
				'label'   => esc_html__('Show Text', 'bdthemes-prime-slider'),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'separator' => 'before'
			]
		);

		$this->add_control(
			'text_hide_on',
			[
				'label'       => __('Text Hide On', 'bdthemes-prime-slider'),
				'type'        => Controls_Manager::SELECT2,
				'multiple'    => true,
				'label_block' => true,
				'options'     => [
					'desktop' => __('Desktop', 'bdthemes-prime-slider'),
					'tablet'  => __('Tablet', 'bdthemes-prime-slider'),
					'mobile'  => __('Mobile', 'bdthemes-prime-slider'),
				],
				'frontend_available' => true,
				'condition' => [
					'show_text' => 'yes'
				]
			]
		);

		$this->add_control(
			'show_button_text',
			[
				'label'   => esc_html__('Show Readmore', 'bdthemes-prime-slider'),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'show_navigation_arrows',
			[
				'label'   => esc_html__('Show Arrows', 'bdthemes-prime-slider'),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_control(
			'show_navigation_fraction',
			[
				'label'   => esc_html__('Show Fraction', 'bdthemes-prime-slider'),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
			]
		);

		$this->add_responsive_control(
            'content_alignment',
            [
                'label'   => esc_html__( 'Alignment', 'bdthemes-prime-slider' ),
                'type'    => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'bdthemes-prime-slider' ),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'bdthemes-prime-slider' ),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'bdthemes-prime-slider' ),
                        'icon'  => 'eicon-text-align-right',
                    ],
                    'justify' => [
                        'title' => esc_html__( 'Justify', 'bdthemes-prime-slider' ),
                        'icon'  => 'eicon-text-align-justify',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdt-escape-slider .bdt-content' => 'text-align: {{VALUE}};',
                ],
            ]
        );
		
		$this->end_controls_section();

		$this->start_controls_section(
			'section_content_sliders',
			[
				'label' => esc_html__('Sliders', 'bdthemes-prime-slider'),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new Repeater();

		$repeater->start_controls_tabs( 'tabs_items_style' );

		$repeater->start_controls_tab(
			'tab_item_content',
			[
				'label' => esc_html__( 'Content', 'bdthemes-prime-slider' ),
			]
		);


		$repeater->add_control(
			'title',
			[
				'label'       => esc_html__('Title', 'bdthemes-prime-slider'),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'dynamic'     => ['active' => true],
			]
		);

		$repeater->add_control(
			'slide_button_text',
			[
				'label'       => esc_html__('Readmore Text', 'bdthemes-prime-slider'),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__('Read More', 'bdthemes-prime-slider'),
				'label_block' => true,
				'dynamic'     => ['active' => true],
			]
        );

        $repeater->add_control(
			'button_link',
			[
				'label'         => esc_html__('Readmore Link', 'bdthemes-prime-slider'),
				'type'          => Controls_Manager::URL,
				'default'       => ['url' => ''],
				'dynamic'       => ['active' => true],
				'condition'     => [
					'slide_button_text!' => '',
				]
			]
        );

		$repeater->add_control(
			'image',
			[
				'label'     => esc_html__('Image', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
				'dynamic'     => ['active' => true],
			]
		);

		$repeater->end_controls_tab();
		
		$repeater->start_controls_tab(
			'tab_item_content_optional',
			[
				'label' => esc_html__( 'Optional', 'bdthemes-prime-slider' ),
			]
		);

		$repeater->add_control(
			'title_link',
			[
				'label'         => esc_html__('Title Link', 'bdthemes-prime-slider'),
				'type'          => Controls_Manager::URL,
				'default'       => ['url' => ''],
				'show_external' => false,
				'dynamic'       => ['active' => true],
				'condition'     => [
					'title!' => ''
				]
			]
		);

        $repeater->add_control(
			'text',
			[
				'label'       => esc_html__('Text', 'bdthemes-prime-slider'),
				'type'        => Controls_Manager::WYSIWYG,
				'default'     => esc_html__('Prime Slider Addons for Elementor is a page builder extension that allows you to build sliders with drag and drop. It lets you create an amazing slider without touching no code at all!', 'bdthemes-prime-slider'),
				'label_block' => true,
				'dynamic'     => ['active' => true],
			]
        );

		$repeater->end_controls_tab();
		
		$repeater->end_controls_tabs();

		$this->add_control(
			'slides',
			[
				'label'   => esc_html__('Items', 'bdthemes-prime-slider'),
				'type'    => Controls_Manager::REPEATER,
				'fields'  => $repeater->get_controls(),
				'default' => [
					[
						'title'     => esc_html__('Massive', 'bdthemes-prime-slider'),
						'image'     => ['url' => BDTPS_ASSETS_URL . 'images/gallery/item-1.svg']
					],
					[
						'title'     => esc_html__('Vibrant', 'bdthemes-prime-slider'),
						'image'     => ['url' => BDTPS_ASSETS_URL . 'images/gallery/item-4.svg']
					],
					[
						'title'     => esc_html__('Wallow', 'bdthemes-prime-slider'),
						'image'     => ['url' => BDTPS_ASSETS_URL . 'images/gallery/item-5.svg']
					],
				],
				'title_field' => '{{{ title }}}',
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'    => 'thumbnail_size',
				'label'   => esc_html__( 'Image Size', 'bdthemes-prime-slider' ),
				'exclude' => [ 'custom' ],
				'default' => 'full',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_slider_settings',
			[
				'label' => __('Slider Settings', 'bdthemes-prime-slider'),
			]
		);

		$this->add_control(
			'autoplay',
			[
				'label'   => __( 'Autoplay', 'bdthemes-prime-slider' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
				
			]
		);

		$this->add_control(
			'autoplay_speed',
			[
				'label'     => esc_html__( 'Autoplay Speed', 'bdthemes-prime-slider' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 5000,
				'condition' => [
					'autoplay' => 'yes',
				],
			]
		);

		$this->add_control(
			'pauseonhover',
			[
				'label' => esc_html__( 'Pause on Hover', 'bdthemes-prime-slider' ),
				'type'  => Controls_Manager::SWITCHER,
			]
		);

		$this->add_responsive_control(
			'slides_to_scroll',
			[
				'type'      => Controls_Manager::SELECT,
				'label'     => esc_html__( 'Slides to Scroll', 'bdthemes-prime-slider' ),
				'default'        => 1,
				'tablet_default' => 1,
				'mobile_default' => 1,
				'options'   => [
					1 => '1',
					2 => '2',
					3 => '3',
					4 => '4',
					5 => '5',
					6 => '6',
				],
			]
		);

		$this->add_control(
			'centered_slides',
			[
				'label'   => __( 'Center Slide', 'bdthemes-prime-slider' ),
				'description'   => __( 'Use even items from Layout > Columns settings for better preview.', 'bdthemes-prime-slider' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes'
			]
		);

		$this->add_control(
			'grab_cursor',
			[
				'label'   => __( 'Grab Cursor', 'bdthemes-prime-slider' ),
				'type'    => Controls_Manager::SWITCHER,
			]
		);

		$this->add_control(
			'free_mode',
			[
				'label'   => __( 'Drag free Mode', 'bdthemes-prime-slider' ),
				'type'    => Controls_Manager::SWITCHER,
			]
		);

		$this->add_control(
			'loop',
			[
				'label'   => __( 'Loop', 'bdthemes-prime-slider' ),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
				
			]
		);


		$this->add_control(
			'speed',
			[
				'label'   => __( 'Animation Speed (ms)', 'bdthemes-prime-slider' ),
				'type'    => Controls_Manager::SLIDER,
				'default' => [
					'size' => 900,
				],
				'range' => [
					'min'  => 100,
					'max'  => 5000,
					'step' => 50,
				],
			]
		);

		$this->add_control(
			'observer',
			[
				'label'       => __( 'Observer', 'bdthemes-prime-slider' ),
				'description' => __( 'When you use carousel in any hidden place (in tabs, accordion etc) keep it yes.', 'bdthemes-prime-slider' ),
				'type'        => Controls_Manager::SWITCHER,				
			]
		);

		$this->end_controls_section();
	
		//Style Start
		$this->start_controls_section(
			'section_style_sliders',
			[
				'label'     => esc_html__('Sliders', 'bdthemes-prime-slider'),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'slider_wrap_margin',
			[
				'label'      => __( 'Margin', 'bdthemes-prime-slider' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .bdt-escape-slider' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'slider_wrap_padding',
			[
				'label'      => __( 'Content Padding', 'bdthemes-prime-slider' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .bdt-escape-slider .bdt-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->add_responsive_control(
			'image_border_radius',
			[
				'label'      => esc_html__( 'Image Border Radius', 'bdthemes-prime-slider' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .bdt-escape-slider .bdt-image-wrap .bdt-img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs('slider_item_style');

		$this->start_controls_tab(
			'slider_title_style',
			[
				'label' 	=> __('Title', 'bdthemes-prime-slider'),
				'condition' => [
					'show_title' => ['yes'],
				],
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'     => esc_html__('Color', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-escape-slider .bdt-title, {{WRAPPER}} .bdt-escape-slider .bdt-title a' => 'color: {{VALUE}};',
				],
				'condition' => [
					'show_title' => ['yes'],
				],
			]
		);

		$this->add_control(
			'title_hover_color',
			[
				'label'     => esc_html__('Hover Color', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-escape-slider .bdt-title:hover, {{WRAPPER}} .bdt-escape-slider .bdt-title a:hover' => 'color: {{VALUE}};',
				],
				'condition' => [
					'show_title' => ['yes'],
				],
			]
		);

		$this->add_control(
            'first_word_title_color',
            [
                'label'     => esc_html__('First Word Color', 'bdthemes-prime-slider'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-escape-slider .bdt-title .frist-word' => 'color: {{VALUE}};',
                ],
                'condition' => [
					'show_title' => ['yes'],
				],
            ]
        );

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'label'    => esc_html__('Typography', 'bdthemes-prime-slider'),
				'selector' => '{{WRAPPER}} .bdt-escape-slider .bdt-title',
				'condition' => [
					'show_title' => ['yes'],
				],
			]
		);

		$this->add_responsive_control(
			'title_padding',
			[
				'label'      => __( 'Margin', 'bdthemes-prime-slider' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .bdt-escape-slider .bdt-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'slider_text_style',
			[
				'label' 	=> __('Text', 'bdthemes-prime-slider'),
				'condition' => [
					'show_text' => ['yes'],
				],
			]
		);

		$this->add_control(
			'text_color',
			[
				'label'     => esc_html__('Color', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-escape-slider .bdt-text' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'text_typography',
				'label'    => esc_html__('Typography', 'bdthemes-prime-slider'),
				'selector' => '{{WRAPPER}} .bdt-escape-slider .bdt-text',
			]
		);

		$this->add_responsive_control(
			'text_padding',
			[
				'label'      => __( 'Margin', 'bdthemes-prime-slider' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .bdt-escape-slider .bdt-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'slider_link_btn_style',
			[
				'label' 	=> __('Button', 'bdthemes-prime-slider'),
			]
		);

		$this->add_control(
			'link_btn_color',
			[
				'label'     => esc_html__( 'Color', 'bdthemes-prime-slider' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-escape-slider .bdt-link-btn a' => 'color: {{VALUE}};',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'link_btn_background',
				'selector' => '{{WRAPPER}} .bdt-escape-slider .bdt-link-btn a',
			]
		);
		
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'link_btn_border',
				'selector' => '{{WRAPPER}} .bdt-escape-slider .bdt-link-btn a',
			]
		);
		
		$this->add_responsive_control(
			'link_btn_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'bdthemes-prime-slider' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .bdt-escape-slider .bdt-link-btn a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		
		$this->add_responsive_control(
			'link_btn_padding',
			[
				'label'      => esc_html__( 'Padding', 'bdthemes-prime-slider' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .bdt-escape-slider .bdt-link-btn a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'link_btn_margin',
			[
				'label'      => esc_html__( 'Margin', 'bdthemes-prime-slider' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .bdt-escape-slider .bdt-link-btn a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'link_btn_shadow',
				'selector' => '{{WRAPPER}} .bdt-escape-slider .bdt-link-btn a',
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'link_btn_typography',
				'label'    => esc_html__( 'Typography', 'bdthemes-prime-slider' ),
				'selector' => '{{WRAPPER}} .bdt-escape-slider .bdt-link-btn a',
			]
		);

		$this->add_control(
			'link_button_hover_heading',
			[
				'label' => esc_html__( 'HOVER', 'bdthemes-prime-slider' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'link_btn_hover_color',
			[
				'label'     => esc_html__( 'Color', 'bdthemes-prime-slider' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-escape-slider .bdt-link-btn a:hover' => 'color: {{VALUE}};',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'link_btn_hover_background',
				'selector' => '{{WRAPPER}} .bdt-escape-slider .bdt-link-btn a:hover',
			]
		);
		
		$this->add_control(
			'link_btn_hover_border_color',
			[
				'label'     => esc_html__( 'Border Color', 'bdthemes-prime-slider' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => [
					'link_btn_border_border!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .bdt-escape-slider .bdt-link-btn a:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_navigation',
			[
				'label'     => __('Navigation', 'bdthemes-prime-slider'),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'nav_arrows_icon',
			[
				'label'   => esc_html__( 'Arrows Icon', 'bdthemes-element-pack' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '3',
				'options' => [
					'0' => esc_html__('Default', 'bdthemes-element-pack'),
					'1' => esc_html__('Style 1', 'bdthemes-element-pack'),
					'2' => esc_html__('Style 2', 'bdthemes-element-pack'),
					'3' => esc_html__('Style 3', 'bdthemes-element-pack'),
					'4' => esc_html__('Style 4', 'bdthemes-element-pack'),
					'5' => esc_html__('Style 5', 'bdthemes-element-pack'),
					'6' => esc_html__('Style 6', 'bdthemes-element-pack'),
					'7' => esc_html__('Style 7', 'bdthemes-element-pack'),
					'8' => esc_html__('Style 8', 'bdthemes-element-pack'),
					'9' => esc_html__('Style 9', 'bdthemes-element-pack'),
					'10' => esc_html__('Style 10', 'bdthemes-element-pack'),
					'11' => esc_html__('Style 11', 'bdthemes-element-pack'),
					'12' => esc_html__('Style 12', 'bdthemes-element-pack'),
					'13' => esc_html__('Style 13', 'bdthemes-element-pack'),
					'14' => esc_html__('Style 14', 'bdthemes-element-pack'),
					'15' => esc_html__('Style 15', 'bdthemes-element-pack'),
					'16' => esc_html__('Style 16', 'bdthemes-element-pack'),
					'17' => esc_html__('Style 17', 'bdthemes-element-pack'),
					'18' => esc_html__('Style 18', 'bdthemes-element-pack'),
					'circle-1' => esc_html__('Style 19', 'bdthemes-element-pack'),
					'circle-2' => esc_html__('Style 20', 'bdthemes-element-pack'),
					'circle-3' => esc_html__('Style 21', 'bdthemes-element-pack'),
					'circle-4' => esc_html__('Style 22', 'bdthemes-element-pack'),
					'square-1' => esc_html__('Style 23', 'bdthemes-element-pack'),
				],
				'condition' => [
					'show_navigation_arrows' => ['yes'],
				],
			]
		);


		$this->add_control(
			'arrows_color',
			[
				'label'     => __('Arrows Color', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-escape-slider .bdt-navigation-wrap .bdt-nav-btn' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'arrows_font_size',
			[
				'label'     => __('Arrows Size', 'bdthemes-prime-slider'),
				'type'  => Controls_Manager::SLIDER,
				'size_units' => [ '%', 'px', 'vh' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
					'%' => [
						'min' => 10,
						'max' => 100,
					],
					'vh' => [
						'min' => 10,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bdt-escape-slider .bdt-navigation-wrap .bdt-nav-btn' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'arrows_background',
				'selector' => '{{WRAPPER}} .bdt-escape-slider .bdt-navigation-wrap .bdt-nav-btn',
			]
		);
		
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'arrows_border',
				'selector' => '{{WRAPPER}} .bdt-escape-slider .bdt-navigation-wrap .bdt-nav-btn',
			]
		);
		
		$this->add_responsive_control(
			'arrows_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'bdthemes-prime-slider' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .bdt-escape-slider .bdt-navigation-wrap .bdt-nav-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		
		$this->add_responsive_control(
			'arrows_padding',
			[
				'label'      => esc_html__( 'Padding', 'bdthemes-prime-slider' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .bdt-escape-slider .bdt-navigation-wrap .bdt-nav-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'arrows_margin',
			[
				'label'      => esc_html__( 'Margin', 'bdthemes-prime-slider' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .bdt-escape-slider .bdt-navigation-wrap .bdt-nav-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'arrows_shadow',
				'selector' => '{{WRAPPER}} .bdt-escape-slider .bdt-navigation-wrap .bdt-nav-btn',
			]
		);
		
		$this->add_control(
			'arrows_hover_heading',
			[
				'label' => esc_html__( 'HOVER', 'bdthemes-prime-slider' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'arrows_hover_color',
			[
				'label'     => esc_html__( 'Color', 'bdthemes-prime-slider' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-escape-slider .bdt-navigation-wrap .bdt-nav-btn:hover' => 'color: {{VALUE}};',
				],
			]
		);
		
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'arrows_hover_background',
				'selector' => '{{WRAPPER}} .bdt-escape-slider .bdt-navigation-wrap .bdt-nav-btn:hover',
			]
		);
		
		$this->add_control(
			'arrows_hover_border_color',
			[
				'label'     => esc_html__( 'Border Color', 'bdthemes-prime-slider' ),
				'type'      => Controls_Manager::COLOR,

				'selectors' => [
					'{{WRAPPER}} .bdt-escape-slider .bdt-navigation-wrap .bdt-nav-btn:hover' => 'border-color: {{VALUE}};',
				],
			]
		);



		$this->add_control(
			'Fraction_pag_heading',
			[
				'label' => esc_html__( 'Fraction Pagination', 'bdthemes-prime-slider' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		
		$this->add_control(
			'pagination_color',
			[
				'label'     => __('Pagination Color', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-escape-slider .bdt-pagination .swiper-pagination-bullet' => 'color: {{VALUE}}',
				],
				'condition' => [
					'show_navigation_fraction' => ['yes'],
				],
			]
		);

		$this->add_control(
			'pagination_hover_color',
			[
				'label'     => __('Pagination Hover Color', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-escape-slider .bdt-pagination .swiper-pagination-bullet:hover' => 'color: {{VALUE}}',
				],
				'condition' => [
					'show_navigation_fraction' => ['yes'],
				],
			]
		);

		$this->add_control(
			'pagination_active_color',
			[
				'label'     => __('Pagination Active Color', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-escape-slider .bdt-pagination .swiper-pagination-bullet.swiper-pagination-bullet-active' => 'color: {{VALUE}}',
					'{{WRAPPER}} .bdt-escape-slider .bdt-pagination .swiper-pagination-bullet::after' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'show_navigation_fraction' => ['yes'],
				],
			]
		);

		$this->add_responsive_control(
			'fraction_line_width',
			[
				'label'     => __('Line Width', 'bdthemes-prime-slider'),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 300,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bdt-escape-slider .bdt-pagination .swiper-pagination-bullet.swiper-pagination-bullet-active::after' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'pagination_typography',
				'label'    => esc_html__('Typography', 'bdthemes-prime-slider'),
				'selector' => '{{WRAPPER}} .bdt-escape-slider .bdt-pagination .swiper-pagination-bullet',
				'condition' => [
					'show_title' => ['yes'],
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render_header() {
		$settings   = $this->get_settings_for_display();
		$id         = 'bdt-prime-slider-' . $this->get_id();

		$this->add_render_attribute( 'prime-slider-escape', 'id', $id );
		$this->add_render_attribute( 'prime-slider-escape', 'class', [ 'bdt-escape-slider', 'elementor-swiper' ] );

		$this->add_render_attribute(
			[
				'prime-slider-escape' => [
					'data-settings' => [
						wp_json_encode(array_filter([
							"autoplay"       => ("yes" == $settings["autoplay"]) ? ["delay" => $settings["autoplay_speed"]] : false,
							"loop"           => ($settings["loop"] == "yes") ? true : false,
							"speed"          => $settings["speed"]["size"],
							"effect"         => 'fade',
							"fadeEffect"     => ['crossFade' => true],
							"lazy"           => true,
							"parallax"       => true,
							"mousewheel"       => true,
							"grabCursor"     => ($settings["grab_cursor"] === "yes") ? true : false,
							"pauseOnHover"   => ("yes" == $settings["pauseonhover"]) ? true : false,
							"slidesPerView"  => 1,
							"loopedSlides"   => 4,
							"observer"       => ($settings["observer"]) ? true : false,
							"observeParents" => ($settings["observer"]) ? true : false,
							"pagination" => [
								"el"             => "#" . $id . " .bdt-pagination",
								"clickable"      => "true",
							],
							"scrollbar" => [
								"el"             => "#" . $id . " .swiper-scrollbar",
							],
							"lazy" => [
								"loadPrevNext"  => "true",
							],
							"navigation" => [
								"nextEl" => "#" . $id . " .bdt-button-next",
								"prevEl" => "#" . $id . " .bdt-button-prev",
							],
						]))
					]
				]
			]
		);

		?>
		<div <?php $this->print_render_attribute_string( 'prime-slider-escape' ); ?>>
			<div class="swiper-container swiper bdt-main-slider">
				<div class="swiper-wrapper">
		<?php
	}

    public function render_footer() {
		$settings = $this->get_settings_for_display();
		?> 
				</div>

			</div>
			<div thumbsSlider="" class="bdt-thumbs-slider">
                <div class="swiper-wrapper">

				<?php foreach ($settings['slides'] as $slide) : ?>
					<div class="swiper-slide bdt-item">
				    	<?php $this->rendar_item_image($slide); ?>

                    </div>
				<?php endforeach; ?>

                </div>
				

			<div class="bdt-nav-pag-wrap">
				<?php if ($settings['show_navigation_fraction']) : ?>
                     <div class="bdt-pagination"></div>
				 <?php endif; ?>
				 <?php if ($settings['show_navigation_arrows']) : ?>
					<div class="bdt-navigation-wrap">
						<div class="bdt-button-next bdt-nav-btn">
						    <i class="ps-wi-arrow-right-<?php echo esc_attr($settings['nav_arrows_icon']); ?>" aria-hidden="true"></i>
						</div>
						<div class="bdt-button-prev bdt-nav-btn">
					    	<i class="ps-wi-arrow-left-<?php echo esc_attr($settings['nav_arrows_icon']); ?>" aria-hidden="true"></i>
						</div>
					</div>
				 <?php endif; ?>
             </div>

		    </div>

            </div>


		<?php
	}


	public function render_text($slide) {
		$settings = $this->get_settings_for_display();

		if ('' == $settings['show_text']) {
			return;
		}

		$text_hide_on_setup = '';

		if (!empty($settings['text_hide_on'])) {
			foreach ($settings['text_hide_on'] as $element) {

				if ($element == 'desktop') {
					$text_hide_on_setup .= ' bdt-desktop';
				}
				if ($element == 'tablet') {
					$text_hide_on_setup .= ' bdt-tablet';
				}
				if ($element == 'mobile') {
					$text_hide_on_setup .= ' bdt-mobile';
				}
			}
		}

		?>
		<?php if ($slide['text'] && ('yes' == $settings['show_text'])) : ?>
			<div class="bdt-text <?php echo $text_hide_on_setup; ?>" data-swiper-parallax-y="-200">
				<?php echo wp_kses_post($slide['text']); ?>
			</div>
		<?php endif; ?>
		<?php
	}

	public function rendar_item_image($slide) {
		$settings = $this->get_settings_for_display();

		?>

		<div class="bdt-image-wrap">
			<?php
			$thumb_url = Group_Control_Image_Size::get_attachment_image_src($slide['image']['id'], 'thumbnail_size', $settings);
			if (!$thumb_url) {
				printf('<img src="%1$s" alt="%2$s" class="bdt-img">', $slide['image']['url'], esc_html($slide['title']));
			} else {
				print(wp_get_attachment_image(
					$slide['image']['id'],
					$settings['thumbnail_size_size'],
					false,
					[
						'class' => 'bdt-img',
						'alt' => esc_html($slide['title'])
					]
				));
			}
			?>
		</div>

		<?php
	}

	public function render_button($content) {
		$settings = $this->get_settings_for_display();

		// $this->add_render_attribute('slider-button', '', true);

		if ($content['button_link']['url']) {
			$this->add_render_attribute('slider-button', 'href', $content['button_link']['url'], true);

			if ($content['button_link']['is_external']) {
				$this->add_render_attribute('slider-button', 'target', '_blank', true);
			}

			if ($content['button_link']['nofollow']) {
				$this->add_render_attribute('slider-button', 'rel', 'nofollow', true);
			}
		} else {
			$this->add_render_attribute('slider-button', 'href', '#', true);
		}

		?>

		<?php if ($content['slide_button_text'] && ('yes' == $settings['show_button_text'])) : ?>

		<div class="bdt-link-btn" data-swiper-parallax-y="-150">
			<a <?php $this->print_render_attribute_string('slider-button'); ?>>
				<?php echo wp_kses($content['slide_button_text'], prime_slider_allow_tags('title')); ?>
			</a>
		</div>

		<?php endif;
	}

    public function render_slides_loop() {
        $settings = $this->get_settings_for_display();

		foreach ($settings['slides'] as $slide) : 
		
			?>
			<div class="bdt-item swiper-slide">
				<div class="bdt-content">

					<?php if ($slide['title'] && ('yes' == $settings['show_title'])) : ?>
						<<?php echo Utils::get_valid_html_tag($settings['title_html_tag']); ?> class="bdt-title" data-swiper-parallax-y="-250">
							<?php if ('' !== $slide['title_link']['url']) : ?>
								<a href="<?php echo esc_url($slide['title_link']['url']); ?>">
								<?php endif; ?>
								<?php echo prime_slider_first_word($slide['title']); ?>
								<?php if ('' !== $slide['title_link']['url']) : ?>
								</a>
							<?php endif; ?>
						</<?php echo Utils::get_valid_html_tag($settings['title_html_tag']); ?>>
					<?php endif; ?>

					<?php $this->render_text($slide); ?>

					<?php $this->render_button($slide); ?>

					</div>
			</div>

        <?php endforeach;
    }

    public function render() {
		
        $this->render_header();

        $this->render_slides_loop();

        $this->render_footer();
    }
}