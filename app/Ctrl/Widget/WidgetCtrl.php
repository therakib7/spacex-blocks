<?php 
namespace Bfsb\Ctrl\Widget;

use Bfsb\Ctrl\Widget\Elementor\ElementorCtrl;
use Bfsb\Ctrl\Widget\Gutenberg\GutenbergCtrl;

class WidgetCtrl {
	public function __construct() {   
		if( in_array( 'elementor/elementor.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
			// new ElementorCtrl();
		} 
		new GutenbergCtrl();
	} 
}