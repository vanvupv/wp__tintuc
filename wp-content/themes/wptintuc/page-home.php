<?php
/**
 * Template name: Trang chủ
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
?>

<?php
$featured_article = get_field('featured_article', 'option');
if (!empty($featured_article) && $featured_article[0]):
    ?>
    <section class="secSpace homePage__top">
        <div class="homePage__topSlider">
            <?php
            foreach ($featured_article as $post):
                setup_postdata($post);
                ?>
                <div>
                    <?php get_template_part('template-parts/single/post'); ?>
                </div>
                <?php
                wp_reset_postdata();
            endforeach;
            ?>
        </div>
    </section>
    <?php
endif;
?>

<?php
$args_top_cat = array(
    'taxonomy' => 'category',
    'orderby' => 'count',
    'order' => 'DESC',
);
$top_cat = get_terms($args_top_cat);

if (!empty($top_cat)):
    ?>
    <section class="secSpace homePage__cats bg-light">
        <div class="container">
            <div class="secHeading">
                <h2 class="secHeading__title">
                    Danh mục
                </h2>
                <a class="secHeading__link" href="<?php echo home_url('/danh-sach-bai-viet'); ?>">Xem thêm</a>
            </div>
            <div class="row">
                <?php
                foreach ($top_cat as $category):
                    ?>
                    <div class="col-12">
                        <h3 class="h5 homePage__catsLink">
                            <a href="<?php echo get_category_link($category->term_id) ?>">
                                <?php echo $category->name . ' (' . $category->count . ')'; ?>
                            </a>
                        </h3>
                    </div>
                    <?php
                endforeach;
                ?>
            </div>
        </div>
    </section>
    <?php
endif;
wp_reset_query();
?>

<?php
$args_latest_posts = array(
    'post_type' => 'post',
    'posts_per_page' => '6',
    'meta_query' => array(
        array(
            'key' => '_thumbnail_id',
            'compare' => 'EXISTS',
        ),
    ),
);
$latest_posts = new WP_Query($args_latest_posts);
if ($latest_posts->have_posts()):
    ?>
    <section class="secSpace homePage__latest">
        <div class="container">
            <div class="secHeading">
                <h2 class="secHeading__title">
                    Bài viết mới nhất
                </h2>
                <a class="secHeading__link" href="<?php echo home_url('/danh-sach-bai-viet'); ?>">Xem thêm</a>
            </div>
            <div class="row">
                <?php
                while ($latest_posts->have_posts()):
                    $latest_posts->the_post();
                    ?>
                    <div class="col-md-6 col-lg-4 mb-3">
                        <?php get_template_part('template-parts/single/post'); ?>
                    </div>
                    <?php
                endwhile;
                ?>
            </div>
        </div>
    </section>
    <?php
endif;
wp_reset_postdata();
?>

<?php
$args_view_top = array(
    'post_type' => 'post',
    'posts_per_page' => 3,
    'order' => 'DESC',
    'meta_key' => 'post_views_count',
    'orderby' => 'meta_value_num',
    'meta_query' => array(
        array(
            'key' => '_thumbnail_id',
            'compare' => 'EXISTS',
        ),
    ),
);
$view_top = new WP_Query($args_view_top);
if ($view_top->have_posts()):
    ?>
    <section class="secSpace homePage__view bg-light">
        <div class="container">
            <div class="secHeading">
                <h2 class="secHeading__title">
                    Xem nhiều nhất
                </h2>
                <a class="secHeading__link" href="<?php echo home_url('/danh-sach-bai-viet'); ?>">Xem thêm</a>
            </div>
            <div class="row">
                <?php
                while ($view_top->have_posts()):
                    $view_top->the_post();
                    ?>
                    <div class="col-md-6 col-lg-4 mb-3">
                        <?php get_template_part('template-parts/single/post'); ?>
                    </div>
                    <?php
                endwhile;
                ?>
            </div>
        </div>
    </section>
    <?php
endif;
wp_reset_postdata();
?>

<?php
// footer template
get_footer();