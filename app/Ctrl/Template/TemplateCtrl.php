<?php
namespace Bfsb\Ctrl\Template;

class TemplateCtrl
{
	public function __construct()
	{
		// add_filter('theme_page_templates', [$this, 'template_list'], 10, 4);
		// add_filter('template_include', [$this, 'template_path']); 
	}

	/**
	 * Add "Custom" template to page attirbute template section.
	 */
	function template_list($post_templates, $wp_theme, $post, $post_type)
	{
		if ( function_exists('bfsbp') ) {
			$post_templates['workspace-template.php'] = esc_html__('SpaceX Blocks Workspace', 'spacex-blocks');
		}
		return $post_templates;
	}

	/**
	 * Check if current page has our custom template. Try to load
	 * template from theme directory and if not exist load it
	 * from root plugin directory.
	 */
	function template_path($default)
	{
		$templates = [
			'workspace' 
		];

		foreach ( $templates as $template ) {
			if ( get_page_template_slug() === $template .'-template.php' ) {
				$custom_template = bfsb()->plugin_path() . '/view/template/' . $template . '-template.php';
				if ( file_exists($custom_template) ) {
					return $custom_template;
					break;
				}
			}
		}

		return $default;
	} 
}
