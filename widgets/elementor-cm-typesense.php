<?php

use Codemanas\Typesense\Backend\Admin;

if( ! defined('ABSPATH')){
    exit;
}

class Elementor_CM_Typesense extends \Elementor\Widget_base{


	public function __construct( $data = [], $args = null)
	{
		parent::__construct($data, $args);
		// add_action( 'elementor/editor/after_enqueue_scripts ', array( $this, 'my_plugin_preview_scripts' ) );
		add_action( 'elementor/preview/enqueue_scripts', array( $this, 'my_plugin_preview_scripts' )  );
	}

	public function my_plugin_preview_scripts()
	{
		$admin_settings         = Admin::get_default_settings();
        $search_config_settings = Admin::get_search_config_settings();
		wp_register_script( 'frontend-script-1', CODEMANAS_TYPESENSE_ROOT_URI_PATH . 'assets/frontend/instant-search.js', [ 'wp-util' ], CODEMANAS_TYPESENSE_VERSION, true );
		wp_localize_script( 'frontend-script-1', 'cm_typesense_instant_search_default_settings', [
			'debug'                => SCRIPT_DEBUG,
			'search_api_key'       => $admin_settings['search_api_key'],
			'port'                 => $admin_settings['port'],
			'node'                 => $admin_settings['node'],
			'protocol'             => $admin_settings['protocol'],
			'enabled_post_types'   => $search_config_settings['enabled_post_types'],
			'available_post_types' => $search_config_settings['available_post_types'],
			'search_config'        => $search_config_settings['config'],
			'date_format'          => apply_filters( 'cm_typesense_date_format', get_option( 'date_format' ) ),
			'localized_strings'    => [
				'load_more' => __( 'Load More', 'search-with-typesense' ),
				'show_less' => __( 'Show less', 'search-with-typesense' ),
				'show_more' => __( 'Show more', 'search-with-typesense' ),
			],
		] );
		// return[
		// 	'frontend-script-1'
		// ];
		wp_enqueue_script( 'frontend-script-1' );
	}

    public function get_name()
    {
        return 'CM Typesense';

    }

    public function get_title()
    {
        return esc_html(' CM Typesense', 'cm-typesense');
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
		return [ 'dyroth', 'cm', 'typesense' ];
	}



	protected function render() {
		

       echo do_shortcode('[cm_typesense_search placeholder="Search for" columns="3" post_types="page,post" filter="show"  per_page="3"  sortby="show" pagination="show" query_by="post_title,post_content" sticky_first="no"]');
		

	}

    


}

