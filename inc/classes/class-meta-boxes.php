<?php

/**
 * Register Meta Boxes
 *
 * @package Abbrivio
 */

namespace ABBRIVIO_THEME\Inc;

use ABBRIVIO_THEME\Inc\Traits\Singleton;

/**
 * Class Meta_Boxes
 */
class Meta_Boxes
{
	use Singleton;

	private $theme_options;

	protected function __construct()
	{
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
		if ( !empty($this->theme_options['abbrivio-show-author-meta-box-for']) ) {
			add_action('add_meta_boxes', [$this, 'add_show_author_box_meta_box']);
			add_action('save_post', [$this, 'save_show_author_box_meta_data']);
		}
	}



	/**
	 * Add custom meta box
	 *
	 * @return void
	 */
	public function add_show_author_box_meta_box()
	{
		$screens = $this->theme_options['abbrivio-show-author-meta-box-for'];
		foreach ($screens as $screen) {
			add_meta_box(
				'abbrivio-show-author-box', // Unique ID
				__('Author Box', 'abbrivio'), // Box title
				[$this, 'show_author_box_meta_box_html'], // Content callback, must be of type callable
				$screen, // Post type
				'side' // context
			);
		}
	}



	/**
	 * Custom meta box HTML( for form )
	 *
	 * @param object $post Post
	 *
	 * @return void
	 */
	public function show_author_box_meta_box_html($post)
	{
		$value = get_post_meta($post->ID, 'abbrivio_show_author_box', true);

		/**
		 * Use nonce for verification
		 * This will create a hidden input field with id and name as
		 * 'abbrivio_show_author_meta_box_nonce' and unique nonce input value
		 */
		wp_nonce_field(plugin_basename(__FILE__), 'abbrivio_show_author_meta_box_nonce');

		?>
		<label for="abbrivio-field"><?php esc_html_e('Show Author Box in single page', 'abbrivio'); ?></label>
		<select name="abbrivio_show_author_box_field" id="abbrivio-field" class="abbrivio-field">
			<option value=""><?php esc_html_e('Select', 'abbrivio'); ?></option>
			<option value="true" <?php selected($value, 'true'); ?>>
				<?php esc_html_e('Yes', 'abbrivio'); ?>
			</option>
			<option value="false" <?php selected($value, 'false'); ?>>
				<?php esc_html_e('No', 'abbrivio'); ?>
			</option>
		</select>
		<?php
	}



	/**
	 * Save post meta into database
	 * when the post is saved
	 *
	 * @param integer $post_id Post id
	 *
	 * @return void
	 */
	public function save_show_author_box_meta_data($post_id)
	{
		/**
		 * When the post is saved or updated we get $_POST available
		 * Check if the current user is authorized
		 */
		if (!current_user_can('edit_post', $post_id)) {
			return;
		}

		/**
		 * Check if the nonce value we received is the same we created
		 */
		if (
			!isset($_POST['abbrivio_show_author_meta_box_nonce']) ||
			!wp_verify_nonce($_POST['abbrivio_show_author_meta_box_nonce'], plugin_basename(__FILE__))
		) {
			return;
		}

		if (array_key_exists('abbrivio_show_author_box_field', $_POST)) {
			update_post_meta(
				$post_id,
				'abbrivio_show_author_box',
				$_POST['abbrivio_show_author_box_field']
			);
		}
	}
}
