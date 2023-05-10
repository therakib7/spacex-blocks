<?php 
namespace Bfsb\Ctrl\Widget\Elementor; 

use Elementor\Plugin; 
use Bfsb\Ctrl\Widget\Elementor\Widgets\Registration; 

class ElementorCtrl {

    public function __construct() {  
		add_action( 'elementor/elements/categories_registered', array( $this, 'bfsb_category' ) );
        add_action( 'elementor/widgets/widgets_registered', array( $this, 'widgets_registered' ) );
    }  

	/**
	 * @since 1.0
	 */
	public function widgets_registered() {					
        // Plugin::instance()->widgets_manager->register_widget_type( new Registration() ); 
	}

	/**
	 * @since 1.0
	 */
	public function bfsb_category( $elements_manager ) {

		$elements_manager->add_category(
			'bfsb-category',
			[
				'title' => esc_html__( 'SpaceX Blocks Widgets', 'spacex-blocks' ),
				'icon' => 'fa fa-plug',
			]
		);  
	}
}