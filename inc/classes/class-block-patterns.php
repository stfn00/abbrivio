<?php

/**
 * Block Patterns
 *
 * @package Abbrivio
 */

namespace ABBRIVIO_THEME\Inc;

use ABBRIVIO_THEME\Inc\Traits\Singleton;

class Block_Patterns
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
		add_action('init', [$this, 'register_block_patterns']);
		add_action('init', [$this, 'register_block_pattern_categories']);
	}



	/**
	 * Register Block Patterns
	 */
	public function register_block_patterns()
	{
		if (function_exists('register_block_pattern')) {

			/**
			 * Cover Pattern
			 */
			$cover_content = $this->get_pattern_content('template-parts/patterns/cover');

			register_block_pattern(
				'abbrivio/cover',
				[
					'title' => __('Abbrivio Cover', 'abbrivio'),
					'description' => __('Abbrivio Cover Block with image and text', 'abbrivio'),
					'categories' => ['cover'],
					'content' => $cover_content,
				]
			);

			/**
			 * Two Column Pattern
			 */
			$two_columns_content = $this->get_pattern_content('template-parts/patterns/two-columns');

			register_block_pattern(
				'abbrivio/two-columns',
				[
					'title' => __('Abbrivio Two Column', 'abbrivio'),
					'description' => __('Abbrivio two columns with heading and text', 'abbrivio'),
					'categories' => ['columns'],
					'content' => $two_columns_content,
				]
			);
		}
	}



	/**
	 * Render Pattern content
	 */
	public function get_pattern_content($template_path)
	{
		ob_start();

		get_template_part($template_path);

		$pattern_content = ob_get_contents();

		ob_end_clean();

		return $pattern_content;
	}



	/**
	 * Register Pattern Category
	 */
	public function register_block_pattern_categories()
	{
		$pattern_categories = [
			'cover' => __('Cover', 'abbrivio'),
			'columns' => __('Columns', 'abbrivio'),
		];

		if (!empty($pattern_categories) && is_array($pattern_categories)) {

			foreach ($pattern_categories as $pattern_category => $pattern_category_label) {

				register_block_pattern_category(
					$pattern_category,
					['label' => $pattern_category_label]
				);
			}
		}
	}
}
