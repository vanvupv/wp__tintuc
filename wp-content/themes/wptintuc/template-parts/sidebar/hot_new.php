<?php
$tour_query = new WP_Query(
    array(
        'post_type' => 'post',
        'posts_per_page' => 3,
        'meta_query' => array(
            array(
                'key' => '_thumbnail_id',
                'compare' => 'EXISTS',
            ),
        ),
    )
);

if ($tour_query->have_posts()):
    ?>
    <div class="hotNewsBlock">
        <div class="h4 hotNew__headingLine hotNew__heading">
            <?php _e('Hot News', 'wplongpv'); ?>
        </div>
        <div class="hotNew__list">
            <?php
            while ($tour_query->have_posts()):
                $tour_query->the_post(); ?>
                <div class="hotNew__item">
                    <div class="row no-gutters hotNew__block">
                        <div class="col-lg-4">
                            <a href="<?php the_permalink(); ?>" class="hotNew__img" data-mh="size_anh">
                                <img width="300" height="300" src="<?php echo get_the_post_thumbnail_url(); ?>"
                                    alt="<?php the_title(); ?>">
                            </a>
                        </div>
                        <div class="col-lg-8">
                            <div class="hotNew__content" data-mh="size_anh">
                                <h5 class=" hotNew__title line-2">
                                    <a href="<?php the_permalink(); ?>" class="linkHover">
                                        <?php the_title(); ?>
                                    </a>
                                </h5>
                                <div class="hotNew__info">
                                    <div class="hotNew__infoItem hotNew__infoItem--time">
                                        <span>
                                            <?php echo get_the_date('d/m/Y'); ?>
                                        </span>
                                    </div>
                                    <div class="hotNew__infoItem hotNew__infoItem--auth">
                                        <span>
                                            <?php the_author(); ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
<?php endif;
wp_reset_postdata();
?>