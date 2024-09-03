<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package cltheme
 */


get_header();

// banner get_template_directory_uri
// $bg = get_field("background_image") ?? get_the_post_thumbnail_url();

$bg = get_field("background_image") ?? get_template_directory_uri() . '/assets/images/build_your_trip.png';

if ($bg): ?>
    <div class="bannerContact" style="background-image: url(<?php echo $bg; ?> )">
        <div class="container">
            <div class="bannerContact__inner">
                <div class="secSpace bannerContact__content">
                    <h1 class="bannerContact__title">
                        <?php echo "Chào Mừng Bạn Đến Trang Tin Tức"; ?>
                    </h1>
                    <!-- Breadcrumb Contact -->
                    <div class="breadcrumbContact">
                        <?php wp_breadcrumbs(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<!-- List News -->
<div class="secSpace">
    <div class="container">
        <h2 id="blog__search" class="headingLineTour headingLineTour--search">
            <?php _e('Hot News', 'wplongpv'); ?>
        </h2>
        <div class="row">
            <?php
            $paged_blog = !empty($_GET['blog_page']) ? intval($_GET['blog_page']) : 1;
            $posts = new WP_Query(
                array(
                    'post_type' => 'post',
                    'posts_per_page' => 6,
                    // 'paged' => $paged_blog,           
                    'meta_query' => array(
                        array(
                            'key' => '_thumbnail_id',
                            'compare' => 'EXISTS',
                        ),
                    ),
                )
            );
            if ($posts->have_posts()):
                while ($posts->have_posts()):
                    $posts->the_post();
                    echo '<div class="col-lg-6">';
                    get_template_part('template-parts/single/blog_item');
                    echo '</div>';
                endwhile;
                ?>
            </div>
            <?php
            else:
                echo '<div class="col-12">';
                _e('No results found', 'wplongpv');
                echo '</div>';
            endif;
            wp_reset_postdata();
            ?>
    </div>
</div>

<!-- -->
<?php
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

$blog_query = new WP_Query(
    array(
        'post_type' => 'post',
        'posts_per_page' => 4,
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
        <div class="blog mb-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <!-- Blog List -->
                        <h2 id="blog__search" class="headingLineTour headingLineTour--search">
                            <?php _e('News', 'wplongpv'); ?>
                        </h2>
                        <div class="blog__list">
                            <?php while ($blog_query->have_posts()):
                                $blog_query->the_post();
                                get_template_part('template-parts/single/blog_item');
                            endwhile; ?>
                        </div>
                        <!-- End Blog List -->
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