<?php

namespace Bfsb\Helper;

class Constant
{
    public function __construct()
    {
        if (!defined('BFSB_VERSION')) {
            define('BFSB_VERSION', '1.0.0');
        }

        if (!defined('BFSB_PATH')) {
            define('BFSB_PATH', plugin_dir_path(BFSB_FILE));
        }

        if (!defined('BFSB_URL')) {
            define('BFSB_URL', plugins_url('', BFSB_FILE));
        }

        if (!defined('BFSB_SLUG')) {
            define('BFSB_SLUG', basename(dirname(BFSB_FILE)));
        }

        if (!defined('BFSB_TEMPLATE_DEBUG_MODE')) {
            define('BFSB_TEMPLATE_DEBUG_MODE', false);
        }
    }
}
