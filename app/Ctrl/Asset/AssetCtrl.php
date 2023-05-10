<?php

namespace Bfsb\Ctrl\Asset;

use Bfsb\Helper\Fns;
use Bfsb\Helper\I18n;

class AssetCtrl
{
    private $suffix;
    private $version; 

    public function __construct()
    {
        $this->suffix = defined("SCRIPT_DEBUG") && SCRIPT_DEBUG ? "" : ".min";
        $this->version = defined("WP_DEBUG") && WP_DEBUG ? time() : bfsb()->version(); 

        add_action("wp_enqueue_scripts", [$this, "public_scripts"], 9999);
        add_action("admin_enqueue_scripts", [$this, "admin_scripts"], 9999); 

        add_action("current_screen", function () {
            if (!$this->is_plugins_screen()) {
                return;
            }

            add_action("admin_enqueue_scripts", [
                $this,
                "enqueue_feedback_dialog",
            ]);
        }); 
    }  

    private function admin_public_script()
    {
    }

    private function dashboard_script()
    {
        //font family
        if (
            (isset($_GET["page"]) && $_GET["page"] == "bfsb-welcome") ||
            (isset($_GET["page"]) && $_GET["page"] == "bfsb") ||
            is_page_template([
                "spacex-blocks-template.php"
            ]) ||
            $this->is_plugins_screen()
        ) {
            wp_enqueue_style(
                "bfsb-google-font",
                "https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap",
                [],
                $this->version
            );
            wp_enqueue_style(
                "bfsb-main",
                bfsb()->get_asset_uri("css/main{$this->suffix}.css"),
                [],
                $this->version
            );
        }
        if (isset($_GET["page"]) && $_GET["page"] == "bfsb-welcome") {
            wp_enqueue_style(
                "bfsb-welcome",
                bfsb()->get_asset_uri("css/welcome{$this->suffix}.css"),
                [],
                $this->version
            );
            wp_enqueue_script(
                "bfsb-welcome",
                bfsb()->get_asset_uri("/js/welcome{$this->suffix}.js"),
                ['wp-element'],
                $this->version,
                true
            );
            wp_localize_script("bfsb-welcome", "bfsb", [
                "apiUrl" => esc_url(rest_url()),
                "nonce" => wp_create_nonce("wp_rest"),
                "dashboard" => menu_page_url("bfsb", false),
                "assetImgUri" => bfsb()->get_asset_uri("img/")
            ]);
        }
        
    }

    public function public_scripts()
    {
        $this->admin_public_script();

        $this->dashboard_script();
    }

    public function admin_scripts()
    {
        $this->admin_public_script();
        $this->dashboard_script();
    }

    /**
     * Enqueue feedback dialog scripts.
     *
     * Registers the feedback dialog scripts and enqueues them.
     *
     * @since 1.0.0
     * @access public
     */
    public function enqueue_feedback_dialog()
    {
        add_action("admin_footer", [$this, "deactivate_feedback_dialog"]);
        wp_enqueue_script(
            "bfsb-feedback",
            bfsb()->get_asset_uri("/js/feedback{$this->suffix}.js"),
            [],
            $this->version,
            true
        );
        wp_localize_script("bfsb-feedback", "bfsb", [
            "ajaxurl" => esc_url(admin_url("admin-ajax.php")),
        ]);
    } 

    /**
     * @since 1.0.1.5
     */
    public function deactivate_feedback_dialog()
    {
        bfsb()->render("feedback/form");
    }

    /**
     * @since 1.0.1.5
     */
    private function is_plugins_screen()
    {
        if (!function_exists("get_current_screen")) {
            require_once ABSPATH . "/wp-admin/includes/screen.php";
        }

        if (is_admin()) {
            return in_array(get_current_screen()->id, [
                "plugins",
                "plugins-network",
            ]);
        } else {
            return false;
        }
    }
}
