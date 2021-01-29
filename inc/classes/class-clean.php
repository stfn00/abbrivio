<?php

/**
 * Clean WP
 *
 * @package Abbrivio
 */

namespace ABBRIVIO_THEME\Inc;

use ABBRIVIO_THEME\Inc\Traits\Singleton;

class Clean
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
        // Remove trash action
        add_action('init', [$this, 'remove_trash_actions']);

        // Disable all Updates for non Admin
        if ($this->theme_options['abbrivio-disable-updates-non-admin'])
            $this->disable_all_updates_for_non_admin();

        // Remove default dashboard widgets
        if ($this->theme_options['abbrivio-remove-dashboard-widgets-non-admin'])
            add_action('wp_dashboard_setup', [$this, 'clean_dashboard_widgets'], 999);

        // Remove Thumbnail sizes
        if ($this->theme_options['abbrivio-remove-image-sizes']) {
            // Remove size attributes from thumbnail images
            add_filter('post_thumbnail_html', [$this, 'remove_thumbnail_dimensions']);
            // Remove size attributes in the editor
            add_filter('image_send_to_editor', [$this, 'remove_thumbnail_dimensions']);
            // Remove size attributes from the_content
            add_filter('the_content', [$this, 'remove_thumbnail_dimensions']);
        }

        // Disable pdf previews
        if ($this->theme_options['abbrivio-disable-pdf-previews'])
            add_filter('fallback_intermediate_image_sizes', '__return_empty_array');

        // Remove wordpress content that is generated on the wp_head hook
        if ($this->theme_options['abbrivio-remove-head-trash-actions'])
            add_action('init', [$this, 'remove_head_thrash_action']);

        // Remove emoji support
        if ($this->theme_options['abbrivio-remove-emoji-support'])
            add_action('init', [$this, 'remove_emoji_support']);

        // Disable the REST API
        if ($this->theme_options['abbrivio-disable-rest-api'])
            add_action('init', [$this, 'disable_rest_api']);

        // Clean admin bar
        add_action('wp_before_admin_bar_render', [$this, 'clean_admin_bar'], 999);

        // Remove default post thumbnail sizes
        if ($this->theme_options['abbrivio-remove-default-thumb-sizes'])
		    add_filter('intermediate_image_sizes_advanced', [$this, 'remove_default_thumb']);

        // Adding favicon to admin
        if ($this->theme_options['abbrivio-site-favicon']) {
            add_action('admin_head', function () {
                echo '<link rel="icon" href="' . $this->theme_options['abbrivio-site-favicon'] . '" type="image/x-icon">';
                echo '<link rel="shortcut icon" href="' . $this->theme_options['abbrivio-site-favicon'] . '" type="image/x-icon">';
            });
        }

        // Change admin footer text
        add_filter('admin_footer_text', function () {
            ob_start();
            ?>
            <div class="credits">
                <a target="_blank" rel="nofollow" href="https://www.stfn-dev.com/" title="stfn"><> with <span class="heart">❤</span> by stfn</a>
            </div>
            <?php
            // Output the content
            $output = ob_get_clean();
            echo $output;
        });

        // Add custom logo to admin pages
        add_action('admin_head', function() {
            ob_start();
            ?>
            <style>
                /* Admin Bar */
                #wpadminbar #wp-admin-bar-site-name > .ab-item::before {
                    background-image: url('<?php echo $this->theme_options['abbrivio-site-logo-min-dark']; ?>') !important;
                }
                /* Footer text */
                #wpfooter .credits a {
                    background-image: url('<?php echo $this->theme_options['abbrivio-site-logo-min']; ?>');
                }
            </style>
            <?php
            // Output the content
            $output = ob_get_clean();
            echo $output;
        });

        // Add custom logo to login admin page
        add_action('login_head', function() {
            ob_start();
            ?>
            <style>
                body.login div#login h1 a {
                    background-image: url('<?php echo $this->theme_options['abbrivio-site-logo']; ?>');
                }
            </style>
            <?php
            // Output the content
            $output = ob_get_clean();
            echo $output;
        });

        // Welcome panel customization
        if ($this->theme_options['abbrivio-welcome-panel-status']) {
            add_action('load-index.php', [$this, 'always_show_welcome_panel']);
            remove_action('welcome_panel', 'wp_welcome_panel');
            add_action('welcome_panel', [$this, 'custom_welcome_panel']);
        }
    }



    /**
     * Remove trash action
     */
    public function remove_trash_actions()
    {
        // Disable xmlrpc.php
        if ($this->theme_options['abbrivio-disable-xmlrpc'])
            add_filter('xmlrpc_enabled', '__return_false');

        if (!abbrivio_user_has_role('administrator')) {
            // Removes the profile.php admin color scheme options
            if ($this->theme_options['abbrivio-remove-profile-color-scheme-non-admin'])
                remove_action('admin_color_scheme_picker', 'admin_color_scheme_picker');
            // Remove screen option (Impostazioni schermata) tab
            add_filter('screen_options_show_screen', '__return_false');
            // Remove help (Aiuto) tab
            add_action('admin_head', function () {
                $screen = get_current_screen();
                $screen->remove_help_tabs();
                // Remove notice message of core update
                remove_action('admin_notices', 'update_nag', 3);
            });
        }

        if (!abbrivio_user_has_role(array('administrator', 'editor'))) {
            // Remove admin bar
            if ($this->theme_options['abbrivio-remove-admin-bar-non-admin'])
                show_admin_bar(false);
        }
    }


    
    /**
     * Disable all Updates for non Admin
     */
    public function disable_all_updates_for_non_admin()
    {
        if (!abbrivio_user_has_role('administrator')) {
            // Core update notifications
            add_filter( 'pre_site_transient_update_core', 'abbrivio_last_checked_now' );

            // Plugin update notifications
            add_filter( 'pre_site_transient_update_plugins', 'abbrivio_last_checked_now' );

            // Theme update notifications
            add_filter( 'pre_site_transient_update_themes', 'abbrivio_last_checked_now' );

            // Core translation notifications
            add_filter( 'site_transient_update_core', 'abbrivio_remove_translations' );

            // Plugin translation notifications
            add_filter( 'site_transient_update_plugins', 'abbrivio_remove_translations' );

            // Theme translation notifications
            add_filter( 'site_transient_update_themes', 'abbrivio_remove_translations' );

            // Remove admin footer version
            add_filter('update_footer', '__return_empty_string', 11);

            // Remove actions that checks for updates
            add_action(
                'admin_init',
                function () {
                    remove_action( 'wp_maybe_auto_update', 'wp_maybe_auto_update' );
                    remove_action( 'admin_init', 'wp_maybe_auto_update' );
                    remove_action( 'admin_init', 'wp_auto_update_core' );
                    wp_clear_scheduled_hook( 'wp_maybe_auto_update' );
                }
            );

            // Disable automatic core updates
            add_filter( 'automatic_updater_disabled', '__return_true' );
            add_filter( 'allow_minor_auto_core_updates', '__return_false' );
            add_filter( 'allow_major_auto_core_updates', '__return_false' );
            add_filter( 'allow_dev_auto_core_updates', '__return_false' );
            add_filter( 'auto_update_core', '__return_false' );
            add_filter( 'wp_auto_update_core', '__return_false' );
            add_filter( 'auto_core_update_send_email', '__return_false' );
            add_filter( 'send_core_update_notification_email', '__return_false' );
            add_filter( 'automatic_updates_send_debug_email', '__return_false' );
            add_filter( 'automatic_updates_is_vcs_checkout', '__return_true' );

            // Disable automatic plugin updates
            add_filter( 'auto_update_plugin', '__return_false' );

            // Disable automatic theme updates
            add_filter( 'auto_update_theme', '__return_false' );

            // Disable automatic translation updates
            add_filter( 'auto_update_translation', '__return_false' );
        }
    }



    /**
     * Remove default widget
     */
    public function clean_dashboard_widgets()
    {
        if (!abbrivio_user_has_role('administrator')) {
            // Remove the 'Welcome' panel
            remove_action('welcome_panel', 'wp_welcome_panel');
            // Remove 'Site health' metabox
            remove_meta_box('dashboard_site_health', 'dashboard', 'normal');
            // Remove the 'At a Glance' metabox
            remove_meta_box('dashboard_right_now', 'dashboard', 'normal');
            // Remove the 'Activity' metabox
            remove_meta_box('dashboard_activity', 'dashboard', 'normal');
            // Remove the 'WordPress News' metabox
            remove_meta_box('dashboard_primary', 'dashboard', 'side');
            // Remove the 'Quick Draft' metabox
            remove_meta_box('dashboard_quick_press', 'dashboard', 'side');
        }
    }



    /**
     * Remove thumbnail width and height dimensions that prevent fluid images in the_thumbnail
     */
    public function remove_thumbnail_dimensions($html)
    {
        return preg_replace( '/(width|height)="\d*"/', '', $html );
    }



    /**
     * Remove wordpress content that is generated on the wp_head hook
     */
    public function remove_head_thrash_action()
    {
        // Remove the Really Simple Discovery service link
		remove_action( 'wp_head', 'rsd_link' );

		// Remove the link to the Windows Live Writer manifest
		remove_action( 'wp_head', 'wlwmanifest_link' );

		// Remove the general feeds
		remove_action( 'wp_head', 'feed_links', 2 );

		// Remove the extra feeds, such as category feeds
		remove_action( 'wp_head', 'feed_links_extra', 3 );

		// Remove the displayed XHTML generator
		remove_action( 'wp_head', 'wp_generator' );

		// Remove the REST API link tag
		remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );

		// Remove oEmbed discovery links.
		remove_action( 'wp_head', 'wp_oembed_add_discovery_links', 10 );

		// Remove rel next/prev links
		remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 );

		// Remove prefetch url
        remove_action( 'wp_head', 'wp_resource_hints', 2 );
        
        // Remove oEmbed-specific JavaScript from the front-end and back-end
        remove_action('wp_head', 'wp_oembed_add_host_js');
    }



    /**
     * Remove emoji support
     */
    public function remove_emoji_support()
    {
		// Front-end
		remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
		remove_action( 'wp_print_styles', 'print_emoji_styles' );

		// Admin
		remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
		remove_action( 'admin_print_styles', 'print_emoji_styles' );

		// Feeds
		remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
		remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );

		// Embeds
		remove_filter( 'embed_head', 'print_emoji_detection_script' );

		// Emails
		remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );

		// Disable from TinyMCE editor. Disabled in block editor by default
		add_filter(
			'tiny_mce_plugins',
			function ( $plugins ) {
				if ( is_array( $plugins ) ) {
					$plugins = array_diff( $plugins, array( 'wpemoji' ) );
				}

				return $plugins;
			}
		);

		/**
		 * Finally, disable it from the database also, to prevent characters from converting
		 * There used to be a setting under Writings to do this
		 * Not ideal to get & update it here - but it works :/
		 */
		if ( (int) get_option( 'use_smilies' ) === 1 ) {
			update_option( 'use_smilies', 0 );
		}
    }
    

    
    /**
     * Disable REST API
     */
    public function disable_rest_api()
    {
        add_filter('rest_jsonp_enabled', '__return_false');

		remove_action('xmlrpc_rsd_apis', 'rest_output_rsd');
		remove_action('wp_head', 'rest_output_link_wp_head', 10);
		remove_action('template_redirect', 'rest_output_link_header', 11);
    }



    /**
     * Clean admin bar
     */
    public function clean_admin_bar()
    {
        global $wp_admin_bar;

        $wp_admin_bar->remove_menu('wp-logo');

        if (!abbrivio_user_has_role('administrator')) {

            $wp_admin_bar->remove_menu('user-info');
            $wp_admin_bar->remove_menu('edit-profile');
        }
    }



    /**
	 * Remove default post thumbnail sizes
	 */
	public function remove_default_thumb($sizes)
	{
		unset($sizes['thumbnail']);
		// 150px
		unset($sizes['small']);
		// 300px
		unset($sizes['medium']);
		// 1024px
		unset($sizes['large']);
		// 768px
		unset($sizes['medium_large']);

		return $sizes;
	}



    /**
     * Show always welcome panel
     */
    public function always_show_welcome_panel()
    {
        $user_id = get_current_user_id();

        if (1 != get_user_meta($user_id, 'show_welcome_panel', true))
            update_user_meta($user_id, 'show_welcome_panel', 1);
    }



    /**
     * Custom welcome panel in dashboard
     */
    public function custom_welcome_panel()
    {
        abbrivio_get_options();
        ob_start();
        ?>
        <div class="abbrivio-welcome-panel-content welcome-panel-content">
            <div class="abbrivio-welcome-panel-content__logo">
                <img src="<?php echo $this->theme_options['abbrivio-site-logo']; ?>" />
            </div>
            <div class="abbrivio-welcome-panel-content__text"><?php echo $this->theme_options['abbrivio-welcome-panel-message']; ?></div>
        </div>
        <?php
        // Output the content
		$output = ob_get_clean();
		echo $output;
    }
}
