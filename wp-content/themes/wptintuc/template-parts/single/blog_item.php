<div class="blogItem">
    <div class="row no-gutters align-items-center">
        <div class="col-lg-5">
            <a href="<?php the_permalink(); ?>" class="blogItem__img" data-mh="size_anh">
                <img width="300" height="300" src="<?php echo get_the_post_thumbnail_url(); ?>"
                    alt="<?php the_title(); ?>">
            </a>
        </div>
        <div class="col-lg-7">
            <div class="blogItem__content" data-mh="size_anh">
                <h3 class="h4 blogItem__title line-2">
                    <a href="<?php the_permalink(); ?>" class="linkHover">
                        <?php the_title(); ?>
                    </a>
                </h3>
                <div class="blogItem__info">
                    <div class="blogItem__infoItem blogItem__infoItem--time">
                        <span>
                            <?php echo get_the_date('d/m/Y'); ?>
                        </span>
                    </div>
                    <div class="blogItem__infoItem blogItem__infoItem--auth">
                        <span>
                            <?php the_author(); ?>
                        </span>
                    </div>
                </div>
                <div class="blogItem__desc line-2">
                    <?php the_excerpt(); ?>
                </div>
                <a href="<?php the_permalink(); ?>" class="btnViewDetail blogItem__btn">
                    <?php _e('View detail', 'wplongpv'); ?>
                </a>
            </div>
        </div>
    </div>
</div>