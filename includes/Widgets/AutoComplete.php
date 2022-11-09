<?php

namespace Codemanas\TypesenseElementor\Widgets;

use Codemanas\Typesense\Backend\Admin;

if( ! defined('ABSPATH')){
	exit;
}

class AutoComplete extends \Elementor\Widget_Base {

	public function __construct( $data = [], $args = null ) {
		parent::__construct( $data, $args );
		add_action( 'elementor/preview/enqueue_scripts', array( $this, 'my_plugin_preview_scripts' )  );
	}

	public function my_plugin_preview_scripts(){
		$admin_settings         = Admin::get_default_settings();
		$search_config_settings = Admin::get_search_config_settings();
		wp_register_script( 'cm-ts-elementor-autoComplete', CODEMANAS_TYPESENSE_ROOT_URI_PATH . 'assets/frontend/autocomplete.js', [ 'wp-util' ], CODEMANAS_TYPESENSE_VERSION, true );
		wp_localize_script( 'cm-ts-elementor-autoComplete', 'cm_typesense_autocomplete_default_settings', [
			'debug'                      => SCRIPT_DEBUG,
			'search_api_key'             => $admin_settings['search_api_key'],
			'port'                       => $admin_settings['port'],
			'node'                       => $admin_settings['node'],
			'protocol'                   => $admin_settings['protocol'],
			'enabled_post_types'         => $search_config_settings['enabled_post_types'],
			'available_post_types'       => $search_config_settings['available_post_types'],
			'search_config'              => $search_config_settings['config'],
			'hijack_wp_search__type'     => $search_config_settings['hijack_wp_search__type'],
			'autocomplete_input_delay'   => $search_config_settings['autocomplete_input_delay'],
			'autocomplete_submit_action' => $search_config_settings['autocomplete_submit_action'],
		] );
		wp_enqueue_script( 'cm-ts-elementor-autoComplete' );
	}

	public function get_name()
	{
		return 'Autocomplete';

	}

	public function get_title()
	{
		return esc_html(' AutoComplete', 'cm-typesense');
	}


	public function get_icon()
	{
		return 'eicon-post';
	}

	public function get_custom_help_url() {
		return 'https://go.elementor.com/widget-name';
	}

	public function get_categories() {
		return [ 'basic' ];
	}

	public function get_keywords() {
		return [ 'autocomplete', 'cm', 'typesense' ];
	}

	protected function register_controls() {
		parent::register_controls(); // TODO: Change the autogenerated stub
		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Content', 'CM Typesense' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_responsive_control(
			'search_width',
			[
				'label' => esc_html__( 'Search Box Width', 'CM Typesense' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .cm-autocomplete' => 'width: {{SIZE}}{{UNIT}};',
				],
			],

		);
		}


	protected function render() {
	echo do_shortcode('[cm_typesense_autocomplete placeholder="Search for...]');
	}


}