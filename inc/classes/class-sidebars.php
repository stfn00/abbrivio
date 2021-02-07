<?php

/**
 * Theme Sidebars
 *
 * @package Abbrivio
 */

namespace ABBRIVIO_THEME\Inc;

use ABBRIVIO_THEME\Inc\Traits\Singleton;

/**
 * Class Assets
 */
class Sidebars
{
	use Singleton;

	/**
	 * Construct method
	 */
	protected function __construct()
	{
		$this->setup_hooks();
	}

	/**
	 * To register action/filter
	 *
	 * @return void
	 */
	protected function setup_hooks()
	{
		/**
		 * Actions
		 */
		add_action('widgets_init', [$this, 'register_sidebars']);
		add_action('widgets_init', [$this, 'register_clock_widget']);
	}



	/**
	 * Register widgets
	 *
	 * @action widgets_init
	 */
	public function register_sidebars()
	{
		register_sidebar(
			[
				'name'          => esc_html__('Sidebar', 'abbrivio'),
				'id'            => 'sidebar-1',
				'description'   => '',
				'before_widget' => '<div id="%1$s" class="widget widget-sidebar %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			]
		);
	}



	/**
	 * Register Widget Clock
	 */
	public function register_clock_widget()
	{
		register_widget('ABBRIVIO_THEME\Inc\Clock_Widget');
	}
}
