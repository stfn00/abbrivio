<?php

/**
 * Bootstraps the Theme
 *
 * @package Abbrivio
 */

namespace ABBRIVIO_THEME\Inc;

use ABBRIVIO_THEME\Inc\Traits\Singleton;

class ABBRIVIO_THEME
{
	use Singleton;

	private $theme_options;

	protected function __construct()
	{
		// Load class
		Permissions::get_instance();
		Assets::get_instance();
		Menus::get_instance();
		Meta_Boxes::get_instance();
		Sidebars::get_instance();
		Blocks::get_instance();
		Block_Patterns::get_instance();
		Clean::get_instance();
		Options_Page::get_instance();

		// Get Theme options
        $this->theme_options = abbrivio_get_options();

		// load class
		$this->setup_hooks();
	}

	protected function setup_hooks()
	{

		/**
		 * Actions
		 */
		// Setup theme
		add_action('after_setup_theme', [$this, 'setup_theme']);
		// Add lazy loading to all <img />
		add_filter('the_content', [$this, 'add_lazyload_to_img']);
		// Filter main query
		add_action('pre_get_posts', [$this, 'post_filters']);
	}



	/**
	 * Setup theme
	 *
	 * @return void
	 */
	public function setup_theme()
	{
		/**
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on understrap, use a find and replace
		 * to change 'understrap' to the name of your theme in all the template files
		 */
		load_theme_textdomain( 'abbrivio', ABBRIVIO_DIR_PATH . '/languages' );

		/**
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us
		 */
		add_theme_support('title-tag');

		/**
		 * Custom logo
		 *
		 * @see Adding custom logo
		 * @link https://developer.wordpress.org/themes/functionality/custom-logo/#adding-custom-logo-support-to-your-theme
		 */
		add_theme_support(
			'custom-logo',
			[
				'header-text' => [
					'site-title',
					'site-description',
				],
				'height'      => 100,
				'width'       => 400,
				'flex-height' => true,
				'flex-width'  => true,
			]
		);

		/**
		 * Enable support for Post Thumbnails on posts and pages
		 *
		 * Adding this will allow you to select the featured image on posts and pages
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support('post-thumbnails');

		add_theme_support('post-formats', array('aside', 'gallery'));


		/**
		 * Register image sizes
		 */
		add_image_size('abbrivio-large', 1260, 600, true);
		add_image_size('abbrivio-medium', 650, 470, true);
		add_image_size('abbrivio-small', 400, 345, true);


		// Add theme support for selective refresh for widgets
		/**
		 * WordPress 4.5 includes a new Customizer framework called selective refresh
		 *
		 * Selective refresh is a hybrid preview mechanism that has the performance benefit of not having to refresh the entire preview window
		 *
		 * @link https://make.wordpress.org/core/2016/03/22/implementing-selective-refresh-support-for-widgets/
		 */
		add_theme_support('customize-selective-refresh-widgets');

		// Add default posts and comments RSS feed links to head
		add_theme_support('automatic-feed-links');

		/**
		 * Switch default core markup for search form, comment form, comment-list, gallery, caption, script and style
		 * to output valid HTML5
		 */
		add_theme_support(
			'html5',
			[
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'script',
				'style',
			]
		);

		// Gutenberg theme support

		/**
		 * Some blocks in Gutenberg like tables, quotes, separator benefit from structural styles (margin, padding, border etc…)
		 * They are applied visually only in the editor (back-end) but not on the front-end to avoid the risk of conflicts with the styles wanted in the theme
		 * If you want to display them on front to have a base to work with, in this case, you can add support for wp-block-styles, as done below
		 * 
		 * @see Theme Styles
		 * @link https://make.wordpress.org/core/2018/06/05/whats-new-in-gutenberg-5th-june/, https://developer.wordpress.org/block-editor/developers/themes/theme-support/#default-block-styles
		 */
		add_theme_support('wp-block-styles');

		/**
		 * Some blocks such as the image block have the possibility to define
		 * a “wide” or “full” alignment by adding the corresponding classname
		 * to the block’s wrapper ( alignwide or alignfull ). A theme can opt-in for this feature by calling
		 * add_theme_support( 'align-wide' ), like we have done below
		 *
		 * @see Wide Alignment
		 * @link https://developer.wordpress.org/block-editor/developers/themes/theme-support/#wide-alignment
		 */
		add_theme_support('align-wide');

		/**
		 * Loads the editor styles in the Gutenberg editor
		 *
		 * Editor Styles allow you to provide the CSS used by WordPress’ Visual Editor so that it can match the frontend styling
		 * If we don't add this, the editor styles will only load in the classic editor ( tiny mice )
		 *
		 * @see https://developer.wordpress.org/block-editor/developers/themes/theme-support/#editor-styles
		 */
		add_theme_support('editor-styles');
		/**
		 *
		 * Path to our custom editor style
		 * It allows you to link a custom stylesheet file to the TinyMCE editor within the post edit screen
		 *
		 * Since we are not passing any parameter to the function
		 * it will by default, link the editor-style.css file located directly under the current theme directory
		 * In our case since we are passing 'assets/build/css/editor.css' path it will use that
		 * You can change the name of the file or path and replace the path here
		 *
		 * @see add_editor_style(
		 * @link https://developer.wordpress.org/reference/functions/add_editor_style/
		 */
		add_editor_style('assets/build/css/editor.css');

		// Remove the core block patterns
		remove_theme_support('core-block-patterns');

		/**
		 * Set the maximum allowed width for any content in the theme
		 * like oEmbeds and images added to posts
		 *
		 * @see Content Width
		 * @link https://codex.wordpress.org/Content_Width
		 */
		global $content_width;
		if (!isset($content_width)) {
			$content_width = 1240;
		}
	}



	/**
	 * Add lazy loading to all <img />
	 */
	public function add_lazyload_to_img($content)
	{
		if (!is_feed()) {

			$content = mb_convert_encoding($content, 'HTML-ENTITIES', "UTF-8");

			if (!empty($content)) {

				$document = new \DOMDocument();

				libxml_use_internal_errors(true);

				$document->loadHTML(utf8_decode($content));

				$imgs = $document->getElementsByTagName('img');

				if ($imgs) {
					foreach ($imgs as $key => $value) {
						// if ($key !== 0) {
						$value->setAttribute('class', 'lazy');
						$value->setAttribute('data-srcset', $value->getAttribute('srcset'));
						$value->setAttribute('data-src', $value->getAttribute('src'));
						$value->removeAttribute('src');
						$value->removeAttribute('srcset');
						$value->removeAttribute('width');
						$value->removeAttribute('height');
						// }
					}
				}

				$html = $document->saveHTML();

				return $html;
			}
		}
	}




	/**
	 * Filter main query
	 */
	public function post_filters($query)
	{
		// Posts page
		if (is_home() && !is_admin() && $query->is_main_query() && !is_front_page() && !is_archive()) {

			$query->set('posts_per_page', $this->theme_options['abbrivio-posts-per-page-blog']);
			$query->set('ignore_sticky_posts', 1);
		}

		// Archive page
		if (is_archive() && !is_admin() && $query->is_main_query() && !is_home() && !is_front_page()) {

			$query->set('posts_per_page', $this->theme_options['abbrivio-posts-per-page-archive']);
			$query->set('ignore_sticky_posts', 1);
		}

		// Tag page
		if (is_tag() && !is_admin() && $query->is_main_query() && !is_home() && !is_front_page()) {

			$query->set('posts_per_page', $this->theme_options['abbrivio-posts-per-page-tag']);
			$query->set('ignore_sticky_posts', 1);
		}

		// Search page
		if (is_search() && !is_admin() && $query->is_main_query() && !is_home() && !is_front_page() && !is_archive()) {

			$query->set('posts_per_page', $this->theme_options['abbrivio-posts-per-page-search']);
			$query->set('ignore_sticky_posts', 1);
		}
	}
}
