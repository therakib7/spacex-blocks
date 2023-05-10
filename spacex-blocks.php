<?php
if (!defined('ABSPATH')) {
    die;
} // Cannot access directly.
/**
 *
 * @package   Brainstormforce - SpaceX Blocks
 * @author    Brainstormforce <support@spacex-blocks.com>
 * @link      https://spacex-blocks.com
 * @copyright 2023 Brainstormforce
 *
 * Plugin Name: SpaceX Blocks
 * Plugin URI: https://wordpress.org/plugins/spacex-blocks
 * Author: Brainstormforce
 * Author URI: https://brainstormforce.com
 * Version: 1.0.0
 * Description: Show SpaceX Rockets or Capsules on your site
 * Text Domain: spacex-blocks
 * Domain Path: /languages
 *
 */

if (!class_exists('Bfsb')) {

    if (!defined('BFSB_FILE')) {
        define('BFSB_FILE', __FILE__);
    }

    require_once plugin_dir_path(__FILE__) . 'app/Bfsb.php';
}
