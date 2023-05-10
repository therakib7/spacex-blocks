<?php

namespace Bfsb\Helper; 

class Fns
{
   


    public static function phpToMomentFormat($format)
    {
        $replacements = [
            'd' => 'DD',
            'D' => 'ddd',
            'j' => 'D',
            'l' => 'dddd',
            'N' => 'E',
            'S' => 'o',
            'w' => 'e',
            'z' => 'DDD',
            'W' => 'W',
            'F' => 'MMMM',
            'm' => 'MM',
            'M' => 'MMM',
            'n' => 'M',
            't' => '', // no equivalent
            'L' => '', // no equivalent
            'o' => 'YYYY',
            'Y' => 'YYYY',
            'y' => 'YY',
            'a' => 'a',
            'A' => 'A',
            'B' => '', // no equivalent
            'g' => 'h',
            'G' => 'H',
            'h' => 'hh',
            'H' => 'HH',
            'i' => 'mm',
            's' => 'ss',
            'u' => 'SSS',
            'e' => 'zz', // deprecated since version 1.6.0 of moment.js
            'I' => '', // no equivalent
            'O' => '', // no equivalent
            'P' => '', // no equivalent
            'T' => '', // no equivalent
            'Z' => '', // no equivalent
            'c' => '', // no equivalent
            'r' => '', // no equivalent
            'U' => 'X',
        ];
        $momentFormat = strtr($format, $replacements);
        return $momentFormat;
    }

    public static function locate_template($name)
    {
        // Look within passed path within the theme - this is priority.
        $template = [];

        $template[] = bfsb()->get_template_path() . $name . ".php";

        if (!$template_file = locate_template(apply_filters('bfsb_locate_template_names', $template))) {
            $template_file = BFSB_PATH . "templates/$name.php";
        }

        return apply_filters('bfsb_locate_template', $template_file, $name);
    }

   

    /**
     * Get template part (for templates like the shop-loop).
     *
     * BFSB_TEMPLATE_DEBUG_MODE will prevent overrides in themes from taking priority.
     *
     * @param mixed  $slug Template slug.
     * @param string $name Template name (default: '').
     */
    public static function get_template_part($slug, $args = null, $include = true)
    {
        // load template from theme if exist
        $template = BFSB_TEMPLATE_DEBUG_MODE ? '' : locate_template(
            array(
                "{$slug}.php",
                bfsb()->get_template_path() . "{$slug}.php"
            )
        );

        // load template from pro plugin if exist
        if (!$template && function_exists('bfsbp')) {
            $fallback = bfsb()->plugin_path() . "-pro" . "/templates/{$slug}.php";
            $template = file_exists($fallback) ? $fallback : '';
        }

        // load template from current plugin if exist
        if (!$template) {
            $fallback = bfsb()->plugin_path() . "/templates/{$slug}.php";
            $template = file_exists($fallback) ? $fallback : '';
        }

        // Allow 3rd party plugins to filter template file from their plugin.
        $template = apply_filters('bfsb_get_template_part', $template, $slug);

        if ($template) {
            if (!empty($args) && is_array($args)) {
                extract($args); // @codingStandardsIgnoreLine
            }

            // load_template($template, false, $args);
            if ($include) {
                include $template;
            } else {
                return $template;
            }
        }
    }

    public static function doing_it_wrong($function, $message, $version)
    {
        // @codingStandardsIgnoreStart
        $message .= ' Backtrace: ' . wp_debug_backtrace_summary();
        _doing_it_wrong($function, $message, $version);
    }

    public static function get_template($fileName, $args = null)
    {
        if (!empty($args) && is_array($args)) {
            extract($args); // @codingStandardsIgnoreLine
        }

        $located = self::locate_template($fileName);

        if (!file_exists($located)) {
            /* translators: %s template */
            self::doing_it_wrong(__FUNCTION__, sprintf(__('%s does not exist.', 'spacex-blocks'), '<code>' . $located . '</code>'), '1.0');

            return;
        }

        // Allow 3rd party plugin filter template file from their plugin.
        $located = apply_filters('bfsb_get_template', $located, $fileName, $args);

        do_action('bfsb_before_template_part', $fileName, $located, $args);

        include $located;

        do_action('bfsb_after_template_part', $fileName, $located, $args);
    }

    /**
     * @param $id
     *
     * @return bool|mixed|void
     */
    public static function get_option($id)
    {
        if (!$id) {
            return false;
        }
        $settings = get_option($id, []);

        return apply_filters($id, $settings);
    }

    /**
     * Clean variables using sanitize_text_field. Arrays are cleaned recursively.
     * Non-scalar values are ignored.
     *
     * @param string|array $var Data to sanitize.
     *
     * @return string|array
     */
    public static function clean($var)
    {
        if (is_array($var)) {
            return array_map([self::class, 'clean'], $var);
        } else {
            return is_scalar($var) ? sanitize_text_field($var) : $var;
        }
    }

    public static function gravatar($email, $size = 40)
    {
        $hash = md5(strtolower(trim($email)));
        return sprintf('https://www.gravatar.com/avatar/%s?s=%s', $hash, $size);
    }

    /**
     *  String to slug convert
     *
     * @package BFSB Project
     * @since 1.0
     */
    public static function slugify($string)
    {
        return strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $string), '-'));
    }

    /**
     * Sanitize out put
     *
     * @package BFSB Project
     * @since 1.0
     */
    public function sanitizeOutPut($value, $type = 'text')
    {
        $newValue = null;
        if ($value) {
            if ($type == 'text') {
                $newValue = esc_html(stripslashes($value));
            } elseif ($type == 'url') {
                $newValue = esc_url(stripslashes($value));
            } elseif ($type == 'textarea') {
                $newValue = esc_textarea(stripslashes($value));
            } else {
                $newValue = esc_html(stripslashes($value));
            }
        }
        return $newValue;
    }

    /**
     * Image information
     *
     * @package BFSB Project
     * @since 1.0
     */
    public function imageInfo($attachment_id)
    {
        $data = array();
        $imgData = wp_get_attachment_metadata($attachment_id);
        $data['id'] = $attachment_id;
        $data['url'] = wp_get_attachment_url($attachment_id);
        $data['width'] = !empty($imgData['width']) ? absint($imgData['width']) : 0;
        $data['height'] = !empty($imgData['height']) ? absint($imgData['height']) : 0;

        return $data;
    }

    /**
     *  Format bye
     *
     * @package BFSB Project
     * @since 1.0
     */
    public static function format_bytes($bytes)
    {
        $label = array('B', 'KB', 'MB', 'GB', 'TB', 'PB');
        for ($i = 0; $bytes >= 1024 && $i < (count($label) - 1); $bytes /= 1024, $i++);
        return (round($bytes, 2) . " " . $label[$i]);
    }
}
