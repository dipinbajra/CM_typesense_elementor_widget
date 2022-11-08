<?php

namespace Codemanas\TypesenseElementor;

class SingletonTest {
	public static ?SingletonTest $instance = null;


	public static function get_instance(): ?SingletonTest {
		return is_null( self::$instance ) ? self::$instance = new self() : self::$instance;
	}

	public function __construct() {
		add_action('wp_footer', [$this, 'lol']);

	}
	public function lol(){
		echo "Codemanas is here";
	}


}

