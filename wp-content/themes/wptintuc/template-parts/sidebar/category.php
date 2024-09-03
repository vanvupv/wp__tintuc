<?php
$categories = get_categories(
    array(
        'orderby' => 'count',
        'order' => 'DESC',
        'hide_empty' => 0,
        'number' => 4
    )
);

if ($categories):
    ?>
    <div class="blogCat">
        <div class="h4 headingLine blogCat__heading">
            <?php _e('Categories', 'wplongpv'); ?>
        </div>
        <div class="blogCat__list">
            <?php
            foreach ($categories as $category):
                ?>
                <a href="<?php echo get_category_link($category->term_id); ?>" class="h4 linkHover blogCat__item">
                    <?php echo $category->name; ?>
                </a>
                <?php
            endforeach;
            ?>
        </div>
    </div>
    <?php
endif;
wp_reset_postdata();
?>
<!--  -->