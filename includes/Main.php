<?php

namespace Codemanas\TypesenseElementor;

use Codemanas\TypesenseElementor\Widgets\InstantSearch;

class Main {
	public static ?Main $instance = null;

	public static function get_instance(): ?Main {
		return is_null( self::$instance ) ? self::$instance = new self() : self::$instance;
	}

	public function __construct() {
		add_action( 'elementor/widgets/register', [$this,'register_widget'] );
	}

	public function register_widget( $widget_manager ) {
		$widget_manager->register( new InstantSearch() );
	}
}