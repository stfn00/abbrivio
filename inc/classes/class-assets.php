<?php

/**
 * Enqueue theme assets
 *
 * @package Abbrivio
 */

namespace ABBRIVIO_THEME\Inc;

use ABBRIVIO_THEME\Inc\Traits\Singleton;

class Assets
{
	use Singleton;

	protected function __construct()
	{
		// load class
		$this->setup_hooks();
	}

	protected function setup_hooks()
	{
		/**
		 * Actions
		 */
		// Enqueue site scripts
		add_action('wp_enqueue_scripts', [$this, 'register_scripts']);
		// Enqueue site style
		add_action('wp_enqueue_scripts', [$this, 'register_styles']);
		// Enqueue admin style
		add_action('admin_enqueue_scripts', [$this, 'register_admin_styles']);
		// Enqueue admin login style
		add_action('login_enqueue_scripts', [$this, 'register_login_admin_styles']);
		/**
		 * The 'enqueue_block_assets' hook includes styles and scripts both in editor and frontend
		 * except when is_admin() is used to include them conditionally
		 */
		add_action('enqueue_block_assets', [$this, 'enqueue_editor_assets']);
	}



	/**
	 * Enqueue site scripts
	 */
	public function register_scripts()
	{
		// Register scripts
		wp_register_script('slick-js', ABBRIVIO_BUILD_LIB_URI . '/js/slick.min.js', ['jquery'], false, true);
		wp_register_script('abbrivio-main-js', ABBRIVIO_BUILD_JS_URI . '/main.js', ['jquery', 'slick-js'], filemtime(ABBRIVIO_BUILD_JS_DIR_PATH . '/main.js'), true);

		// Enqueue scripts
		wp_enqueue_script('slick-js');
		wp_enqueue_script('abbrivio-main-js');
	}



	/**
	 * Enqueue site style
	 */
	public function register_styles()
	{
		// Register styles
		wp_register_style('slick-css', ABBRIVIO_BUILD_LIB_URI . '/css/slick.css', [], false, 'all');
		// wp_register_style('slick-theme-css', ABBRIVIO_BUILD_LIB_URI . '/css/slick-theme.css', ['slick-css'], false, 'all');
		wp_register_style('abbrivio-main-css', ABBRIVIO_BUILD_CSS_URI . '/main.css', [], filemtime(ABBRIVIO_BUILD_CSS_DIR_PATH . '/main.css'), 'all');

		// Enqueue style
		wp_enqueue_style('slick-css');
		// wp_enqueue_style('slick-theme-css');
		wp_enqueue_style('abbrivio-main-css');
	}



	/**
	 * Enqueue admin style
	 */
	public function register_admin_styles()
	{
		// Register styles
		wp_register_style('abbrivio-custom-admin', ABBRIVIO_BUILD_CSS_URI . '/admin.css', [], filemtime(ABBRIVIO_BUILD_CSS_DIR_PATH . '/admin.css'), 'all');

		// Enqueue Styles
		wp_enqueue_style('abbrivio-custom-admin');
	}



	/**
	 * Enqueue admin login style
	 */
	public function register_login_admin_styles()
	{
		// Register styles
		wp_register_style('abbrivio-custom-login', ABBRIVIO_BUILD_CSS_URI . '/adminLogin.css', [], filemtime(ABBRIVIO_BUILD_CSS_DIR_PATH . '/adminLogin.css'), 'all');

		// Enqueue styles
		wp_enqueue_style('abbrivio-custom-login');
	}



	/**
	 * Enqueue editor scripts and styles
	 */
	public function enqueue_editor_assets()
	{

		$asset_config_file = sprintf('%s/assets.php', ABBRIVIO_BUILD_PATH);

		if (!file_exists($asset_config_file)) {
			return;
		}

		$asset_config = require_once $asset_config_file;

		if (empty($asset_config['js/editor.js'])) {
			return;
		}

		$editor_asset    = $asset_config['js/editor.js'];
		$js_dependencies = (!empty($editor_asset['dependencies'])) ? $editor_asset['dependencies'] : [];
		$version         = (!empty($editor_asset['version'])) ? $editor_asset['version'] : filemtime($asset_config_file);

		// Theme Gutenberg blocks JS
		if (is_admin()) {
			wp_enqueue_script(
				'abbrivio-blocks-js',
				ABBRIVIO_BUILD_JS_URI . '/blocks.js',
				$js_dependencies,
				$version,
				true
			);
		}

		// Theme Gutenberg blocks CSS
		$css_dependencies = [
			'wp-block-library-theme',
			'wp-block-library',
		];

		wp_enqueue_style(
			'abbrivio-blocks-css',
			ABBRIVIO_BUILD_CSS_URI . '/blocks.css',
			$css_dependencies,
			filemtime(ABBRIVIO_BUILD_CSS_DIR_PATH . '/blocks.css'),
			'all'
		);
	}
}
