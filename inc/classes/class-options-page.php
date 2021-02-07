<?php

/**
 * Options Page
 *
 * @package Abbrivio
 */

namespace ABBRIVIO_THEME\Inc;

use ABBRIVIO_THEME\Inc\Traits\Singleton;

/**
 * Class Meta_Boxes
 */
class Options_Page
{
    use Singleton;

    private $pages;

    protected function __construct()
    {
        // Options for class
        $this->pages = array(
            'abbrivio-theme-options' => array(
                'menu_title' => __( 'Theme Options', 'abbrivio' ),
                'menu_slug' => 'abbrivio_theme_options',
                'page_title' => __( 'Abbrivio Theme Options', 'abbrivio' ),
                'sections' => array(
                    // General
                    'abbrivio-theme-options-general' => array(
                        'title' => __( 'General', 'abbrivio' ),
                        'include' => ABBRIVIO_DIR_PATH . '/template-parts/options-page/options-page.php',
                        'fields' => array(
                            'abbrivio-site-logo' => array(
                                'title' => __( 'Site Logo', 'abbrivio' ),
                                'type' => 'media',
                                'value' => ABBRIVIO_BUILD_IMG_URI . '/logo.svg',
                                'id' => 'abbrivio-site-logo',
                            ),
                            'abbrivio-site-logo-dark' => array(
                                'title' => __( 'Site Logo Dark', 'abbrivio' ),
                                'type' => 'media',
                                'id' => 'abbrivio-site-logo-dark',
                            ),
                            'abbrivio-site-logo-min' => array(
                                'title' => __( 'Site Logo min', 'abbrivio' ),
                                'type' => 'media',
                                'value' => ABBRIVIO_BUILD_IMG_URI . '/logo-min.svg',
                                'id' => 'abbrivio-site-logo-min',
                            ),
                            'abbrivio-site-logo-min-dark' => array(
                                'title' => __( 'Site Logo min Dark', 'abbrivio' ),
                                'type' => 'media',
                                'value' => ABBRIVIO_BUILD_IMG_URI . '/logo-min-dark.svg',
                                'id' => 'abbrivio-site-logo-min-dark',
                            ),
                            'abbrivio-site-favicon' => array(
                                'title' => __( 'Site Favicon', 'abbrivio' ),
                                'type' => 'media',
                                'value' => ABBRIVIO_BUILD_IMG_URI . '/favicon.ico',
                                'text' => __( 'The image must be 16x16' ),
                                'id' => 'abbrivio-site-favicon',
                            ),
                            'abbrivio-web-app-status-bar-style' => array(
                                'title' => __( 'Mobile status bar Style', 'abbrivio' ),
                                'type' => 'color',
                                'text' => __( 'Mobile status bar Style color' ),
                                'value' => '#FFFFFF',
                                'id' => 'abbrivio-web-app-status-bar-style',
                            ),
                            'abbrivio-google-analytics-script' => array(
                                'title' => __( 'Google Analytics ID', 'abbrivio' ),
                                'placeholder' => 'UA-XXXXX-Y',
                                'id' => 'abbrivio-google-analytics-script',
                            ),
                            'abbrivio-facebook-pixel-script' => array(
                                'title' => __( 'Facebook Pixel ID', 'abbrivio' ),
                                'placeholder' => 'your-pixel-id',
                                'id' => 'abbrivio-facebook-pixel-script',
                            ),
                            'abbrivio-disable-automatic-scroll-restoration' => array(
                                'title' => __( 'Disable automatic scroll restoration', 'abbrivio' ),
                                'type' => 'checkbox',
                                'text' => __( 'Disable automatic scroll restoration on page reload' ),
                                'id' => 'abbrivio-disable-automatic-scroll-restoration',
                                'value' => 'true',
                            ),
                        )
                    ),
                    // WP Queries
                    'abbrivio-theme-options-queries' => array(
                        'title' => __( 'WP Queries', 'abbrivio' ),
                        'text' => '<p class="section-description">' . __( 'Posts per page limit.', 'abbrivio' ) . '</p>',
                        'fields' => array(
                            'abbrivio-posts-per-page-blog' => array(
                                'title' => __( 'Posts page', 'abbrivio' ),
                                'type' => 'number',
                                'value' => 12,
                                'id' => 'abbrivio-posts-per-page-blog',
                            ),
                            'abbrivio-posts-per-page-archive' => array(
                                'title' => __( 'Archives', 'abbrivio' ),
                                'type' => 'number',
                                'value' => 12,
                                'id' => 'abbrivio-posts-per-page-archive',
                            ),
                            'abbrivio-posts-per-page-tag' => array(
                                'title' => __( 'Archive Tags', 'abbrivio' ),
                                'type' => 'number',
                                'value' => 12,
                                'id' => 'abbrivio-posts-per-page-tag',
                            ),
                            'abbrivio-posts-per-page-search' => array(
                                'title' => __( 'Search page', 'abbrivio' ),
                                'type' => 'number',
                                'value' => 12,
                                'id' => 'abbrivio-posts-per-page-search',
                            ),
                        ),
                    ),
                    // WP Admin Customization
                    'abbrivio-theme-options-admin' => array(
                        'title' => __( 'WP Admin Customization', 'abbrivio' ),
                        'fields' => array(
                            'abbrivio-welcome-panel-status' => array(
                                'title' => __( 'Welcome panel status', 'abbrivio' ),
                                'type' => 'checkbox',
                                'text' => __( 'If checked custom Welcome panel is shown' ),
                                'id' => 'abbrivio-welcome-panel-status',
                                'value' => 'true',
                                'checked' => true,
                            ),
                            'abbrivio-welcome-panel-message' => array(
                                'title' => __( 'Welcome panel message', 'abbrivio' ),
                                'type' => 'wp_editor',
                                'value' => '<h2>' . __('Welcome to Abbrivio!', 'abbrivio') . '</h2><p class="about-description">' . __('From this area you can manage the contents of the website.', 'abbrivio') . '</p>',
                                'id' => 'abbrivio-welcome-panel-message',
                            ),
                        ),
                    ),
                    // WP Clean
                    'abbrivio-theme-options-clean' => array(
                        'title' => __( 'WP Clean', 'abbrivio' ),
                        'fields' => array(
                            'abbrivio-disable-updates-non-admin' => array(
                                'title' => __( 'Disable all Updates', 'abbrivio' ),
                                'type' => 'checkbox',
                                'text' => __( 'Disable all Updates for non Administrator' ),
                                'id' => 'abbrivio-disable-updates-non-admin',
                                'value' => 'true',
                                'checked' => true,
                            ),
                            'abbrivio-remove-head-trash-actions' => array(
                                'title' => __( 'Remove trash actions in Head', 'abbrivio' ),
                                'type' => 'checkbox',
                                'text' => __( 'Remove trash actions in "wp_head" action' ),
                                'id' => 'abbrivio-remove-head-trash-actions',
                                'value' => 'true',
                                'checked' => true,
                            ),
                            'abbrivio-remove-emoji-support' => array(
                                'title' => __( 'Remove Emoji support', 'abbrivio' ),
                                'type' => 'checkbox',
                                'text' => __( 'Remove Emoji support' ),
                                'id' => 'abbrivio-remove-emoji-support',
                                'value' => 'true',
                                'checked' => true,
                            ),
                            'abbrivio-disable-rest-api' => array(
                                'title' => __( 'Disable REST API', 'abbrivio' ),
                                'type' => 'checkbox',
                                'text' => __( 'Disable REST API' ),
                                'id' => 'abbrivio-disable-rest-api',
                                'value' => 'true',
                            ),
                            'abbrivio-disable-xmlrpc' => array(
                                'title' => __( 'Disable xmlrpc.php', 'abbrivio' ),
                                'type' => 'checkbox',
                                'text' => __( 'Disable xmlrpc.php' ),
                                'id' => 'abbrivio-disable-xmlrpc',
                                'value' => 'true',
                            ),
                            'abbrivio-remove-dashboard-widgets-non-admin' => array(
                                'title' => __( 'Remove Dashboard Widgets', 'abbrivio' ),
                                'type' => 'checkbox',
                                'text' => __( 'Remove default Dashboard Widgets for non Administrator' ),
                                'id' => 'abbrivio-remove-dashboard-widgets-non-admin',
                                'value' => 'true',
                            ),
                            'abbrivio-remove-image-sizes' => array(
                                'title' => __( 'Remove Thumbnail sizes', 'abbrivio' ),
                                'type' => 'checkbox',
                                'text' => __( 'Remove Thumbnail width and height dimensions that prevent fluid images in "the_thumbnail"' ),
                                'id' => 'abbrivio-remove-image-sizes',
                                'value' => 'true',
                                'checked' => true,
                            ),
                            'abbrivio-disable-pdf-previews' => array(
                                'title' => __( 'Disable PDF Previews', 'abbrivio' ),
                                'type' => 'checkbox',
                                'text' => __( 'Prevent generating PDF Thumbnail Previews' ),
                                'id' => 'abbrivio-disable-pdf-previews',
                                'value' => 'true',
                                'checked' => true,
                            ),
                            'abbrivio-remove-profile-color-scheme-non-admin' => array(
                                'title' => __( 'Remove Profile color scheme', 'abbrivio' ),
                                'type' => 'checkbox',
                                'text' => __( 'Remove Profile color scheme for non Administrator' ),
                                'id' => 'abbrivio-remove-profile-color-scheme-non-admin',
                                'value' => 'true',
                            ),
                            'abbrivio-remove-admin-bar-non-admin' => array(
                                'title' => __( 'Remove Admin bar', 'abbrivio' ),
                                'type' => 'checkbox',
                                'text' => __( 'Remove Admin bar for non Administrator' ),
                                'id' => 'abbrivio-remove-admin-bar-non-admin',
                                'value' => 'true',
                                'checked' => true,
                            ),
                            'abbrivio-restrict-media-access-non-admin-editor' => array(
                                'title' => __( 'Restrict Media access', 'abbrivio' ),
                                'type' => 'checkbox',
                                'text' => __( 'Restrict access to Media library by User for non Administrator and Editor' ),
                                'id' => 'abbrivio-restrict-media-access-non-admin-editor',
                                'value' => 'true',
                                'checked' => true,
                            ),
                            'abbrivio-remove-default-thumb-sizes' => array(
                                'title' => __( 'Remove default Thumb sizes', 'abbrivio' ),
                                'type' => 'checkbox',
                                'text' => __( 'Remove default Thumbnail sizes' ),
                                'id' => 'abbrivio-remove-default-thumb-sizes',
                                'value' => 'true'
                            ),
                        ),
                    ),
                ),
            ),
        );

        // load class
        $this->setup_hooks();
    }

    protected function setup_hooks()
    {
        /**
         * Actions
         */
        $this->init_options_page();
    }



    /**
     * Init Options
     */
    public function init_options_page()
    {
        // Options page class
        $option_page = new \RationalOptionPages($this->pages);
    }



    /**
     * Get all CPT's
     */
    public function get_all_cpt()
    {
        $all_post_type_args = [];

        $all_post_type = get_post_types(['public' => true], 'objects');

        unset($all_post_type['attachment']);

        foreach ($all_post_type as $all_post_type_val) {
            $all_post_type_args[$all_post_type_val->name] = $all_post_type_val->label;
        }

        return $all_post_type_args;
    }
}
