<?php
namespace Bfsb\Ctrl\Install;

use Bfsb\Ctrl\Install\Type\DB;
use Bfsb\Ctrl\Install\Type\Update;
use Bfsb\Ctrl\Install\Type\Page;
use Bfsb\Ctrl\Install\Type\Taxonomy;

class InstallCtrl
{
    public function __construct()
    {
        // register_activation_hook(BFSB_FILE, array($this, 'plugin_activate'));
        // add_filter('cron_schedules', array($this, 'custom_schedule'));
        // register_activation_hook(BFSB_FILE, array($this, 'schedule_my_cron'));

        // add_action('admin_init', array($this, 'insert_data'));
        // add_action('admin_init', array($this, 'plugin_redirect'));
    }

    public function custom_schedule($schedules)
    {
        $schedules['half_minute'] = array(
            'interval'  => 30,
            'display'   => esc_html__('Every Half Minute', 'spacex-blocks')
        );

        $schedules['one_minute'] = array(
            'interval'  => 60,
            'display'   => esc_html__('Every 1 Minute', 'spacex-blocks')
        );
        return $schedules;
    }

    public function schedule_my_cron()
    {

        //set cron job
        if (!wp_next_scheduled('bfsb_hourly_event')) {
            wp_schedule_event(time(), 'hourly', 'bfsb_hourly_event');
        }

        if (!wp_next_scheduled('bfsb_half_minute_event')) {
            wp_schedule_event(time(), 'half_minute', 'bfsb_half_minute_event');
        }

        if (!wp_next_scheduled('bfsb_one_minute_event')) {
            wp_schedule_event(time(), 'one_minute', 'bfsb_one_minute_event');
        }
    }

    public function plugin_activate()
    {
        add_option('bfsb_active', true);
    }

    public function plugin_redirect()
    {
        if ( get_option('bfsb_active', false) ) {
            delete_option('bfsb_active');

            wp_redirect(admin_url('admin.php?page=bfsb-welcome'));
        }
    }

    public function insert_data()
    {
        $version = get_option('bfsb_version', '0.1.0');
        if (version_compare($version, BFSB_VERSION, '<')) {
            update_option('bfsb_version', BFSB_VERSION);
        }

        if ( version_compare($version, '1.0.0', '<') ) {
            // new Page();
            // new DB();
            // new Taxonomy(); 
        } 

        new Update();
    }
}
