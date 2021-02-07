<?php

/**
 * Theme Functions
 *
 * @package Abbrivio
 */

if (!defined('ABBRIVIO_DIR_PATH')) {
	define('ABBRIVIO_DIR_PATH', untrailingslashit(get_template_directory()));
}

if (!defined('ABBRIVIO_DIR_URI')) {
	define('ABBRIVIO_DIR_URI', untrailingslashit(get_template_directory_uri()));
}

if (!defined('ABBRIVIO_BUILD_URI')) {
	define('ABBRIVIO_BUILD_URI', untrailingslashit(get_template_directory_uri()) . '/assets/build');
}

if (!defined('ABBRIVIO_BUILD_PATH')) {
	define('ABBRIVIO_BUILD_PATH', untrailingslashit(get_template_directory()) . '/assets/build');
}

if (!defined('ABBRIVIO_BUILD_JS_URI')) {
	define('ABBRIVIO_BUILD_JS_URI', untrailingslashit(get_template_directory_uri()) . '/assets/build/js');
}

if (!defined('ABBRIVIO_BUILD_JS_DIR_PATH')) {
	define('ABBRIVIO_BUILD_JS_DIR_PATH', untrailingslashit(get_template_directory()) . '/assets/build/js');
}

if (!defined('ABBRIVIO_BUILD_IMG_URI')) {
	define('ABBRIVIO_BUILD_IMG_URI', untrailingslashit(get_template_directory_uri()) . '/assets/build/src/img');
}

if (!defined('ABBRIVIO_BUILD_CSS_URI')) {
	define('ABBRIVIO_BUILD_CSS_URI', untrailingslashit(get_template_directory_uri()) . '/assets/build/css');
}

if (!defined('ABBRIVIO_BUILD_CSS_DIR_PATH')) {
	define('ABBRIVIO_BUILD_CSS_DIR_PATH', untrailingslashit(get_template_directory()) . '/assets/build/css');
}

if (!defined('ABBRIVIO_BUILD_LIB_URI')) {
	define('ABBRIVIO_BUILD_LIB_URI', untrailingslashit(get_template_directory_uri()) . '/assets/build/library');
}

require_once ABBRIVIO_DIR_PATH . '/inc/helpers/autoloader.php';
require_once ABBRIVIO_DIR_PATH . '/inc/helpers/utility.php';
require_once ABBRIVIO_DIR_PATH . '/inc/helpers/template-tags.php';

if (!class_exists('RationalOptionPages')) {
	require_once ABBRIVIO_DIR_PATH . '/inc/helpers/class-RationalOptionPages.php';
}

function abbrivio_get_theme_instance()
{
	\ABBRIVIO_THEME\Inc\ABBRIVIO_THEME::get_instance();
}

abbrivio_get_theme_instance();
