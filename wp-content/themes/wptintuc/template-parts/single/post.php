<?php
$post_id = get_the_ID();
$thumbnail_id = get_post_thumbnail_id($post_id);
$medium_url = wp_get_attachment_image_src($thumbnail_id, 'medium');
$large_url = wp_get_attachment_image_src($thumbnail_id, 'large');
$categories = get_the_category($post_id);
?>
<article id="post-<?php echo $post_id; ?>" class="singlePost">
    <div class="imgGroup">
        <picture>
            <source media="(min-width:768px)" srcset="<?php echo $large_url[0]; ?>">
            <img src="<?php echo $medium_url[0]; ?>" alt="<?php the_title(); ?>">
        </picture>

        <a class="singlePost__link" href="<?php the_permalink(); ?>"></a>

        <?php
        if (!empty($categories)):
            $first_category = $categories[0];
            ?>
            <a href="<?php echo get_category_link($first_category->term_id) ?>" class="singlePost__cat">
                <?php echo $first_category->name; ?>
            </a>
            <?php
        endif;
        ?>
    </div>
    <div class="singlePost__content">
        <div class="singlePost__date mb-2">
            <?php echo get_the_date('d/m/Y'); ?>
        </div>
        <h3 class="h4 singlePost__title mb-3" data-mh="title">
            <a class="line-2" href="<?php the_permalink(); ?>">
                <?php the_title(); ?>
            </a>
        </h3>
        <p class="singlePost__desc line-3 mb-0">
            <?php echo get_the_excerpt(); ?>
        </p>
    </div>
</article>