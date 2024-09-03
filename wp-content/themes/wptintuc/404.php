<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package cltheme
 */

get_header();
?>

<section class="space page404">
    <div class="container">
        <div class=" editor">
            <h2 style="text-align:center;font-weight:bold;color:#C72127;font-size:80px;line-height:1;">
                <?php _e('404', 'cltheme'); ?>
            </h2>
            <p style="text-align:center;">
                <?php _e('Page not found', 'cltheme'); ?>
            </p>
        </div>
    </div>
</section>

<?php
get_footer();