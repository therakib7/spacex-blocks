<?php
namespace Bfsb\Ctrl\Install\Type;

class Page {

    public function __construct() {
        $this->create_custom_page();
    }

    function create_custom_page() {
        //SpaceX Blocks 

        if ( ! get_page_by_path( 'spacex-blocks' ) ) {
            $args = array(
                'post_title'    => 'SpaceX Blocks',
                'post_name'     => 'spacex-blocks',
                'post_status'   => 'publish',
                'post_author'   => 1,
                'post_type'     => 'page',
            );
            $id = wp_insert_post( $args );
            add_post_meta($id, '_wp_page_template', 'spacex-blocks-template.php');
        }
    }
}
