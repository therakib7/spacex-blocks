<?php
namespace Bfsb\Ctrl\Assist\Type;

class Link {

    public function __construct() {
        add_filter('plugin_action_links_' . plugin_basename(BFSB_FILE), [$this, 'links']);
    }

    /**
	 * Assist links.
	 *
	 * @param array $links
	 *
	 * @return array
	 */
	public function links( $links ) {
		$links[] = '<a target="_blank" href="' . esc_url( 'https://spacex-blocks.com/docs' ) . '">Documentation</a>';
		if ( ! function_exists( 'bfsbp' ) ) {
			$links[] = '<a target="_blank" style="color: #39b54a;font-weight: 700;" href="' . esc_url( 'https://spacex-blocks.com?utm_source=WordPress&utm_medium=spacex-blocks&utm_campaign=pro_click' ) . '">Get Pro</a>';
		}

		if ( array_key_exists( 'deactivate', $links ) ) {
            $links['deactivate'] = str_replace( '<a', '<a class="bfsb-deactivate-link"', $links['deactivate'] );
        }
		return $links;
	}
}
