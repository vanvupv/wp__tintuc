<?php
$bg = get_field("background_image") ?? get_the_post_thumbnail_url();

if ($bg): ?>
    <div class="bannerContact" style="background-image: url(<?php echo $bg; ?> )">
        <div class="container">
            <div class="bannerContact__inner">
                <div class="secSpace bannerContact__content">
                    <h1 class="bannerContact__title">
                        <?php the_title(); ?>
                    </h1>
                    <!-- Breadcrumb Contact -->
                    <div class="breadcrumbContact">
                        <?php wp_breadcrumbs(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif;
