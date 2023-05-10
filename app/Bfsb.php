<?php

require_once __DIR__ . './../vendor/autoload.php';

use Bfsb\Ctrl\Install\InstallCtrl;
use Bfsb\Traits\Singleton;
use Bfsb\Helper\Constant;
use Bfsb\Helper\Fns;
use Bfsb\Helper\Data;
use Bfsb\Ctrl\MainCtrl;

/**
 * Class Bfsb
 */
final class Bfsb {

    use Singleton;

    /**
     * BFSB Project Constructor.
     */
    public function __construct() {
        new Constant();
        new InstallCtrl();
        $this->init_hooks();
    }

    private function init_hooks() {

        add_action('plugins_loaded', [$this, 'on_plugins_loaded'], -1);
        add_action('init', [$this, 'init'], 1);
    }

    public function init() {
        do_action('bfsb_before_init');

        $this->load_plugin_textdomain();

        new MainCtrl();

        do_action('bfsb_init');
    }

    public function on_plugins_loaded() {
        do_action('bfsb_loaded');
    }

    /**
     * Load Localization files.
     */
    public function load_plugin_textdomain() {

        $locale = determine_locale();
        $locale = apply_filters('bfsb_plugin_locale', $locale );
        unload_textdomain('spacex-blocks');
        load_textdomain('spacex-blocks', WP_LANG_DIR . '/bfsb/bfsb-' . $locale . '.mo');
        load_plugin_textdomain('spacex-blocks', false, plugin_basename(dirname(BFSB_FILE)) . '/languages');
    }

    /**
     * What type of request is this?
     *
     * @param string $type admin, ajax, cron or public.
     *
     * @return bool
     */
    public function is_request( $type ) {
        switch( $type ) {
            case 'admin':
                return is_admin();
            case 'public':
                return ( !is_admin() || defined('DOING_AJAX') ) && !defined('DOING_CRON');
            case 'ajax':
                return defined('DOING_AJAX');
            case 'cron':
                return defined('DOING_CRON');
        }
    }

    /**
     * Get the plugin path.
     *
     * @return string
     */
    public function plugin_path() {
        return untrailingslashit(plugin_dir_path(BFSB_FILE));
    }

    /**
     * @return mixed
     */
    public function version() {
        return BFSB_VERSION;
    }

    /**
     * Get the template path.
     *
     * @return string
     */
    public function get_template_path() {
        return apply_filters('bfsb_template_path', 'bfsb/templates/');
    }

    /**
     * Get the template partial path.
     *
     * @return string
     */
    public function get_partial_path( $path = null, $args = []) {
        Fns::get_template_part( 'partial/' . $path, $args );
    }

    /**
     * @param $file
     *
     * @return string
     */
    public function get_asset_uri($file) {
        $file = ltrim($file, '/');

        return trailingslashit(BFSB_URL . '/asset') . $file;
    }

    /**
     * @param $file
     *
     * @return string
     */
    public function render($viewName, $args = array(), $return = false) {
        $path = str_replace(".", "/", $viewName);
        $viewPath = BFSB_PATH . '/view/' . $path . '.php';
        if ( !file_exists($viewPath) ) {
            return;
        }

        if ( $args ) {
            extract($args);
        }

        if ( $return ) {
            ob_start();
            include $viewPath;

            return ob_get_clean();
        }
        include $viewPath;
    }

    /**
     * @param $file
     * Get all optoins field value
     * @return mixed
     */
    public function get_options() {

        $option_field = func_get_args()[0];
        $result = get_option( $option_field );
        $func_args = func_get_args();
        array_shift( $func_args );

        foreach ( $func_args as $arg ) {
            if ( is_array($arg) ) {
                if ( !empty( $result[$arg[0]] ) ) {
                    $result = $result[$arg[0]];
                } else {
                    $result = $arg[1];
                }
            } else {
                if ( !empty($result[$arg] ) ) {
                    $result = $result[$arg];
                } else {
                    $result = null;
                }
            }
        }
        return $result;
    }

    /**
     * @param $file
     * Get all optoins field value
     * @return mixed
     */
    public function get_default()
    {
        $data = new Data;
        $result = $data->default();
        $func_args = func_get_args();

        foreach ($func_args as $arg) {
            if (is_array($arg)) {
                if (!empty($result[$arg[0]])) {
                    $result = $result[$arg[0]];
                } else {
                    $result = $arg[1];
                }
            } else {
                if (!empty($result[$arg])) {
                    $result = $result[$arg];
                } else {
                    $result = null;
                }
            }
        }
        return $result;
    } 
}

/**
 * @return bool|Singleton|Bfsb
 */
function bfsb() {
    return Bfsb::getInstance();
}
bfsb(); // Run Bfsb Plugin