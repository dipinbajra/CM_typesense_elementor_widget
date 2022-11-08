<?php
namespace Codemanas\TypesenseElementor;

class Test {

	public function __construct() {
		add_action( 'wp_footer', [ $this, 'new' ] );

	}
	public function new() {
		echo "codemanas is here";
	}

}




