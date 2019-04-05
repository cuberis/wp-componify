<?php

namespace Cuberis\Base;

class Components_UI {
	/**
	 * Constructor.
	 */
	public function __construct() {
		add_action('wp_enqueue_scripts', [$this, 'enqueue_frontend_assets']);
		add_action('admin_enqueue_scripts', [$this, 'enqueue_backend_assets']);
  }

	public function enqueue_frontend_assets() {
		wp_enqueue_style('components-ui-css', get_template_directory_uri() . '/vendor/cuberis/wp-componify/assets/styles/main.css', false, null);
		wp_enqueue_script('components-ui-js', get_template_directory_uri() . '/vendor/cuberis/wp-componify/assets/scripts/main.js', ['jquery'], null, true);
	}

	public function enqueue_backend_assets() {
		wp_enqueue_style('admin-components-ui-css', get_template_directory_uri() . '/vendor/cuberis/wp-componify/assets/styles/admin-main.css', false, null);
		wp_enqueue_script('admin-components-ui-js', get_template_directory_uri() . '/vendor/cuberis/wp-componify/assets/scripts/admin-main.js', ['jquery'], null, true);
	}
}

/**
 * Initialize if theme support is declared.
 */
function init_components_ui() {
	if (is_user_logged_in() && current_theme_supports('components-ui')) {
		new Components_UI();
	}
}
add_action('after_setup_theme', __NAMESPACE__  . '\\init_components_ui', 999);
