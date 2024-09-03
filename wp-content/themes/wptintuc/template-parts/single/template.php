<div class="postNews">
    <?php
    $link = ['url' => get_the_permalink(), 'target' => '', 'title' => get_the_title()];
    echo custom_img_link($link, get_the_post_thumbnail_url());
    ?>

    <h3 class="h5 postNews__title">
        <a href="<?php the_permalink(); ?>" class="postNews__link line-2">
            <?php the_title(); ?>
        </a>
    </h3>
</div>