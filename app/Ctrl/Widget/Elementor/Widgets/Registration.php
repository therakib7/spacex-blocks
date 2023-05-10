<?php 
namespace Bfsb\Ctrl\Widget\Elementor\Widgets;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;

class Registration extends Widget_Base {

	public function get_name() {
		return 'bfsb-registration';
	}

	public function get_title() {
		return esc_html__( 'SpaceX Blocks: Registration', 'spacex-blocks' );
	}

	public function get_icon() {
		return 'eicon-form-horizontal';
	}

	public function get_categories() {
		return [ 'bfsb-category' ];
	}

	/**
	 * Register Button_Arrow widget controls.
	 *
	 * @since 1.0
	 */
	protected function _register_controls() {

		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Content', 'spacex-blocks' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);  
		
		// $this->add_control(
		// 	'btn_text',
		// 	[
		// 		'label' => esc_html__( 'Button Text', 'spacex-blocks' ),
		// 		'type' => Controls_Manager::TEXT,
		// 		'default' => 'Registration',
		// 	]
		// ); 

		$this->end_controls_section(); 
	}

	/**
	 * Render Button_Arrow widget output on the frontend.
	 *
	 * @since 1.0
	 */
	protected function render() {  
		$settings = $this->get_settings_for_display(); 
		//bfsb()->render('public/auth/registration'); 
	} 
} 