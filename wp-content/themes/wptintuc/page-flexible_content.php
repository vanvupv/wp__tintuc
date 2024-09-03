<?php
/**
 * Template name: Page template
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package cltheme
 */

// header template
get_header();
// flexible content
get_template_part('template-parts/content-flexible');
// footer template
get_footer();