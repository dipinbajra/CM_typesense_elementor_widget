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

//  if ( ! defined( 'ASBPATH' )){
//     exit();
//  }

function register_elementor_cm_typesense( $widget_manager ){
   require_once( __DIR__ . '/widgets/elementor-cm-typesense.php');
   $widget_manager->register( new Elementor_CM_Typesense());
}
add_action( 'elementor/widgets/register', 'register_elementor_cm_typesense' );


   
if( !function_exists('dump')) {
   function dump($response) {
      var_dump($response);
      die;
   }
}

   

