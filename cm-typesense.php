<?php

use Codemanas\Typesense\Backend\Admin;

/**
 * Plugin Name:       CM Typesense
 * Plugin URI:        https://codemanas.github.io/
 * Description:       Simple plugin to add custom elementor widget.
 * Version:           1.0.0
 * Author:            Dipin Bajracharya
 * Text Domain:       cm-typesense
 */

defined( 'ABSPATH' ) || exit;
defined( 'CM_TYPESENSE_FILE_PATH' ) || define( 'CM_TYPESENSE_FILE_PATH', __FILE__ );
defined( 'CM_TYPESENSE_DIR_PATH' ) || define( 'CM_TYPESENSE_DIR_PATH', dirname( __FILE__ ) );

require CM_TYPESENSE_DIR_PATH.'/includes/Bootstrap.php';


if ( ! function_exists( 'dump' ) ) {
	function dump( $response ) {
		var_dump( $response );
		die;
	}
}


   

