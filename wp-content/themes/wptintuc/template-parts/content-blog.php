<!--  -->
<?php
// Kiểm tra xem có phải trang bài viết không

// Lấy ID của bài viết hiện tại
$post_id = get_the_ID();

//  
$arrPost = [];
array_push($arrPost, $post_id);

// Lấy tiêu đề của bài viết
$post_title = get_the_title($post_id);

// Lấy đường dẫn (slug) của bài viết
$post_slug = basename(get_permalink($post_id));

// Lấy Nội dung bài viết 
$post_content = get_the_content($post_id);

// Lấy ngày đăng của bài viết
$post_date = get_the_date('Y-m-d', $post_id);

get_template_part('template-parts/banner_blog');
?>

<!--  -->
<!-- Start Content  -->
<div class="secSpace contentBlog">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="blogdetail">
                    <!-- Title -->
                    <h1 class="h2 blogdetail__headingLine blogdetail__heading">
                        <?php the_title(); ?>
                    </h1>
                    <!-- End Title -->

                    <!-- Info -->
                    <div class="blogdetail__info">
                        <div class="blogdetail__infoDate">
                            <span><svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M8 2V5" stroke="#0076C0" stroke-width="1.5" stroke-miterlimit="10"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M16 2V5" stroke="#0076C0" stroke-width="1.5" stroke-miterlimit="10"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M3.5 9.08997H20.5" stroke="#0076C0" stroke-width="1.5"
                                        stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round" />
                                    <path
                                        d="M21 8.5V17C21 20 19.5 22 16 22H8C4.5 22 3 20 3 17V8.5C3 5.5 4.5 3.5 8 3.5H16C19.5 3.5 21 5.5 21 8.5Z"
                                        stroke="#0076C0" stroke-width="1.5" stroke-miterlimit="10"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M11.9955 13.7H12.0045" stroke="#0076C0" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M8.29431 13.7H8.30329" stroke="#0076C0" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M8.29431 16.7H8.30329" stroke="#0076C0" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </span>
                            <?php if ($post_date): ?>
                                <div class="blogdetail__infoText">
                                    <?php echo $post_date; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="blogdetail__infoFb">
                            <div class="blogdetail__infoText">Chia sẻ</div>
                            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>"
                                onclick="window.open(this.href, this.target, 'width=300,height=400'); return false;"
                                class="style_img icon facebook">
                                <span><svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_87_14860)">
                                            <path
                                                d="M24 12C24 17.9897 19.6116 22.9542 13.875 23.8542V15.4688H16.6711L17.2031 12H13.875V9.74906C13.875 8.79984 14.34 7.875 15.8306 7.875H17.3438V4.92188C17.3438 4.92188 15.9703 4.6875 14.6573 4.6875C11.9166 4.6875 10.125 6.34875 10.125 9.35625V12H7.07812V15.4688H10.125V23.8542C4.38844 22.9542 0 17.9897 0 12C0 5.37281 5.37281 0 12 0C18.6272 0 24 5.37281 24 12Z"
                                                fill="#1877F2" />
                                            <path
                                                d="M16.6711 15.4688L17.2031 12H13.875V9.74902C13.875 8.80003 14.3399 7.875 15.8306 7.875H17.3438V4.92188C17.3438 4.92188 15.9705 4.6875 14.6576 4.6875C11.9165 4.6875 10.125 6.34875 10.125 9.35625V12H7.07812V15.4688H10.125V23.8542C10.736 23.95 11.3621 24 12 24C12.6379 24 13.264 23.95 13.875 23.8542V15.4688H16.6711Z"
                                                fill="white" />
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_87_14860">
                                                <rect width="24" height="24" fill="white" />
                                            </clipPath>
                                        </defs>
                                    </svg>
                                </span>
                            </a>
                        </div>
                    </div>
                    <!-- End Info -->

                    <!-- Content -->
                    <?php if ($post_content): ?>
                        <div class="blogdetail__content editor">
                            <?php echo $post_content; ?>
                        </div>
                    <?php endif; ?>
                    <!-- End Content -->
                </div>
            </div>
            <div class="mt-4 mt-lg-0 col-lg-4">
                <?php
                // hotnews
                get_template_part('template-parts/sidebar/hot_new');
                // category   
                get_template_part('template-parts/sidebar/category');
                ?>
            </div>
        </div>
    </div>
</div>
<!--  -->

<?php
$posts = new WP_Query(
    array(
        'post_type' => 'post',
        'posts_per_page' => 12,
        'order' => 'DESC',
        'post__not_in' => [get_the_ID()],
    )
);

if ($posts->have_posts()):
    ?>
    <div class="secSpace relatedBlog">
        <div class="container">
            <div class="relatedBlog__inner">
                <div class="row relatedBlog__row">
                    <div class="col-lg-8">
                        <div class="relatedBlog__heading">
                            <h2 class="secTitle relatedBlog__title">
                                <?php _e('RELATED ARTICLES', 'wplongpv'); ?>
                            </h2>
                        </div>
                    </div>
                </div>

                <div class="relatedBlog__list">
                    <?php while ($posts->have_posts()):
                        $posts->the_post();
                        get_template_part('template-parts/single/blog_item');
                    endwhile;
                    ?>
                </div>
            </div>
        </div>
    </div>
    <?php
endif;
wp_reset_postdata();
?>
<!--  -->