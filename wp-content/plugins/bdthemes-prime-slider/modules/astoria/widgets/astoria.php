<?php

namespace PrimeSlider\Modules\Astoria\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;
use Elementor\Repeater;
use Elementor\Widget_Base;
use PrimeSlider\Traits\Global_Widget_Controls;
use PrimeSlider\Utils;

if (!defined('ABSPATH')) {
    exit;
}
// Exit if accessed directly

class Astoria extends Widget_Base {

    use Global_Widget_Controls;

    public function get_name() {
        return 'prime-slider-astoria';
    }

    public function get_title() {
        return BDTPS . esc_html__('Astoria', 'bdthemes-prime-slider');
    }

    public function get_icon() {
        return 'bdt-widget-icon ps-wi-astoria';
    }

    public function get_categories() {
        return ['prime-slider'];
    }

    public function get_keywords() {
        return ['prime slider', 'slider', 'astoria', 'prime'];
    }

    public function get_style_depends() {
        return ['prime-slider-font', 'ps-astoria'];
    }

    public function get_script_depends() {
        $reveal_effects = prime_slider_option('reveal-effects', 'prime_slider_other_settings', 'off');
		if ('on' === $reveal_effects) {
            return ['gsap', 'anime', 'revealFx', 'ps-astoria'];
		} else {
            return ['gsap', 'anime', 'ps-astoria'];
        }
    }

    public function get_custom_help_url() {
        return 'https://youtu.be/Vpa_WPQ0mWw';
    }

    protected function register_controls() {
        $reveal_effects = prime_slider_option('reveal-effects', 'prime_slider_other_settings', 'off');
        $this->start_controls_section(
            'section_content_layout',
            [
                'label' => esc_html__('Layout', 'bdthemes-prime-slider'),
            ]
        );

        $this->add_responsive_control(
            'slider_height',
            [
                'label' => esc_html__('Height', 'bdthemes-prime-slider'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'vh'],
                'range' => [
                    'px' => [
                        'min' => 50,
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
                'selectors' => [
                    '{{WRAPPER}} .bdt-astoria-slider' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'content_width',
            [
                'label' => esc_html__('Content Width', 'bdthemes-prime-slider'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'wh'],
                'range' => [
                    'px' => [
                        'min' => 200,
                        'max' => 1400,
                    ],
                    '%' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                    'wh' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdt-astoria-slider .bdt-content' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'content_alignment',
            [
                'label' => esc_html__('Alignment', 'bdthemes-prime-slider'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'bdthemes-prime-slider'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'bdthemes-prime-slider'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'bdthemes-prime-slider'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdt-astoria-slider .bdt-content' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'show_sub_title',
            [
                'label' => esc_html__('Show Sub Title', 'bdthemes-prime-slider'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'show_title',
            [
                'label' => esc_html__('Show Title', 'bdthemes-prime-slider'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'title_html_tag',
            [
                'label' => __('Title HTML Tag', 'bdthemes-prime-slider'),
                'type' => Controls_Manager::SELECT,
                'default' => 'h1',
                'options' => prime_slider_title_tags(),
                'condition' => [
                    'show_title' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'show_text',
            [
                'label' => esc_html__('Show Text', 'bdthemes-prime-slider'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'readmore_type',
            [
                'label' => esc_html__('Readmore Type', 'bdthemes-prime-slider'),
                'type' => Controls_Manager::SELECT,
                'default' => 'static',
                'options' => [
                    'none' => esc_html__('None', 'bdthemes-prime-slider'),
                    'static' => esc_html__('Static', 'bdthemes-prime-slider'),
                    // 'dynamic' => esc_html__( 'Dynamic', 'bdthemes-prime-slider' ),
                ],
            ]
        );

        $this->add_control(
            'show_social_icon',
            [
                'label' => esc_html__('Show Social Link', 'bdthemes-prime-slider'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'show_scroll_button',
            [
                'label' => esc_html__('Show Scroll Button', 'bdthemes-prime-slider'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'show_navigation_arrows',
            [
                'label' => esc_html__('Show Arrows', 'bdthemes-prime-slider'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail_size',
                'label' => esc_html__('Image Size', 'bdthemes-prime-slider'),
                'exclude' => ['custom'],
                'default' => 'full',
                'prefix_class' => 'bdt-ps-thumbnail-size-',
                'separator' => 'before',
            ]
        );

        //Global background settings Controls
        $this->register_background_settings('.bdt-astoria-slider .bdt-slide-img');

        $this->end_controls_section();

        $this->start_controls_section(
            'section_content_sliders',
            [
                'label' => esc_html__('Sliders', 'bdthemes-prime-slider'),
            ]
        );

        $repeater = new Repeater();

        $repeater->start_controls_tabs('tabs_slider_item_content');
		$repeater->start_controls_tab(
			'tab_slider_content',
			[
				'label'     => __('Content', 'bdthemes-prime-slider'),
			]
		);

        $repeater->add_control(
            'title',
            [
                'label' => esc_html__('Title', 'bdthemes-prime-slider'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'dynamic' => ['active' => true],
            ]
        );

        $repeater->add_control(
            'slide_button_text',
            [
                'label' => esc_html__('Button Text', 'bdthemes-prime-slider'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Explore our works', 'bdthemes-prime-slider'),
                'label_block' => true,
                'dynamic' => ['active' => true],
            ]
        );

        $repeater->add_control(
            'button_link',
            [
                'label' => esc_html__('Button Link', 'bdthemes-prime-slider'),
                'type' => Controls_Manager::URL,
                'default' => ['url' => ''],
                'dynamic' => ['active' => true],
                'condition' => [
                    'title!' => '',
                ],
            ]
        );

        $repeater->add_control(
            'image',
            [
                'label' => esc_html__('Image', 'bdthemes-prime-slider'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'dynamic' => ['active' => true],
            ]
        );

        $repeater->end_controls_tab();
		$repeater->start_controls_tab(
			'tab_slider_optional',
			[
				'label'     => __('Optional', 'bdthemes-prime-slider'),
			]
		);

        $repeater->add_control(
            'sub_title',
            [
                'label' => esc_html__('Sub Title', 'bdthemes-prime-slider'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'dynamic' => ['active' => true],
            ]
        );

        $repeater->add_control(
            'title_link',
            [
                'label' => esc_html__('Title Link', 'bdthemes-prime-slider'),
                'type' => Controls_Manager::URL,
                'default' => ['url' => ''],
                'show_external' => false,
                'dynamic' => ['active' => true],
                'condition' => [
                    'title!' => '',
                ],
            ]
        );

        $repeater->add_control(
            'text',
            [
                'label' => esc_html__('Text', 'bdthemes-prime-slider'),
                'type' => Controls_Manager::WYSIWYG,
                'label_block' => true,
                'dynamic' => ['active' => true],
            ]
        );

        $repeater->end_controls_tab();
		$repeater->end_controls_tabs();

        $this->add_control(
            'slides',
            [
                'label' => esc_html__('Slider Items', 'bdthemes-prime-slider'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'sub_title' => esc_html__('Explore', 'bdthemes-prime-slider'),
                        'title' => esc_html__('Massive', 'bdthemes-prime-slider'),
                        'text' => esc_html__('Prime Slider Addons for Elementor is a page builder extension that allows you to build sliders with drag and drop. It lets you create an amazing slider without touching no code at all!', 'bdthemes-prime-slider'),
                        'image' => ['url' => BDTPS_ASSETS_URL . 'images/gallery/item-1.svg'],
                    ],
                    [
                        'sub_title' => esc_html__('Explore', 'bdthemes-prime-slider'),
                        'title' => esc_html__('Vibrant', 'bdthemes-prime-slider'),
                        'text' => esc_html__('Astoria slider is a premium plugin for Elementor that helps you to create awesome sliders for your website. It comes with the perfect design and drag & drop builder tools.', 'bdthemes-prime-slider'),
                        'image' => ['url' => BDTPS_ASSETS_URL . 'images/gallery/item-4.svg'],
                    ],
                    [
                        'sub_title' => esc_html__('Explore', 'bdthemes-prime-slider'),
                        'title' => esc_html__('Wallow', 'bdthemes-prime-slider'),
                        'text' => esc_html__('The Astoria Slider is a creative slider that helps you to design a modern website. With the help of this slider, you can create a unique and memorable experience for your users.', 'bdthemes-prime-slider'),
                        'image' => ['url' => BDTPS_ASSETS_URL . 'images/gallery/item-5.svg'],
                    ],
                ],
                'title_field' => '{{{ title }}}',
            ]
        );

        

        $this->end_controls_section();

        $this->start_controls_section(
            'section_content_social_link',
            [
                'label' => __('Social Link', 'bdthemes-prime-slider'),
                'condition' => [
                    'show_social_icon' => 'yes',
                ],
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'social_link_title',
            [
                'label' => __('Title', 'bdthemes-prime-slider'),
                'type' => Controls_Manager::TEXT,
            ]
        );

        $repeater->add_control(
            'social_link',
            [
                'label' => __('Link', 'bdthemes-prime-slider'),
                'type' => Controls_Manager::TEXT,
            ]
        );

        $repeater->add_control(
            'social_icon',
            [
                'label' => __('Choose Icon', 'bdthemes-prime-slider'),
                'type' => Controls_Manager::ICONS,
            ]
        );

        $this->add_control(
            'social_link_list',
            [
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'social_link' => __('http://www.facebook.com/bdthemes/', 'bdthemes-prime-slider'),
                        'social_icon' => [
                            'value' => 'fab fa-facebook-f',
                            'library' => 'fa-brands',
                        ],
                        'social_link_title' => 'Facebook',
                    ],
                    [
                        'social_link' => __('http://www.twitter.com/bdthemes/', 'bdthemes-prime-slider'),
                        'social_icon' => [
                            'value' => 'fab fa-twitter',
                            'library' => 'fa-brands',
                        ],
                        'social_link_title' => 'Twitter',
                    ],
                    [
                        'social_link' => __('http://www.instagram.com/bdthemes/', 'bdthemes-prime-slider'),
                        'social_icon' => [
                            'value' => 'fab fa-instagram',
                            'library' => 'fa-brands',
                        ],
                        'social_link_title' => 'Instagram',
                    ],
                ],
                'title_field' => '{{{ social_link_title }}}',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_content_scroll_button',
            [
                'label' => esc_html__('Scroll Down', 'bdthemes-prime-slider'),
                'condition' => [
                    'show_scroll_button' => ['yes'],
                ],
            ]
        );

        $this->add_control(
            'duration',
            [
                'label' => esc_html__('Duration', 'bdthemes-prime-slider'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 100,
                        'max' => 5000,
                        'step' => 50,
                    ],
                ],
            ]
        );

        $this->add_control(
            'offset',
            [
                'label' => esc_html__('Offset', 'bdthemes-prime-slider'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => -200,
                        'max' => 200,
                        'step' => 10,
                    ],
                ],
            ]
        );

        $this->add_control(
            'scroll_button_text',
            [
                'label' => esc_html__('Button Text', 'bdthemes-prime-slider'),
                'type' => Controls_Manager::TEXT,
                'dynamic' => ['active' => true],
                'default' => esc_html__('Scroll Down', 'bdthemes-prime-slider'),
                'placeholder' => esc_html__('Scroll Down', 'bdthemes-prime-slider'),
            ]
        );

        $this->add_control(
            'section_id',
            [
                'label' => esc_html__('Section ID', 'bdthemes-prime-slider'),
                'type' => Controls_Manager::TEXT,
                'default' => 'my-header',
                'description' => esc_html__("By clicking this scroll button, to which section in your page you want to go? Just write that's section ID here such 'my-header'. N.B: No need to add '#'.", 'bdthemes-prime-slider'),
            ]
        );

        $this->end_controls_section();

        /**
         * Reveal Effects
         */
        if ('on' === $reveal_effects) {
            $this->register_reveal_effects();
        }

        //style
        $this->start_controls_section(
            'section_style_layout',
            [
                'label' => __('Sliders', 'bdthemes-prime-slider'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'overlay_type',
            [
                'label' => esc_html__('Overlay', 'bdthemes-prime-slider'),
                'type' => Controls_Manager::SELECT,
                'default' => 'background',
                'options' => [
                    'none' => esc_html__('None', 'bdthemes-prime-slider'),
                    'background' => esc_html__('Background', 'bdthemes-prime-slider'),
                    'blend' => esc_html__('Blend', 'bdthemes-prime-slider'),
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'overlay_color',
                'label' => esc_html__('Background', 'bdthemes-prime-slider'),
                'types' => ['classic', 'gradient'],
                'exclude' => ['image'],
                'selector' => '{{WRAPPER}} .bdt-astoria-slider .bdt-slide-img:before',
                'fields_options' => [
                    'background' => [
                        'default' => 'classic',
                    ],
                    'color' => [
                        'default' => 'rgba(3, 4, 16, 0.3)',
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
                'label' => esc_html__('Blend Type', 'bdthemes-prime-slider'),
                'type' => Controls_Manager::SELECT,
                'default' => 'multiply',
                'options' => prime_slider_blend_options(),
                'condition' => [
                    'overlay_type' => 'blend',
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdt-astoria-slider .bdt-slide-img:before' => 'mix-blend-mode: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'content_padding',
            [
                'label' => __('Padding', 'bdthemes-prime-slider'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .bdt-astoria-slider .bdt-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'content_margin',
            [
                'label' => __('Margin', 'bdthemes-prime-slider'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .bdt-astoria-slider .bdt-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_title',
            [
                'label' => __('Title', 'bdthemes-prime-slider'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_title' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__('Color', 'bdthemes-prime-slider'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-astoria-slider .bdt-title, {{WRAPPER}} .bdt-astoria-slider .bdt-title a, {{WRAPPER}} .bdt-astoria-slider .bdt-title span' => 'color: {{VALUE}}; -webkit-text-stroke-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'title_hover_color',
            [
                'label' => esc_html__('Hover Color', 'bdthemes-prime-slider'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-astoria-slider .bdt-title:hover, {{WRAPPER}} .bdt-astoria-slider .bdt-title a:hover, {{WRAPPER}} .bdt-astoria-slider .bdt-title a:hover span' => 'color: {{VALUE}}; -webkit-text-stroke-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'title_background',
                'label' => esc_html__('Background', 'bdthemes-prime-slider'),
                'types' => ['classic', 'gradient'],
                'exclude' => ['image'],
                'selector' => '{{WRAPPER}} .bdt-astoria-slider .bdt-title',
            ]
        );

        $this->add_responsive_control(
            'title_padding',
            [
                'label' => __('Padding', 'bdthemes-prime-slider'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .bdt-astoria-slider .bdt-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'title_margin',
            [
                'label' => __('Margin', 'bdthemes-prime-slider'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .bdt-astoria-slider .bdt-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .bdt-astoria-slider .bdt-title',
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name' => 'title_text_shadow',
                'label' => __('Text Shadow', 'bdthemes-prime-slider'),
                'selector' => '{{WRAPPER}} .bdt-astoria-slider .bdt-title',
            ]
        );

        $this->add_control(
            'first_word_style',
            [
                'label' => esc_html__('First Word Style', 'bdthemes-prime-slider'),
                'type' => Controls_Manager::SWITCHER,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'first_word_text_color',
            [
                'label' => esc_html__('Color', 'bdthemes-prime-slider'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-astoria-slider .bdt-title .frist-word' => 'color: {{VALUE}}; -webkit-text-stroke-color: {{VALUE}};',
                ],
                'condition' => [
                    'first_word_style' => ['yes'],
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'first_word_typography',
                'selector' => '{{WRAPPER}} .bdt-astoria-slider .bdt-title .frist-word',
                'condition' => [
                    'first_word_style' => ['yes'],
                ],
            ]
        );

        $this->add_responsive_control(
            'title_max_width',
            [
                'label' => esc_html__('Max Width', 'bdthemes-prime-slider'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 220,
                        'max' => 1400,
                    ],
                    '%' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdt-astoria-slider .bdt-title' => 'max-width: {{SIZE}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'show_text_stroke',
            [
                'label' => esc_html__('Text Stroke', 'bdthemes-prime-slider'),
                'type' => Controls_Manager::SWITCHER,
                'prefix_class' => 'bdt-text-stroke--',
                'render_type' => 'template',
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'stroke_width',
            [
                'label' => esc_html__('Stroke Width', 'bdthemes-prime-slider'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 10,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdt-astoria-slider .bdt-title, {{WRAPPER}} .bdt-astoria-slider .bdt-title a, {{WRAPPER}} .bdt-astoria-slider .bdt-title .frist-word' => '-webkit-text-stroke-width: {{SIZE}}px;',
                ],
                'condition' => [
                    'show_text_stroke' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_sub_title',
            [
                'label' => __('Sub Title', 'bdthemes-prime-slider'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_sub_title' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'sub_title_color',
            [
                'label' => esc_html__('Color', 'bdthemes-prime-slider'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-astoria-slider .bdt-sub-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'sub_title_margin',
            [
                'label' => __('Margin', 'bdthemes-prime-slider'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .bdt-astoria-slider .bdt-sub-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'sub_title_typography',
                'selector' => '{{WRAPPER}} .bdt-astoria-slider .bdt-sub-title',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_text',
            [
                'label' => __('Text', 'bdthemes-prime-slider'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_text' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'text_color',
            [
                'label' => esc_html__('Color', 'bdthemes-prime-slider'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-astoria-slider .bdt-text' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'text_max_width',
            [
                'label' => esc_html__('Max Width', 'bdthemes-prime-slider'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 100,
                        'max' => 1200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdt-astoria-slider .bdt-text' => 'max-width: {{SIZE}}px;',
                ],
            ]
        );

        $this->add_responsive_control(
            'text_margin',
            [
                'label' => __('Margin', 'bdthemes-prime-slider'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .bdt-astoria-slider .bdt-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'text_typography',
                'selector' => '{{WRAPPER}} .bdt-astoria-slider .bdt-text',
            ]
        );

        $this->end_controls_section();

        // $this->start_controls_section(
        //     'section_style_button_dynamin',
        //     [
        //         'label' => esc_html__( 'Read More', 'bdthemes-prime-slider' ),
        //         'tab'   => Controls_Manager::TAB_STYLE,
        //         'condition' => [
        //             'readmore_type' => 'dynamic'
        //         ],
        //     ]
        // );

        // $this->add_control(
        //     'button_fill_color',
        //     [
        //         'label'     => esc_html__( 'Color', 'bdthemes-prime-slider' ),
        //         'type'      => Controls_Manager::COLOR,
        //         'selectors' => [
        //             '{{WRAPPER}} .bdt-astoria-slider .bdt-readmore .textcircle text' => 'fill: {{VALUE}};',
        //         ],
        //     ]
        // );

        // $this->add_group_control(
        //     Group_Control_Typography::get_type(),
        //     [
        //         'name'      => 'button_dynamic_typography',
        //         'label'     => esc_html__( 'Typography', 'bdthemes-prime-slider' ),
        //         'selector'  => '{{WRAPPER}} .bdt-astoria-slider .bdt-readmore .textcircle text',
        //     ]
        // );

        // $this->end_controls_section();

        $this->start_controls_section(
            'section_style_button',
            [
                'label' => esc_html__('Read More', 'bdthemes-prime-slider'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'readmore_type' => 'static',
                ],
            ]
        );

        $this->start_controls_tabs('tabs_button_style');

        $this->start_controls_tab(
            'tab_button_normal',
            [
                'label' => esc_html__('Normal', 'bdthemes-prime-slider'),
            ]
        );

        $this->add_control(
            'button_text_color',
            [
                'label' => esc_html__('Color', 'bdthemes-prime-slider'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-astoria-slider .bdt-static-readmore' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'button_background',
                'selector' => '{{WRAPPER}} .bdt-astoria-slider .bdt-static-readmore:before',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'button_border',
                'label' => esc_html__('Border', 'bdthemes-prime-slider'),
                'placeholder' => '1px',
                'default' => '1px',
                'selector' => '{{WRAPPER}} .bdt-astoria-slider .bdt-static-readmore',
            ]
        );

        $this->add_responsive_control(
            'button_border_radius',
            [
                'label' => esc_html__('Border Radius', 'bdthemes-prime-slider'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .bdt-astoria-slider .bdt-static-readmore' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'button_text_padding',
            [
                'label' => esc_html__('Padding', 'bdthemes-prime-slider'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .bdt-astoria-slider .bdt-static-readmore' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'button_box_shadow',
                'selector' => '{{WRAPPER}} .bdt-astoria-slider .bdt-static-readmore',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'button_typography',
                'label' => esc_html__('Typography', 'bdthemes-prime-slider'),
                'selector' => '{{WRAPPER}} .bdt-astoria-slider .bdt-static-readmore',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_button_hover',
            [
                'label' => esc_html__('Hover', 'bdthemes-prime-slider'),
            ]
        );

        $this->add_control(
            'button_hover_color',
            [
                'label' => esc_html__('Color', 'bdthemes-prime-slider'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-astoria-slider .bdt-static-readmore:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'button_hover_background',
                'selector' => '{{WRAPPER}} .bdt-astoria-slider .bdt-static-readmore:hover',
            ]
        );

        $this->add_control(
            'button_hover_border_color',
            [
                'label' => esc_html__('Border Color', 'bdthemes-prime-slider'),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'button_border_border!' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdt-astoria-slider .bdt-static-readmore:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'button_hover_box_shadow',
                'selector' => '{{WRAPPER}} .bdt-astoria-slider .bdt-static-readmore:hover',
            ]
        );

        $this->add_control(
            'button_hover_animation',
            [
                'label' => esc_html__('Animation', 'bdthemes-prime-slider'),
                'type' => Controls_Manager::HOVER_ANIMATION,
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_social_icon',
            [
                'label' => esc_html__('Social Link', 'bdthemes-prime-slider'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_social_icon' => 'yes',
                ],
            ]
        );

        $this->start_controls_tabs('tabs_social_icon_style');

        $this->start_controls_tab(
            'tab_social_icon_normal',
            [
                'label' => esc_html__('Normal', 'bdthemes-prime-slider'),
            ]
        );

        $this->add_control(
            'social_icon_color',
            [
                'label' => esc_html__('Color', 'bdthemes-prime-slider'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-prime-slider .bdt-social-icon i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .bdt-prime-slider .bdt-social-icon svg *' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'social_icon_background',
                'selector' => '{{WRAPPER}} .bdt-prime-slider .bdt-social-icon a:before',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'social_icon_border',
                'label' => esc_html__('Border', 'bdthemes-prime-slider'),
                'placeholder' => '1px',
                'default' => '1px',
                'selector' => '{{WRAPPER}} .bdt-prime-slider .bdt-social-icon a',
            ]
        );

        $this->add_responsive_control(
            'social_icon_radius',
            [
                'label' => esc_html__('Border Radius', 'bdthemes-prime-slider'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .bdt-prime-slider .bdt-social-icon a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'social_icon_padding',
            [
                'label' => esc_html__('Padding', 'bdthemes-prime-slider'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .bdt-prime-slider .bdt-social-icon a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'social_icon_shadow',
                'selector' => '{{WRAPPER}} .bdt-prime-slider .bdt-social-icon a',
            ]
        );

        $this->add_responsive_control(
            'social_icon_size',
            [
                'label' => __('Icon Size', 'bdthemes-prime-slider'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdt-prime-slider .bdt-social-icon a' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'social_icon_spacing',
            [
                'label' => esc_html__('Space Between', 'bdthemes-prime-slider'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdt-prime-slider .bdt-social-icon' => 'grid-gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'social_icon_horizontal_offset',
            [
                'label' => esc_html__('Horizontal Offset', 'bdthemes-prime-slider'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .bdt-prime-slider .bdt-social-icon' => 'left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'social_icon_tooltip',
            [
                'label' => esc_html__('Show Tooltip', 'bdthemes-prime-slider'),
                'type' => Controls_Manager::SWITCHER,
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_social_icon_hover',
            [
                'label' => esc_html__('Hover', 'bdthemes-prime-slider'),
            ]
        );

        $this->add_control(
            'social_icon_hover_color',
            [
                'label' => esc_html__('Color', 'bdthemes-prime-slider'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-prime-slider .bdt-social-icon a:hover i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .bdt-prime-slider .bdt-social-icon a:hover svg *' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'social_icon_hover_background',
                'selector' => '{{WRAPPER}} .bdt-prime-slider .bdt-social-icon a:hover',
            ]
        );

        $this->add_control(
            'icon_hover_border_color',
            [
                'label' => esc_html__('Border Color', 'bdthemes-prime-slider'),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'social_icon_border_border!' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdt-prime-slider .bdt-social-icon a:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_scroll_down',
            [
                'label' => esc_html__('Scroll Down', 'bdthemes-prime-slider'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_scroll_button' => 'yes',
                ],
            ]
        );

        $this->start_controls_tabs('tabs_scroll_down_style');

        $this->start_controls_tab(
            'tab_scroll_down_normal',
            [
                'label' => esc_html__('Normal', 'bdthemes-prime-slider'),
            ]
        );

        $this->add_control(
            'scroll_down_text_color',
            [
                'label' => __('Text Color', 'bdthemes-prime-slider'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .bdt-astoria-slider .bdt-ps-scroll-down .bdt-ps-button-text' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'scroll_down_icon_color',
            [
                'label' => __('Icon Color', 'bdthemes-prime-slider'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-astoria-slider .bdt-ps-scroll-down .bdt-ps-button-arrow, {{WRAPPER}} .bdt-astoria-slider .bdt-ps-scroll-down .bdt-ps-button-small-circle' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .bdt-astoria-slider .bdt-ps-scroll-down .bdt-ps-button-arrow:after' => 'border-left-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'scroll_down_circle_color',
            [
                'label' => __('Border Color', 'bdthemes-prime-slider'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-astoria-slider .bdt-ps-scroll-down .bdt-ps-button-border-circle' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'scroll_down_typography',
                'selector' => '{{WRAPPER}} .bdt-astoria-slider .bdt-ps-scroll-down .bdt-ps-button-text',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_scroll_down_hover',
            [
                'label' => esc_html__('Hover', 'bdthemes-prime-slider'),
            ]
        );

        $this->add_control(
            'scroll_down_hover_text_color',
            [
                'label' => __('Text Color', 'bdthemes-prime-slider'),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .bdt-astoria-slider .bdt-ps-scroll-down:hover .bdt-ps-button-text' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'scroll_down_hover_circle_color',
            [
                'label' => __('Border Color', 'bdthemes-prime-slider'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-astoria-slider .bdt-ps-scroll-down:hover .bdt-ps-button-border-circle' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        //Navigation Css
        $this->start_controls_section(
            'section_style_navigation',
            [
                'label' => __('Navigation', 'bdthemes-prime-slider'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_navigation_arrows' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'nav_arrows_icon',
            [
                'label' => esc_html__('Arrows Icon', 'bdthemes-prime-slider'),
                'type' => Controls_Manager::SELECT,
                'default' => '2',
                'options' => [
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
            ]
        );

        $this->add_responsive_control(
            'arrow_icon_size',
            [
                'label' => __('Icon Size', 'bdthemes-prime-slider'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdt-astoria-slider .bdt-slidenav-item' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'navigation_space_between',
            [
                'label' => esc_html__('Space Between', 'bdthemes-prime-slider'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .bdt-astoria-slider .bdt-slidenav-wrap' => 'grid-gap: {{SIZE}}px;',
                ],
            ]
        );

        $this->add_responsive_control(
            'navigation_horizontal_offset',
            [
                'label' => esc_html__('Horizontal Offset', 'bdthemes-prime-slider'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .bdt-astoria-slider .bdt-slidenav-wrap' => 'right: {{SIZE}}px;',
                ],
            ]
        );

        $this->add_responsive_control(
            'navigation_vertical_offset',
            [
                'label' => esc_html__('Vertical Offset', 'bdthemes-prime-slider'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .bdt-astoria-slider .bdt-slidenav-wrap' => 'bottom: {{SIZE}}px;',
                ],
            ]
        );

        $this->start_controls_tabs('tabs_navigation_style');

        $this->start_controls_tab(
            'tab_navigation_normal',
            [
                'label' => esc_html__('Normal', 'bdthemes-prime-slider'),
            ]
        );

        $this->add_control(
            'navigation_text_color',
            [
                'label' => esc_html__('Color', 'bdthemes-prime-slider'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-astoria-slider .bdt-slidenav-item' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'navigation_background',
                'selector' => '{{WRAPPER}} .bdt-astoria-slider .bdt-slidenav-item:before',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'navigation_border',
                'label' => esc_html__('Border', 'bdthemes-prime-slider'),
                'placeholder' => '1px',
                'default' => '1px',
                'selector' => '{{WRAPPER}} .bdt-astoria-slider .bdt-slidenav-item',
            ]
        );

        $this->add_responsive_control(
            'navigation_border_radius',
            [
                'label' => esc_html__('Border Radius', 'bdthemes-prime-slider'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .bdt-astoria-slider .bdt-slidenav-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'navigation_text_padding',
            [
                'label' => esc_html__('Padding', 'bdthemes-prime-slider'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .bdt-astoria-slider .bdt-slidenav-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'navigation_box_shadow',
                'selector' => '{{WRAPPER}} .bdt-astoria-slider .bdt-slidenav-item',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_navigation_hover',
            [
                'label' => esc_html__('Hover', 'bdthemes-prime-slider'),
            ]
        );

        $this->add_control(
            'navigation_hover_color',
            [
                'label' => esc_html__('Color', 'bdthemes-prime-slider'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdt-astoria-slider .bdt-slidenav-item:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'navigation_hover_background',
                'selector' => '{{WRAPPER}} .bdt-astoria-slider .bdt-slidenav-item:hover',
            ]
        );

        $this->add_control(
            'navigation_hover_border_color',
            [
                'label' => esc_html__('Border Color', 'bdthemes-prime-slider'),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'navigation_border_border!' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdt-astoria-slider .bdt-slidenav-item:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'navigation_hover_box_shadow',
                'selector' => '{{WRAPPER}} .bdt-astoria-slider .bdt-slidenav-item:hover',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();
    }

    protected function render_header() {
        $settings = $this->get_settings_for_display();
        $id = 'bdt-prime-slider-' . $this->get_id();

        // start target
        $targets = [];
        if ($settings['show_title'] == 'yes') {
            $targets[0] = '.bdt-title';
        }
        if ($settings['show_sub_title'] == 'yes') {
            $targets[1] = '.bdt-sub-title';
        }
        if ($settings['show_text'] == 'yes') {
            $targets[2] = '.bdt-text';
        }
        if ($settings['readmore_type'] == 'static') {
            $targets[3] = '.bdt-static-readmore';
        }
        $targets = implode(', ', $targets);
        // end target

        //Reveal Effect
        $reveal_effects = prime_slider_option('reveal-effects', 'prime_slider_other_settings', 'off');
        if (('on' === $reveal_effects) && ('yes' === $settings['reveal_effects_enable'])) {
            $this->add_render_attribute('prime-slider', 'class', 'reveal-active-' . $this->get_id());
            $this->add_render_attribute('ps-astoria', 'data-reveal-enable', $settings['reveal_effects_enable']);
            $this->add_render_attribute(
                [
                    'ps-astoria' => [
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
                'ps-astoria' => [
                    'id' => $id,
                    'class' => ['bdt-astoria-slider', 'slideshow'],
                    'data-settings' => [
                        wp_json_encode(
                            array_filter([
                                "id" => '#' . $id,
                                'targets' => $targets,

                            ])
                        ),
                    ],
                ],
            ]
        );

        $this->add_render_attribute('prime-slider', 'class', 'bdt-prime-slider bdt-prime-slider-astoria');

        ?>
        <div <?php $this->print_render_attribute_string('prime-slider'); ?>>
            <div <?php $this->print_render_attribute_string('ps-astoria'); ?>>
                <div class="slides">
                <?php
            }

            public function render_footer() {
                $settings = $this->get_settings_for_display();

                ?>
                </div>
                <?php if ($settings['show_navigation_arrows']) : ?>
                    <nav class="bdt-slidenav-wrap reveal-muted">
                        <button class="bdt-slidenav-item bdt-slidenav-item-prev">
                            <span><span><i class="ps-wi-arrow-left-<?php echo esc_html($settings['nav_arrows_icon']); ?>" aria-hidden="true"></i></span></span>
                        </button>
                        <button class="bdt-slidenav-item bdt-slidenav-item-next">
                            <span><span><i class="ps-wi-arrow-right-<?php echo esc_html($settings['nav_arrows_icon']); ?>" aria-hidden="true"></i></span></span>
                        </button>
                    </nav>
                <?php endif; ?>
                <?php $this->render_social_link(); ?>
                <?php $this->render_scroll_button(); ?>
            </div>
        </div>

    <?php
            }

            public function render_social_link($position = 'right', $class = []) {
                $settings = $this->get_active_settings();

                if ('' == $settings['show_social_icon']) {
                    return;
                }

                $this->add_render_attribute('social-icon', 'class', 'bdt-social-icon reveal-muted');
                $this->add_render_attribute('social-icon', 'class', $class);

    ?>
        <div <?php $this->print_render_attribute_string('social-icon'); ?>>
            <?php
                foreach ($settings['social_link_list'] as $link) :
                    $tooltip = ('yes' == $settings['social_icon_tooltip']) ? ' title="' . esc_attr($link['social_link_title']) . '" bdt-tooltip="pos: ' . $position . '"' : ''; ?>

                <a href="<?php echo esc_url($link['social_link']); ?>" target="_blank" <?php echo wp_kses_post($tooltip); ?>>
                    <span><span><?php Icons_Manager::render_icon($link['social_icon'], ['aria-hidden' => 'true', 'class' => 'fa-fw']); ?></span></span>
                </a>
            <?php endforeach; ?>
        </div>
    <?php
            }

            public function render_scroll_button() {
                $settings = $this->get_settings_for_display();

                $this->add_render_attribute('bdt-scroll-down', 'class', ['bdt-ps-button bdt-scroll-down reveal-muted']);

                if ('' == $settings['show_scroll_button']) {
                    return;
                }

                $this->add_render_attribute(
                    [
                        'bdt-scroll-down' => [
                            'data-settings' => [
                                wp_json_encode(array_filter([
                                    'duration' => ('' != $settings['duration']['size']) ? $settings['duration']['size'] : '',
                                    'offset' => ('' != $settings['offset']['size']) ? $settings['offset']['size'] : '',
                                ])),
                            ],
                        ],
                    ]
                );

                $this->add_render_attribute('bdt-scroll-down', 'data-selector', '#' . esc_attr($settings['section_id']));

                $this->add_render_attribute('bdt-scroll-wrapper', 'class', 'bdt-scroll-down-wrapper');

    ?>
        <div class="bdt-ps-scroll-down">
            <div <?php $this->print_render_attribute_string('bdt-scroll-down'); ?>>
                <div class="bdt-ps-button-text">
                    <div class="bdt-scroll-text">
                        <?php echo wp_kses($settings['scroll_button_text'], prime_slider_allow_tags('title')); ?>
                    </div>
                </div>
                <div class="bdt-ps-button-wrapper">
                    <div class="bdt-ps-button-arrow"></div>
                    <div class="bdt-ps-button-border-circle"></div>
                    <div class="bdt-ps-button-mask-circle">
                        <div class="bdt-ps-button-small-circle"></div>
                    </div>
                </div>

            </div>
        </div>

    <?php
            }

            public function render_title($slide) {
                $settings = $this->get_settings_for_display();

                if ('' == $settings['show_title']) {
                    return;
                }

    ?>
        <<?php echo Utils::get_valid_html_tag($settings['title_html_tag']); ?> class="bdt-title" data-reveal="reveal-active">
            <?php if ('' !== $slide['title_link']['url']) : ?>
                <a href="<?php echo esc_url($slide['title_link']['url']); ?>">
                <?php endif; ?>
                <?php echo prime_slider_first_word($slide['title']); ?>
                <?php if ('' !== $slide['title_link']['url']) : ?>
                </a>
            <?php endif; ?>
        </<?php echo Utils::get_valid_html_tag($settings['title_html_tag']); ?>>

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

            public function render_button_to_do($content) {
                $settings = $this->get_settings_for_display();

                $this->add_render_attribute('slider-button', 'class', 'bdt-readmore', true);

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
        <?php if ($content['slide_button_text'] && ('dynamic' == $settings['readmore_type'])) : ?>
            <div class="bdt-btn-wrap">
                <a <?php $this->print_render_attribute_string('slider-button'); ?>>
                    <svg class="textcircle" viewBox="0 0 500 500">
                        <title><?php echo wp_kses($content['slide_button_text'], prime_slider_allow_tags('title')); ?></title>
                        <defs>
                            <path id="textcircle" d="M250,400 a150,150 0 0,1 0,-300a150,150 0 0,1 0,300Z" />
                        </defs>
                        <text>
                            <textPath xlink:href="#textcircle" aria-label="Projects & client work 2020" textLength="900"><?php echo wp_kses($content['slide_button_text'], prime_slider_allow_tags('title')); ?></textPath>
                        </text>
                    </svg>
                </a>
            </div>
        <?php endif;
            }

            public function render_static_button($content) {
                $settings = $this->get_settings_for_display();

                $this->add_render_attribute('slider-button', 'class', 'bdt-static-readmore elementor-animation-' . $settings['button_hover_animation'], true);
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
        <?php if ($content['slide_button_text'] && ('static' == $settings['readmore_type'])) : ?>
            <div class="bdt-btn-wrap">
                <a <?php $this->print_render_attribute_string('slider-button'); ?>>
                    <span><span><?php echo wp_kses($content['slide_button_text'], prime_slider_allow_tags('title')); ?></span></span>
                </a>
            </div>
        <?php endif;
            }

            public function rendar_item_image($item, $alt = '') {
                $settings = $this->get_settings_for_display();

                $image_src = Group_Control_Image_Size::get_attachment_image_src($item['image']['id'], 'thumbnail_size', $settings);

                if ($image_src) {
                    $image_final_src = $image_src;
                } elseif ($item['image']['url']) {
                    $image_final_src = $item['image']['url'];
                } else {
                    return;
                }
        ?>

        <div class="bdt-slide-img" style="background-image: url('<?php echo esc_url($image_final_src); ?>')"></div>

        <?php
            }

            public function render_slides_loop() {
                $settings = $this->get_settings_for_display();

                $i = 0;

                foreach ($settings['slides'] as $slide) : ?>

            <div class="slide<?php echo ($i == 0) ? ' slide--current' : ''; ?>">

                <?php $this->rendar_item_image($slide, $slide['title']); ?>

                <div class="bdt-content">
                    <?php $this->render_sub_title($slide); ?>
                    <div class="bdt-main-title">
                        <?php $this->render_title($slide); ?>
                    </div>

                    <?php if ($slide['text'] && ('yes' == $settings['show_text'])) : ?>
                        <div class="bdt-text" data-reveal="reveal-active">
                            <?php echo wp_kses_post($slide['text']); ?>
                        </div>
                    <?php endif; ?>

                    <?php //if($settings['readmore_type'] == 'dynamic') : 
                    ?>
                    <?php //$this->render_button($slide); 
                    ?>
                    <?php if ($settings['readmore_type'] == 'static') : ?>
                        <?php $this->render_static_button($slide); ?>
                    <?php endif; ?>

                </div>

            </div>

<?php

                    $i++;

                endforeach;
            }

            public function render() {
                $this->render_header();
                $this->render_slides_loop();
                $this->render_footer();
            }
        }
