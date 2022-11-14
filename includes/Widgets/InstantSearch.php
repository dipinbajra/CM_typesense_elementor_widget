<?php

namespace Codemanas\TypesenseElementor\Widgets;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class InstantSearch extends \Elementor\Widget_base {


	public function __construct( $data = [], $args = null ) {
		parent::__construct( $data, $args );
	}

	public function get_name() {
		return 'cm-instant-search';
	}
	
	public function get_script_depends() {
		return ['cm-typesense-instant-search'];
	}

	public function get_title() {
		return esc_html( ' Instant Search', 'cm-typesense' );
	}


	public function get_icon() {
		return 'eicon-post';
	}

	public function get_custom_help_url() {
		return 'https://go.elementor.com/widget-name';
	}

	public function get_categories() {
		return [ 'basic' ];
	}

	public function get_keywords() {
		return [ 'cm', 'typesense' ];
	}


	protected function register_controls() {
		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Content', 'CM Typesense' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_responsive_control(
			'search_width',
			[
				'label'      => esc_html__( 'Search Box Width', 'CM Typesense' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 1000,
						'step' => 5,
					],
					'%'  => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => '',
				],
				'selectors'  => [
					'{{WRAPPER}} .cmswt-SearchBox' => 'width: {{SIZE}}{{UNIT}};',
				],
			],

		);
		$this->add_control(
			'placeHolder',
			[
				'type'        => \Elementor\Controls_Manager::TEXT,
				'label'       => esc_html__( 'Placeholder', 'CM Typesense' ),
				'placeholder' => esc_html__( 'Enter your placeholder', 'CM Typesense' ),
				'default'     => 'Search for...',
			]
		);
		$this->add_control(
			'columns',
			[
				'type'    => \Elementor\Controls_Manager::NUMBER,
				'label'   => esc_html__( 'Column', 'CM Typesense' ),
				'default' => 3,
			]
		);
		$this->add_control(
			'post_type',
			[
				'type'    => \Elementor\Controls_Manager::SELECT2,
				'label'   => esc_html__( 'Post Type', 'CM Typesense' ),
				'options' => [
					'page,post' => esc_html__( 'All', 'CM Typesense' ),
					'page'      => esc_html__( 'page', 'CM Typesense' ),
					'post'      => esc_html__( 'post', 'CM Typesense' ),
				],
				'default' => 'page,post',
			]
		);

		$this->add_control(
			'filter',
			[
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label'        => esc_html__( 'Filter', 'CM Typesense' ),
				'label_on'     => esc_html__( 'show', 'cm-typesense' ),
				'label_off'    => esc_html__( 'hide', 'cm-typesense' ),
				'return_value' => 'yes',
				'default'      => '',

			],
		);

		$this->add_control(
			'post_per_page',
			[
				'type'    => \Elementor\Controls_Manager::NUMBER,
				'label'   => esc_html__( 'Post per page', 'CM Typesense' ),
				'default' => 3,

			]
		);

		$this->add_control(
			'sort_by',
			[
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label'        => esc_html__( 'Sort By', 'CM Typesense' ),
				'label_on'     => esc_html__( 'show', 'cm-typesense' ),
				'label_off'    => esc_html__( 'hide', 'cm-typesense' ),
				'return_value' => 'yes',
				'default'      => '',

			],
		);

		$this->add_control(
			'pagination',
			[
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label'        => esc_html__( 'Pagination', 'CM Typesense' ),
				'label_on'     => esc_html__( 'show', 'cm-typesense' ),
				'label_off'    => esc_html__( 'hide', 'cm-typesense' ),
				'return_value' => 'yes',
				'default'      => '',

			],
		);

		$this->add_control(
			'sticky_first',
			[
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label'        => esc_html__( 'Sticky First', 'CM Typesense' ),
				'label_on'     => esc_html__( 'yes', 'cm-typesense' ),
				'label_off'    => esc_html__( 'no', 'cm-typesense' ),
				'return_value' => 'yes',
				'default'      => 'no',

			],
		);

		$this->add_control(
			'custom_class',
			[
				'type'  => \Elementor\Controls_Manager::TEXT,
				'label' => esc_html__( 'Custom Class', 'CM Typesense' ),
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'style_section',
			[
				'label' => esc_html__( 'Style', 'CM Typesense' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,

			]
		);
	}

	protected function render() {

		$settings = $this->get_settings_for_display();

		$placeHolder = $settings['placeHolder'];

		$columns = $settings['columns'];

		$post_type = $settings['post_type'];

		$filter = $settings['filter'];
		if ( $filter ) {
			$filter = 'show';
		} else {
			$filter = 'hide';
		}

		$post_per_page = $settings['post_per_page'];

		$sort_by = $settings['sort_by'];
		if ( $sort_by ) {
			$sort_by = 'show';
		} else {
			$sort_by = 'hide';
		}

		$pagination = $settings['pagination'];
		if ( $pagination ) {
			$pagination = 'show';
		} else {
			$pagination = 'hide';
		}

		$sticky_first = $settings['sticky_first'];

		$custom_class = $settings['custom_class'];

		echo do_shortcode( '[cm_typesense_search placeholder="' . $placeHolder . '" columns="' . $columns . '" post_types="' . $post_type . '" filter="' . $filter . '" custom_class="' . $custom_class . '" per_page="' . $post_per_page . '"  sortby="' . $sort_by . '" pagination="' . $pagination . '" query_by="post_title,post_content" sticky_first="' . $sticky_first . '"]' );

	}
}

