<?php
/**
 * Template name: Blog                           
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

get_template_part('template-parts/banner_blog');

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

$blog_query = new WP_Query(
    array(
        'post_type' => 'post',
        'posts_per_page' => 8,
        'paged' => $paged,
        'meta_query' => array(
            array(
                'key' => '_thumbnail_id',
                'compare' => 'EXISTS',
            ),
        ),
    )
);

if ($blog_query->have_posts()): ?>
    <section>
        <div class="blog space">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <!-- Blog List -->
                        <div class="blog__list">
                            <?php while ($blog_query->have_posts()):
                                $blog_query->the_post();
                                get_template_part('template-parts/single/blog_item');
                            endwhile; ?>
                        </div>
                        <!-- End Blog List -->
                        <!-- Pani -->
                        <div class="pagination">
                            <?php
                            echo paginate_links(
                                array(
                                    'base' => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
                                    'total' => $blog_query->max_num_pages,
                                    'current' => max(1, get_query_var('paged')),
                                    'format' => '?paged=%#%',
                                    'show_all' => false,
                                    'type' => 'plain',
                                    'end_size' => 2,
                                    'mid_size' => 1,
                                    'prev_next' => true,
                                    'prev_text' => '',
                                    'next_text' => '',
                                    'add_args' => false,
                                    'add_fragment' => '',
                                )
                            );
                            ?>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <!-- Catory -->
                        <?php get_template_part('template-parts/sidebar/category'); ?>
                        <!-- End Catory -->
                        <!-- Featured tour -->
                        <?php get_template_part('template-parts/sidebar/featured_tour'); ?>
                        <!-- End Featured tour -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php
endif;
wp_reset_postdata();
?>

<?php
get_footer();
?>