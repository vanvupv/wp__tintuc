<?php
/**
 * cltheme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package cltheme
 */

if (!defined('_S_VERSION')) {
	// Replace the version number of the theme on each release.
	define('_S_VERSION', '1.0.0');
}

/**
 * get currernt lang.
 */
define('LANG', function_exists('pll_current_language') ? pll_current_language('slug') : 'en');

// Sets up theme defaults and registers support for various WordPress features.
function cltheme_setup()
{
	// theme support post
	load_theme_textdomain('cltheme', get_template_directory() . '/languages');
	add_theme_support('automatic-feed-links');
	add_theme_support('title-tag');
	add_theme_support('post-thumbnails');

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-primary' => esc_html__('menu primary', 'cltheme'),
			'footer-1' => esc_html__('Footer 1', 'cltheme'),
			'footer-2' => esc_html__('Footer 2', 'cltheme'),
		)
	);
}
add_action('after_setup_theme', 'cltheme_setup');

// Set the content width in pixels, based on the theme's design and stylesheet.
function cltheme_content_width()
{
	$GLOBALS['content_width'] = apply_filters('cltheme_content_width', 640);
}
add_action('after_setup_theme', 'cltheme_content_width', 0);

/**
 * Enqueue scripts and styles.
 */
function cltheme_scripts()
{
	wp_enqueue_style('cltheme-style', get_stylesheet_uri(), array(), _S_VERSION);

	// add vendor js
	wp_enqueue_script('cltheme-script-vendor', get_template_directory_uri() . '/assets/js/vendor.js', array(), _S_VERSION, true);

	// add select2
	// wp_enqueue_style('cltheme-style-select2', get_template_directory_uri() . '/assets/inc/select2/select2.css', array(), _S_VERSION);
	// wp_enqueue_script('cltheme-script-select2', get_template_directory_uri() . '/assets/inc/select2/select2.js', array(), _S_VERSION, true);

	//add custom main css/js main copy
	// wp_enqueue_style('cltheme-style-main', get_template_directory_uri() . '/assets/css/main.css', array(), _S_VERSION);	 
	wp_enqueue_script('cltheme-script-main', get_template_directory_uri() . '/assets/js/main.js', array(), _S_VERSION, true);

	//
	wp_enqueue_style('cltheme-style-main', get_template_directory_uri() . '/assets/css/main-copy.css', array(), _S_VERSION);
}
add_action('wp_enqueue_scripts', 'cltheme_scripts');

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

// Create CPT
require get_template_directory() . '/inc/cpt_custom.php';

// Security
require get_template_directory() . '/inc/security.php';

// Breadcrumbs
require get_template_directory() . '/inc/breadcrumbs.php';

// Script admin
require get_template_directory() . '/inc/script_admin.php';

// Style admin
require get_template_directory() . '/inc/style_admin.php';

// auto active plugin
require get_template_directory() . '/inc/auto_active_plugin.php';

// view post
require get_template_directory() . '/inc/view_post.php';