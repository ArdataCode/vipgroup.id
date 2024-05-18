<?php
namespace PrimeSlider\Modules\Fortune\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Text_Stroke;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Repeater;
use PrimeSlider\Utils;

use PrimeSlider\Traits\Global_Widget_Controls;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Fortune extends Widget_Base {

	use Global_Widget_Controls;

	public function get_name() {
		return 'prime-slider-fortune';
	}

	public function get_title() {
		return BDTPS . esc_html__('Fortune', 'bdthemes-prime-slider');
	}

	public function get_icon() {
		return 'bdt-widget-icon ps-wi-fortune';
	}

	public function get_categories() {
		return ['prime-slider'];
	}

	public function get_keywords() {
		return [ 'prime slider', 'slider', 'fortune', 'prime' ];
	}

	public function get_style_depends() {
		return ['prime-slider-font', 'ps-fortune'];
	}

	public function get_script_depends() {
        $reveal_effects = prime_slider_option('reveal-effects', 'prime_slider_other_settings', 'off');
		if ('on' === $reveal_effects) {
            return ['anime', 'revealFx', 'ps-fortune'];
		} else {
            return ['ps-fortune'];
        }
    }

	// public function get_custom_help_url() {
	// 	return 'https://youtu.be/pk5kCstNHBY';
	// }

	protected function register_controls() {
		$reveal_effects = prime_slider_option('reveal-effects', 'prime_slider_other_settings', 'off');
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
					'{{WRAPPER}} .bdt-fortune-slider' => 'height: {{SIZE}}{{UNIT}};',
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
					'{{WRAPPER}} .bdt-fortune-slider .bdt-thumbs-slider' => 'width: {{SIZE}}{{UNIT}};',
				],
				'render_type' => 'template'
			]
		);

		$this->add_control(
			'show_sub_title',
			[
				'label'   => esc_html__('Show Sub Title', 'bdthemes-prime-slider'),
				'type'    => Controls_Manager::SWITCHER,
				'default' => 'yes',
				'separator' => 'before'
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
				'label'       => __('Text Hide On', 'bdthemes-prime-slider') . BDTPS_NC,
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
            'content_position',
            [
                'label'   => esc_html__( 'Content Position', 'bdthemes-prime-slider' ) . BDTPS_NC,
                'type'    => Controls_Manager::CHOOSE,
				'default' => 'center',
				'toggle' => false,
                'options' => [
					'center' => [
                        'title' => esc_html__( 'Center', 'bdthemes-prime-slider' ),
                        'icon'  => 'eicon-align-center-h',
                    ],
                    'flex-start' => [
                        'title' => esc_html__( 'Start', 'bdthemes-prime-slider' ),
                        'icon'  => 'eicon-align-start-v',
                    ],
                    'flex-end' => [
                        'title' => esc_html__( 'End', 'bdthemes-prime-slider' ),
                        'icon'  => 'eicon-align-end-v',
                    ],
                    'space-between' => [
                        'title' => esc_html__( 'Space Between', 'bdthemes-prime-slider' ),
                        'icon'  => 'eicon-justify-space-between-v',
                    ],
                    'space-around' => [
                        'title' => esc_html__( 'Space Around', 'bdthemes-prime-slider' ),
                        'icon'  => 'eicon-justify-space-around-v',
                    ],
                    'space-evenly' => [
                        'title' => esc_html__( 'Space Evenly', 'bdthemes-prime-slider' ),
                        'icon'  => 'eicon-justify-space-evenly-v',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdt-fortune-slider .bdt-content' => 'justify-content: {{VALUE}};',
                ],
				'label_block' => true,
				'separator' => 'before'
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
                    '{{WRAPPER}} .bdt-fortune-slider .bdt-content' => 'text-align: {{VALUE}};',
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
			'sub_title',
			[
				'label'       => esc_html__('Sub Title', 'bdthemes-prime-slider'),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'dynamic'     => ['active' => true],
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
						'sub_title' => esc_html__('Explore', 'bdthemes-prime-slider'),
						'title'     => esc_html__('Massive', 'bdthemes-prime-slider'),
						'image'     => ['url' => BDTPS_ASSETS_URL . 'images/gallery/item-1.svg']
					],
					[
						'sub_title' => esc_html__('Explore', 'bdthemes-prime-slider'),
						'title'     => esc_html__('Vibrant', 'bdthemes-prime-slider'),
						'image'     => ['url' => BDTPS_ASSETS_URL . 'images/gallery/item-4.svg']
					],
					[
						'sub_title' => esc_html__('Explore', 'bdthemes-prime-slider'),
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

		$this->add_control(
			'grab_cursor',
			[
				'label'   => __( 'Grab Cursor', 'bdthemes-prime-slider' ),
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

		/**
         * Reveal Effects
         */
        if ('on' === $reveal_effects) {
            $this->register_reveal_effects();
        }
	
		//Style Start
		$this->start_controls_section(
			'section_style_image',
			[
				'label'     => esc_html__('Image', 'bdthemes-prime-slider'),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'overlay_type',
			[
				'label'   => esc_html__( 'Overlay', 'bdthemes-prime-slider' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'none',
				'options' => [
					'none'       => esc_html__( 'None', 'bdthemes-prime-slider' ),
					'background' => esc_html__( 'Background', 'bdthemes-prime-slider' ),
					'blend'      => esc_html__( 'Blend', 'bdthemes-prime-slider' ),
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'overlay_color',
				'label' => esc_html__( 'Background', 'bdthemes-prime-slider' ),
				'types' => [ 'classic', 'gradient' ],
				'exclude' => [ 'image' ],
				'selector' => '{{WRAPPER}} .bdt-fortune-slider .bdt-image-wrap:before',
				'fields_options' => [
					'background' => [
						'default' => 'classic',
					],
					'color' => [
						'default' => 'rgba(255, 255, 255, 0.3)',
					],
				],
				'condition' => [
					'overlay_type' => ['background', 'blend'],
				],
			]
		);

		$this->add_control(
			'blend_type',
			[
				'label'     => esc_html__( 'Blend Type', 'bdthemes-prime-slider' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'multiply',
				'options'   => prime_slider_blend_options(),
				'condition' => [
					'overlay_type' => 'blend',
				],
				'selectors' => [
					'{{WRAPPER}} .bdt-fortune-slider .bdt-image-wrap:before' => 'mix-blend-mode: {{VALUE}};'
				],
			]
		);

		$this->add_group_control(
			Group_Control_Css_Filter::get_type(),
			[
				'name' => 'custom_css_filters',
				'selector' => '{{WRAPPER}} .bdt-fortune-slider .bdt-image-wrap img',
				'separator' => 'before'
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_title',
			[
				'label'     => esc_html__('Title', 'bdthemes-prime-slider'),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_title' => 'yes'
				],
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'     => esc_html__('Color', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-fortune-slider .bdt-title, {{WRAPPER}} .bdt-fortune-slider .bdt-title a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'title_hover_color',
			[
				'label'     => esc_html__('Hover Color', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-fortune-slider .bdt-title:hover, {{WRAPPER}} .bdt-fortune-slider .bdt-title a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
            'first_word_title_color',
            [
                'label'     => esc_html__('First Word Color', 'bdthemes-prime-slider'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-fortune-slider .bdt-title .frist-word' => 'color: {{VALUE}};',
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
					'{{WRAPPER}} .bdt-fortune-slider .bdt-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Text_Stroke::get_type(),
			[
				'name' => 'title_text_stroke',
				'selector' => '{{WRAPPER}}.bdt-fortune-slider .bdt-title',
				'fields_options' => [
                    'text_stroke_type' => [
                        'label' => esc_html__( 'Text Stroke', 'bdthemes-prime-slider' ),
                    ],
                ],
			]
		);

		$this->add_group_control(
			Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'title_text_shadow',
				'label' => __('Text Shadow', 'bdthemes-prime-slider'),
				'selector' => '{{WRAPPER}} .bdt-fortune-slider .bdt-title',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'label'    => esc_html__('Typography', 'bdthemes-prime-slider'),
				'selector' => '{{WRAPPER}} .bdt-fortune-slider .bdt-title',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_sub_title',
			[
				'label'     => esc_html__('Sub Title', 'bdthemes-prime-slider'),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_sub_title' => 'yes',
				],
			]
		);

		$this->add_control(
			'sub_title_color',
			[
				'label'     => esc_html__('Color', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-fortune-slider .bdt-sub-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'sub_title_margin',
			[
				'label'      => esc_html__( 'Margin', 'bdthemes-prime-slider' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .bdt-fortune-slider .bdt-sub-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'sub_title_typography',
				'label'    => esc_html__('Typography', 'bdthemes-prime-slider'),
				'selector' => '{{WRAPPER}} .bdt-fortune-slider .bdt-sub-title',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_text',
			[
				'label'     => esc_html__('Text', 'bdthemes-prime-slider'),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_text' => 'yes',
				],
			]
		);

		$this->add_control(
			'text_color',
			[
				'label'     => esc_html__('Color', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-fortune-slider .bdt-text' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'text_margin',
			[
				'label'      => esc_html__( 'Margin', 'bdthemes-prime-slider' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .bdt-fortune-slider .bdt-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'text_typography',
				'label'    => esc_html__('Typography', 'bdthemes-prime-slider'),
				'selector' => '{{WRAPPER}} .bdt-fortune-slider .bdt-text',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_readmore',
			[
				'label'     => esc_html__('Read More', 'bdthemes-prime-slider'),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_button_text' => 'yes',
				],
			]
		);

		$this->start_controls_tabs('tabs_readmore_style');

		$this->start_controls_tab(
			'tab_readmore_normal',
			[
				'label' => esc_html__('Normal', 'bdthemes-prime-slider'),
			]
		);

		$this->add_control(
			'button_type',
			[
				'label'   => esc_html__( 'Button Type', 'bdthemes-prime-slider' ) . BDTPS_NC,
				'type'    => Controls_Manager::SELECT,
				'default' => 'outline',
				'options' => [
					'fill' => esc_html__('Fill', 'bdthemes-prime-slider'),
					'outline' => esc_html__('Outline', 'bdthemes-prime-slider'),
				],
				'prefix_class' => 'ps-fortune-btn--',
			]
		);

		$this->add_control(
			'link_btn_color',
			[
				'label'     => esc_html__( 'Color', 'bdthemes-prime-slider' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-fortune-slider .bdt-link-btn a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'link_btn_border_color',
			[
				'label'     => esc_html__( 'Border/Outline Color', 'bdthemes-prime-slider' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-fortune-slider .bdt-link-btn a' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .bdt-fortune-slider .bdt-link-btn a:after' => 'border-color: {{VALUE}}; background-color: {{VALUE}};',
				],
				'condition' => [
					'button_type' => 'outline'
				],
			]
		);

		$this->add_control(
			'link_btn_border_fill_color',
			[
				'label'     => esc_html__( 'Border/Fill Color', 'bdthemes-prime-slider' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-fortune-slider .bdt-link-btn a' => 'border-color: {{VALUE}}; background-color: {{VALUE}};',
					'{{WRAPPER}} .bdt-fortune-slider .bdt-link-btn a:after' => 'border-color: {{VALUE}};',
				],
				'condition' => [
					'button_type' => 'fill'
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
					'{{WRAPPER}} .bdt-fortune-slider .bdt-link-btn a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'{{WRAPPER}} .bdt-fortune-slider .bdt-link-btn a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'link_btn_typography',
				'label'    => esc_html__( 'Typography', 'bdthemes-prime-slider' ),
				'selector' => '{{WRAPPER}} .bdt-fortune-slider .bdt-link-btn a',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_readmore_hover',
			[
				'label' => esc_html__('Hover', 'bdthemes-prime-slider'),
			]
		);

		$this->add_control(
			'link_btn_hover_color',
			[
				'label'     => esc_html__( 'Color', 'bdthemes-prime-slider' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-fortune-slider .bdt-link-btn a:hover' => 'color: {{VALUE}};',
				],
			]
		);
		
		$this->add_control(
			'link_btn_hover_border_color',
			[
				'label'     => esc_html__( 'Border Color', 'bdthemes-prime-slider' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-fortune-slider .bdt-link-btn a:hover' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .bdt-fortune-slider .bdt-link-btn a:hover:after' => 'border-color: {{VALUE}}; background-color: {{VALUE}};',
				],
				'condition' => [
					'button_type' => 'outline'
				],
			]
		);

		$this->add_control(
			'link_btn_hover_border_fill_color',
			[
				'label'     => esc_html__( 'Border/Fill Color', 'bdthemes-prime-slider' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-fortune-slider .bdt-link-btn a:hover' => 'border-color: {{VALUE}}; background-color: {{VALUE}};',
					'{{WRAPPER}} .bdt-fortune-slider .bdt-link-btn a:hover:after' => 'border-color: {{VALUE}};',
				],
				'condition' => [
					'button_type' => 'fill'
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
			'arrows_heading',
			[
				'label'     => __('A R R O W S', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::HEADING,
				'condition' => [
					'show_navigation_arrows' => ['yes'],
				],
			]
		);

		$this->add_control(
			'nav_arrows_icon',
			[
				'label'   => esc_html__( 'Arrows Icon', 'bdthemes-prime-slider' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '3',
				'options' => [
					'0' => esc_html__('Default', 'bdthemes-prime-slider'),
					'1' => esc_html__('Style 1', 'bdthemes-prime-slider'),
					'2' => esc_html__('Style 2', 'bdthemes-prime-slider'),
					'3' => esc_html__('Style 3', 'bdthemes-prime-slider'),
					'4' => esc_html__('Style 4', 'bdthemes-prime-slider'),
					'5' => esc_html__('Style 5', 'bdthemes-prime-slider'),
					'6' => esc_html__('Style 6', 'bdthemes-prime-slider'),
					'7' => esc_html__('Style 7', 'bdthemes-prime-slider'),
					'8' => esc_html__('Style 8', 'bdthemes-prime-slider'),
					'9' => esc_html__('Style 9', 'bdthemes-prime-slider'),
					'10' => esc_html__('Style 10', 'bdthemes-prime-slider'),
					'11' => esc_html__('Style 11', 'bdthemes-prime-slider'),
					'12' => esc_html__('Style 12', 'bdthemes-prime-slider'),
					'13' => esc_html__('Style 13', 'bdthemes-prime-slider'),
					'14' => esc_html__('Style 14', 'bdthemes-prime-slider'),
					'15' => esc_html__('Style 15', 'bdthemes-prime-slider'),
					'16' => esc_html__('Style 16', 'bdthemes-prime-slider'),
					'17' => esc_html__('Style 17', 'bdthemes-prime-slider'),
					'18' => esc_html__('Style 18', 'bdthemes-prime-slider'),
					'circle-1' => esc_html__('Style 19', 'bdthemes-prime-slider'),
					'circle-2' => esc_html__('Style 20', 'bdthemes-prime-slider'),
					'circle-3' => esc_html__('Style 21', 'bdthemes-prime-slider'),
					'circle-4' => esc_html__('Style 22', 'bdthemes-prime-slider'),
					'square-1' => esc_html__('Style 23', 'bdthemes-prime-slider'),
				],
				'condition' => [
					'show_navigation_arrows' => ['yes'],
				],
			]
		);

		$this->start_controls_tabs('tabs_navigation_arrows_style');

		$this->start_controls_tab(
			'tabs_nav_arrows_normal',
			[
				'label'     => __('Normal', 'bdthemes-prime-slider'),
				'condition' => [
					'show_navigation_arrows' => ['yes'],
				],
			]
		);

		$this->add_control(
			'arrows_color',
			[
				'label'     => __('Color', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-fortune-slider .bdt-nav-btn i' => 'color: {{VALUE}}',
				],
				'condition' => [
					'show_navigation_arrows' => ['yes'],
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'arrows_background',
				'label' => esc_html__('Background', 'bdthemes-prime-slider'),
				'types' => ['classic', 'gradient'],
				'exclude' => ['image'],
				'selector' => '{{WRAPPER}} .bdt-fortune-slider .bdt-nav-btn',
				'condition' => [
					'show_navigation_arrows' => ['yes'],
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'      => 'nav_arrows_border',
				'selector'  => '{{WRAPPER}} .bdt-fortune-slider .bdt-nav-btn',
				'condition' => [
					'show_navigation_arrows' => ['yes'],
				],
				'separator' => 'before'
			]
		);

		$this->add_responsive_control(
			'border_radius',
			[
				'label'      => __('Border Radius', 'bdthemes-prime-slider'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%'],
				'selectors'  => [
					'{{WRAPPER}} .bdt-fortune-slider .bdt-nav-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'show_navigation_arrows' => ['yes'],
				],
			]
		);

		$this->add_responsive_control(
			'arrows_padding',
			[
				'label'      => esc_html__('Padding', 'bdthemes-prime-slider'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .bdt-fortune-slider .bdt-nav-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'show_navigation_arrows' => ['yes'],
				],
			]
		);

		$this->add_responsive_control(
			'arrows_margin',
			[
				'label'      => esc_html__('Margin', 'bdthemes-prime-slider'),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors'  => [
					'{{WRAPPER}} .bdt-fortune-slider .bdt-nav-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'show_navigation_arrows' => ['yes'],
				],
			]
		);

		$this->add_responsive_control(
			'arrows_space_between',
			[
				'label'     => __('Space Between', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} .bdt-fortune-slider .bdt-navigation-wrap' => 'grid-gap: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'show_navigation_arrows' => ['yes'],
				],
			]
		);

		$this->add_responsive_control(
			'arrows_size',
			[
				'label'     => __('Icon Size', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 10,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .bdt-fortune-slider .bdt-nav-btn i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'show_navigation_arrows' => ['yes'],
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'arrows_box_shadow',
				'selector' => '{{WRAPPER}} .bdt-fortune-slider .bdt-nav-btn',
				'condition' => [
					'show_navigation_arrows' => ['yes'],
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tabs_nav_arrows_hover',
			[
				'label'     => __('Hover', 'bdthemes-prime-slider'),
				'condition' => [
					'show_navigation_arrows' => ['yes'],
				],
			]
		);

		$this->add_control(
			'arrows_hover_color',
			[
				'label'     => __('Color', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-navigation-prev:hover i, {{WRAPPER}} .bdt-navigation-next:hover i' => 'color: {{VALUE}}',
				],
				'condition' => [
					'show_navigation_arrows' => ['yes'],
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'arrows_hover_background',
				'label' => esc_html__('Background', 'bdthemes-prime-slider'),
				'types' => ['classic', 'gradient'],
				'exclude' => ['image'],
				'selector' => '{{WRAPPER}} .bdt-navigation-prev:hover, {{WRAPPER}} .bdt-navigation-next:hover',
				'condition' => [
					'show_navigation_arrows' => ['yes'],
				],
			]
		);

		$this->add_control(
			'nav_arrows_hover_border_color',
			[
				'label'     => __('Border Color', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-navigation-prev:hover, {{WRAPPER}} .bdt-navigation-next:hover' => 'border-color: {{VALUE}};',
				],
				'condition' => [
					'nav_arrows_border_border!' => '',
					'show_navigation_arrows' => ['yes'],
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'arrows_hover_box_shadow',
				'selector' => '{{WRAPPER}} .bdt-navigation-prev:hover, {{WRAPPER}} .bdt-navigation-next:hover',
				'condition' => [
					'show_navigation_arrows' => ['yes'],
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_control(
			'hr_1',
			[
				'type'      => Controls_Manager::DIVIDER,
				'condition' => [
					'show_navigation_fraction' => ['yes'],
				],
			]
		);

		$this->add_control(
			'fraction_heading',
			[
				'label'     => __('F R A C T I O N', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::HEADING,
				'condition' => [
					'show_navigation_fraction' => ['yes'],
				],
			]
		);

		$this->add_control(
			'hr_12',
			[
				'type'      => Controls_Manager::DIVIDER,
				'condition' => [
					'show_navigation_fraction' => ['yes'],
				],
			]
		);
		
		$this->add_control(
			'pagination_color',
			[
				'label'     => __('Color', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-fortune-slider .bdt-pagination .swiper-pagination-bullet' => 'color: {{VALUE}}',
				],
				'condition' => [
					'show_navigation_fraction' => ['yes'],
				],
			]
		);

		$this->add_control(
			'pagination_hover_color',
			[
				'label'     => __('Hover Color', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-fortune-slider .bdt-pagination .swiper-pagination-bullet:hover' => 'color: {{VALUE}}',
				],
				'condition' => [
					'show_navigation_fraction' => ['yes'],
				],
			]
		);

		$this->add_control(
			'pagination_active_color',
			[
				'label'     => __('Active Color', 'bdthemes-prime-slider'),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bdt-fortune-slider .bdt-pagination .swiper-pagination-bullet.swiper-pagination-bullet-active' => 'color: {{VALUE}}',
					'{{WRAPPER}} .bdt-fortune-slider .bdt-pagination .swiper-pagination-bullet::after' => 'background-color: {{VALUE}}',
				],
				'condition' => [
					'show_navigation_fraction' => ['yes'],
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'pagination_typography',
				'label'    => esc_html__('Typography', 'bdthemes-prime-slider'),
				'selector' => '{{WRAPPER}} .bdt-fortune-slider .bdt-pagination .swiper-pagination-bullet',
				'condition' => [
					'show_navigation_fraction' => ['yes'],
				],
			]
		);

		$this->add_control(
			'hr_05',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);

		$this->add_control(
			'navi_offset_heading',
			[
				'label' => __('O F F S E T', 'bdthemes-prime-slider'),
				'type'  => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'hr_6',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);

		$this->add_responsive_control(
			'arrows_ncx_position',
			[
				'label'          => __('Arrows Horizontal Offset', 'bdthemes-prime-slider'),
				'type'           => Controls_Manager::SLIDER,
				'range'       => [
					'px' => [
						'min'  => -100,
						'max'  => 100,
						'step' => 1,
					],
				],
				'condition' => [
					'show_navigation_arrows' => ['yes'],
				],
				'selectors'      => [
					'{{WRAPPER}} .bdt-navigation-wrap' => 'left: {{SIZE}}px;'
				],
			]
		);

		$this->add_responsive_control(
			'arrows_ncy_position',
			[
				'label'          => __('Arrows Vertical Offset', 'bdthemes-prime-slider'),
				'type'           => Controls_Manager::SLIDER,
				'range'       => [
					'px' => [
						'min'  => -100,
						'max'  => 100,
						'step' => 1,
					],
				],
				'condition' => [
					'show_navigation_arrows' => ['yes'],
				],
				'selectors'      => [
					'{{WRAPPER}} .bdt-navigation-wrap' => 'top: {{SIZE}}px;'
				],
			]
		);

		$this->add_responsive_control(
			'fraction_ncx_position',
			[
				'label'          => __('Fraction Horizontal Offset', 'bdthemes-prime-slider'),
				'type'           => Controls_Manager::SLIDER,
				'range'       => [
					'px' => [
						'min'  => -100,
						'max'  => 100,
						'step' => 1,
					],
				],
				'condition' => [
					'show_navigation_fraction' => ['yes'],
				],
				'selectors'      => [
					'{{WRAPPER}} .bdt-fortune-slider .bdt-pagination' => 'left: {{SIZE}}px;'
				],
			]
		);

		$this->add_responsive_control(
			'fraction_ncy_position',
			[
				'label'          => __('Fraction Vertical Offset', 'bdthemes-prime-slider'),
				'type'           => Controls_Manager::SLIDER,
				'range'       => [
					'px' => [
						'min'  => -300,
						'max'  => 300,
						'step' => 1,
					],
				],
				'condition' => [
					'show_navigation_fraction' => ['yes'],
				],
				'selectors'      => [
					'{{WRAPPER}} .bdt-fortune-slider .bdt-pagination' => 'bottom: {{SIZE}}px;'
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render_header() {
		$settings   = $this->get_settings_for_display();
		$id         = 'bdt-prime-slider-' . $this->get_id();

		$this->add_render_attribute( 'prime-slider-fortune', 'id', $id );
		$this->add_render_attribute( 'prime-slider-fortune', 'class', [ 'bdt-fortune-slider', 'bdt-prime-slider-fortune', 'elementor-swiper' ] );

		$this->add_render_attribute('slider', 'class', 'bdt-prime-slider');
		//Reveal Effect
		$reveal_effects = prime_slider_option('reveal-effects', 'prime_slider_other_settings', 'off');
		if (('on' === $reveal_effects) && ('yes' === $settings['reveal_effects_enable'])) {
			$this->add_render_attribute('slider', 'class', 'reveal-active-' . $this->get_id());
			$this->add_render_attribute('prime-slider-fortune', 'data-reveal-enable', $settings['reveal_effects_enable']);
			$this->add_render_attribute(
				[
					'prime-slider-fortune' => [
						'data-reveal-settings' => [
							wp_json_encode([
								"bgColors"        => $settings["reveal_effects_color"] ? $settings["reveal_effects_color"] : "#333",
								"direction"       => $settings['reveal_effects_direction'] ? $settings['reveal_effects_direction'] : 'lr',
								"duration"        => $settings['reveal_effects_speed']['size'] ? $settings['reveal_effects_speed']['size'] : 1000,
								"easing"          => $settings['reveal_effects_easing']
							])
						],
					]
				]
			);
		}

		$this->add_render_attribute(
			[
				'prime-slider-fortune' => [
					'data-settings' => [
						wp_json_encode(array_filter([
							"autoplay"       => ("yes" == $settings["autoplay"]) ? ["delay" => $settings["autoplay_speed"]] : false,
							"loop"           => ($settings["loop"] == "yes") ? true : false,
							"speed"          => $settings["speed"]["size"],
							"effect"         => 'slide',
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
								"nextEl" => "#" . $id . " .bdt-navigation-next",
								"prevEl" => "#" . $id . " .bdt-navigation-prev",
							],
						]))
					]
				]
			]
		);

		?>
		<div <?php $this->print_render_attribute_string( 'slider' ); ?>>
		<div <?php $this->print_render_attribute_string( 'prime-slider-fortune' ); ?>>
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
                        <div class="bdt-content">
							<div>
							<?php $this->render_sub_title($slide); ?>
							<?php if ($slide['title'] && ('yes' == $settings['show_title'])) : ?>
								<<?php echo Utils::get_valid_html_tag($settings['title_html_tag']); ?> class="bdt-title" data-reveal="reveal-active">
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
							
							</div>
							<?php $this->render_button($slide); ?>
                        </div>


                    </div>
				<?php endforeach; ?>

                </div>
            </div>


			<div class="bdt-nav-pag-wrap reveal-muted">
				<?php if ($settings['show_navigation_fraction']) : ?>
                     <div class="bdt-pagination"></div>
				 <?php endif; ?>
				 <?php if ($settings['show_navigation_arrows']) : ?>
					<div class="bdt-navigation-wrap">
						<div class="bdt-navigation-next bdt-nav-btn">
						    <i class="ps-wi-arrow-right-<?php echo esc_attr($settings['nav_arrows_icon']); ?>" aria-hidden="true"></i>
						</div>
						<div class="bdt-navigation-prev bdt-nav-btn">
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
			<div class="bdt-text <?php echo $text_hide_on_setup; ?>" data-reveal="reveal-active">
				<?php echo wp_kses_post($slide['text']); ?>
			</div>
		<?php endif; ?>
		<?php
	}

	public function render_sub_title($slide) {
		$settings = $this->get_settings_for_display();

		if ('' == $settings['show_sub_title']) {
			return;
		}

		?>
		<h4 class="bdt-sub-title" data-reveal="reveal-active">
			<?php echo wp_kses($slide['sub_title'], prime_slider_allow_tags('title')); ?>
		</h4>
		<?php
	}

	public function rendar_item_image($slide) {
		$settings = $this->get_settings_for_display();

		?>

		<div class="bdt-image-wrap" data-reveal="reveal-active">
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

		$this->add_render_attribute('slider-button', 'data-reveal', 'reveal-active', true);

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

		<div class="bdt-link-btn">
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
				<?php $this->rendar_item_image($slide); ?>
			</div>

        <?php endforeach;
    }

    public function render() {
		
        $this->render_header();

        $this->render_slides_loop();

        $this->render_footer();
    }
}