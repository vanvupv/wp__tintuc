<?php
/**
 * Template name: How To Book 
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

// banner
get_template_part('template-parts/banner_blog');

// 
$title = get_field('title') ?? null;
$description = get_field('description') ?? null;
$content = get_field('how_to_book_content') ?? null;
?>

<!-- Start How To Book -->
<div class="secSpace how_to_book">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mb-4 mb-lg-0">
                <!-- Content -->
                <?php if ($title): ?>
                    <div class="howtoBook">
                        <div class="row howtoBook__row">
                            <div class="col-lg-5 howtoBook__col">
                                <h2 class="howtoBook__heading">
                                    <?php echo $title; ?>
                                </h2>
                            </div>
                            <?php if ($description): ?>
                                <div class="col-lg-7 howtoBook__col">
                                    <div class="howtoBook__desc">
                                        <?php echo $description; ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- content -->
                <div class="howtoBook__content editor">
                    <?php foreach ($content as $item): ?>
                        <div class="howtoBook__item">
                            <h4> <?php echo $item['title'] ?> </h4>
                            <div class="howtoBook__content--item">
                                <?php echo $item['description'] ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <!-- End Content -->
            </div>
            <div class="col-lg-4">
                <?php
                // Online Support Sidebar    
                get_template_part('template-parts/sidebar/online_support');
                // Our Tour Sidebar
                get_template_part('template-parts/sidebar/our_tour');
                ?>
            </div>
        </div>
    </div>
</div>
<!-- End How To Book -->
<?php
// footer template
get_footer();
?>