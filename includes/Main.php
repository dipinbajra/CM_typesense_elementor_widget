<?php

namespace Codemanas\TypesenseElementor;

use Codemanas\TypesenseElementor\Widgets\InstantSearch;
use Codemanas\TypesenseElementor\Widgets\AutoComplete;
use Codemanas\TypesenseElementor\Widgets\SimpleJSWidget;

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
		$widget_manager->register( new AutoComplete() );
		$widget_manager->register( new SimpleJSWidget() );
	}
}