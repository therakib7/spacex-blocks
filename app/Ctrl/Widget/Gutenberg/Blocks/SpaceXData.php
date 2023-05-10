<?php 
namespace Bfsb\Ctrl\Widget\Gutenberg\Blocks;

class SpaceXData {
	private $suffix;
    private $version; 

	public function __construct() {   
		$this->suffix = defined("SCRIPT_DEBUG") && SCRIPT_DEBUG ? "" : ".min";
        $this->version = defined("WP_DEBUG") && WP_DEBUG ? time() : bfsb()->version(); 
 
        add_action( 'init', [$this, 'register_block'] );
    }   

	function register_block() {

		wp_register_script(
            "bfsb-script",
            bfsb()->get_asset_uri("/js/spacex-data{$this->suffix}.js"),
            ['wp-blocks', 'wp-element', 'wp-api-fetch', 'wp-i18n', 'wp-editor'],
            $this->version,
            true
        );

		$localize_script = [
			"apiUrl" => esc_url(rest_url()),
			"assetUri" => trailingslashit(BFSB_URL),
			"nonce" => wp_create_nonce("wp_rest") 
		];
		wp_localize_script("bfsb-script", "bfsb", $localize_script);

        wp_register_script(
            "bfsb-editor-script",
            bfsb()->get_asset_uri("/js/spacex-data-editor{$this->suffix}.js"),
            ['wp-blocks', 'wp-element', 'wp-api-fetch', 'wp-i18n', 'wp-editor'],
            $this->version,
            true
        ); 
		wp_localize_script("bfsb-editor-script", "bfsb", $localize_script);

		register_block_type( 
			'bfsb/spacex-data', 
			[
				'script' => 'bfsb-script',
				'editor_script' => 'bfsb-editor-script',
				'render_callback' => [$this, 'render'],
				'attributes'      => [
					'grid' => [
						'default' => '2',
						'type'    => 'string'
					],
					'perPage' => [
						'default' => 6,
						'type'    => 'number'
					]
				],
			]
		);
	}

	function render( $attributes, $content ) {
		$grid = $attributes['grid'];
		$perPage = $attributes['perPage']; 

		if ( ! is_user_logged_in() ) {
			ob_start();
				bfsb()->render('template/partial/login');
			return ob_get_clean();
		}

		return "<div id='bfsb-spacex-data' data-grid='$grid' data-per-page='$perPage'></div>"; 
	}
} 
