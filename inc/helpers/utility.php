<?php

/**
 * Custom functions utilities for the theme
 *
 * @package Abbrivio
 */



/**
 * Get Theme options array
 */
function abbrivio_get_options()
{
    $options = get_option('abbrivio-theme-options', [
        // General
        'abbrivio-site-logo' => ABBRIVIO_BUILD_IMG_URI . '/logo.svg',
        'abbrivio-site-logo-dark' => null,
        'abbrivio-site-logo-min' => ABBRIVIO_BUILD_IMG_URI . '/logo-min.svg',
        'abbrivio-site-logo-min-dark' => ABBRIVIO_BUILD_IMG_URI . '/logo-min-dark.svg',
        'abbrivio-site-favicon' => ABBRIVIO_BUILD_IMG_URI . '/favicon.ico',
        'abbrivio-web-app-status-bar-style' => '#FFFFFF',
        'abbrivio-google-analytics-script' => null,
        'abbrivio-facebook-pixel-script' => null,
        'abbrivio-disable-automatic-scroll-restoration' => null,
        'abbrivio-show-author-meta-box-for' => array('post'),
        // WP Queries
        'abbrivio-posts-per-page-blog' => 12,
        'abbrivio-posts-per-page-archive' => 12,
        'abbrivio-posts-per-page-tag' => 12,
        'abbrivio-posts-per-page-search' => 12,
        // WP Admin Customization
        'abbrivio-welcome-panel-status' => true,
        'abbrivio-welcome-panel-message' => '<h2>' . __('Welcome to Abbrivio!', 'abbrivio') . '</h2><p class="about-description">' . __('From this area you can manage the contents of the website.', 'abbrivio') . '</p>',
        // WP Clean
        'abbrivio-disable-updates-non-admin' => true,
        'abbrivio-remove-head-trash-actions' => true,
        'abbrivio-remove-emoji-support' => true,
        'abbrivio-disable-rest-api' => false,
        'abbrivio-disable-xmlrpc' => false,
        'abbrivio-remove-dashboard-widgets-non-admin' => false,
        'abbrivio-remove-image-sizes' => true,
        'abbrivio-disable-pdf-previews' => true,
        'abbrivio-remove-profile-color-scheme-non-admin' => false,
        'abbrivio-remove-admin-bar-non-admin' => true,
        'abbrivio-restrict-media-access-non-admin-editor' => true,
        'abbrivio-remove-default-thumb-sizes' => false,
    ]);

    return $options;
}



/**
 * Check if current user has role
 */
function abbrivio_user_has_role($role)
{
    $user = get_userdata(get_current_user_id());

    if (!$user || !$user->roles) {
        return false;
    }

    if (is_array($role)) {
        return array_intersect($role, (array)$user->roles) ? true : false;
    }

    return in_array($role, (array)$user->roles);
}



/**
 * Get unique ID
 */
function abbrivio_get_unique_id($prefix = '')
{
    static $id_counter = 0;

    if (function_exists('wp_unique_id'))
        return wp_unique_id($prefix);

    return $prefix . (string) ++$id_counter;
}



/**
 * Get last version checked
 */
function abbrivio_last_checked_now()
{
    include ABSPATH . WPINC . '/version.php';
    $current = new \stdClass();
    $current->updates = array();
    $current->version_checked = $wp_version;
    $current->last_checked = time();

    return $current;
}



/**
 * Remove translation
 */
function abbrivio_remove_translations($transient)
{
    if (is_object($transient) && isset($transient->translations)) {
        $transient->translations = array();
    }

    return $transient;
}



/**
 * Return image url size requested
 */
function abbrivio_get_attachment($attachment_id, $size = 'abbrivio-medium')
{
    if (empty($attachment_id))
        return;

    $attachment_src = wp_get_attachment_image_src($attachment_id, $size);

    return $attachment_src[0];
}
