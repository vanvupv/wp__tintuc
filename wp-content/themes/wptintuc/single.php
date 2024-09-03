<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package cltheme
 */

get_header();

// $post_id = get_the_ID();
// $post_type = get_post_type($post_id);

get_template_part('template-parts/content-blog');

get_footer();