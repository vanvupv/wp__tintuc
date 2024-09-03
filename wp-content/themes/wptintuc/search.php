<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package cltheme
 */

get_header();
?>
<div class="bannerContact"
    style="background-image: url('<?php echo get_template_directory_uri() . '/assets/images/banner_search.png'; ?>');">
    <div class="container">
        <div class="bannerContact__inner">
            <div class="secSpace bannerContact__content">
                <h1 class="bannerContact__title">
                    <?php _e('Search', 'wplongpv'); ?>
                </h1>
                <!-- Breadcrumb Contact -->
                <div class="breadcrumbContact">
                    <?php wp_breadcrumbs(); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="typingSearch">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <form class="typingSearch__form" method="get" action="<?php echo home_url(); ?>" role="search">
                    <input type="text" aria-label="search" aria-describedby="search-addon" name="s"
                        placeholder="<?php _e('Enter keywords to search for', 'wplongpv'); ?>"
                        value="<?php echo get_search_query(); ?>">
                    <button type="submit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 21 21" fill="none">
                            <path
                                d="M9.5 17.4998C13.9183 17.4998 17.5 13.9181 17.5 9.49982C17.5 5.08154 13.9183 1.49982 9.5 1.49982C5.08172 1.49982 1.5 5.08154 1.5 9.49982C1.5 13.9181 5.08172 17.4998 9.5 17.4998Z"
                                stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M19.5004 19.5002L15.1504 15.1502" stroke="white" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="secSpace">
    <div class="container">
        <h2 id="blog__search" class="headingLineTour headingLineTour--search">
            <?php _e('News', 'wplongpv'); ?>
        </h2>
        <div class="row">
            <?php
            $paged_blog = !empty($_GET['blog_page']) ? intval($_GET['blog_page']) : 1;
            $posts = new WP_Query(
                array(
                    'post_type' => 'post',
                    'posts_per_page' => 6,
                    'paged' => $paged_blog,
                    's' => get_search_query(),
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

            <div class="pagination pagination--search" id="blog">
                <?php
                echo paginate_links(
                    array(
                        'base' => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
                        'total' => $posts->max_num_pages,
                        'current' => max(1, $paged_blog),
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

<?php
get_footer();
?>
<script>
    $(document).ready(function () {
        var url = '<?php echo home_url() . '?s=' . get_search_query(); ?>';
        $('.pagination .page-numbers').attr('href', 'javascript:void(0);');

        $('.pagination').on('click', '.page-numbers', function () {
            if ($(this).hasClass('dots')) {
                return 0;
            }
            $(this).parents('.pagination').find('.page-numbers').removeClass('current');
            $(this).addClass('current');

            let cruises_tours = parseInt($('#cruises_tours .current').text());
            let daily_tours = parseInt($('#daily_tours .current').text());
            let blog = parseInt($('#blog .current').text());
            // let idPackageTour = $(this).parents('.secSpace').find('#listTour__search').attr("id") ?? ''; 

            // headingLineTour--search
            let idPackageTour = $(this).parents('.secSpace').find('.headingLineTour--search').attr("id") ?? '';
            console.log(idPackageTour);

            window.location.href =
                url +
                "&cruises_page=" +
                cruises_tours +
                "&daily_page=" +
                daily_tours +
                "&blog_page=" +
                blog +
                "#id=" +
                idPackageTour;
        });

        var hashValue = window.location.hash;
        if (hashValue && hashValue.indexOf("#id=") === 0) {
            var idToScroll = hashValue.replace("#id=", "");

            $("html, body").animate(
                {
                    scrollTop: $("#" + idToScroll).offset().top - 100,
                },
                1000
            );
        }
    });

</script>