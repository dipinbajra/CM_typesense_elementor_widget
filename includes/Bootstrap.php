<?php

namespace Codemanas\TypesenseElementor;

class Bootstrap {
	public static ?Bootstrap $instance = null;

	public static function get_instance(): ?Bootstrap {
		return is_null( self::$instance ) ? self::$instance = new self() : self::$instance;
	}

	public function __construct() {
		//here is where we setup our hooks
		$this->autoLoader();
		add_action('plugin_loaded', [$this, 'initPlugin']);
	}
	private function autoLoader(){
		require CM_TYPESENSE_DIR_PATH.'/vendor/autoload.php';
	}
	public function initPlugin(  ) {
		Main::get_instance();
//		$obj = new test();
//		var_dump($obj);
//		$obj1 = new test();
//		var_dump($obj1);
//
//		$obj = SingletonTest::get_instance();
//		var_dump($obj);
//		$obj1 = SingletonTest::get_instance();
//		var_dump($obj1);die;


	}
}
Bootstrap::get_instance();