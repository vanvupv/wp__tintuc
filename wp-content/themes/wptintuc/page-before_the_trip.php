<?php
/**
 * Template name: Before The Trip 
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

get_template_part('template-parts/banner_blog');

$accodion_trip_item = get_field('accodion_trip_item') ?? null;
?>
<!-- Start before_the_trip-->
<div class="secSpace before_the_trip">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <?php if ($accodion_trip_item): ?>
                    <?php foreach ($accodion_trip_item as $key => $value): ?>
                        <div class="visas">
                            <?php if ($value['title']): ?>
                                <h2 class="visas__heading">
                                    <?php echo $value['title']; ?>
                                </h2>
                            <?php endif; ?>
                            <?php if ($value['accodion_trip']): ?>
                                <div class="accordionFAQs" id="accordion_<?php echo $key; ?>">
                                    <?php foreach ($value['accodion_trip'] as $index => $val): ?>
                                        <?php if ($val['title'] && $val['description']): ?>
                                            <!-- accordion Item -->
                                            <div class="accordionFAQs__item">
                                                <div id="heading_<?php echo $key; ?>_<?php echo $index; ?>" class="accordionFAQs__heading">
                                                    <button class="accordionFAQs__btn" type="button" data-toggle="collapse"
                                                        data-target="#collapse__<?php echo $key; ?>_<?php echo $index; ?>"
                                                        aria-expanded="false"
                                                        aria-controls="collapse__<?php echo $key; ?>_<?php echo $index; ?>">
                                                        <?php echo $val['title']; ?>
                                                    </button>
                                                </div>
                                                <div id="collapse__<?php echo $key; ?>_<?php echo $index; ?>" class="collapse"
                                                    aria-labelledby="heading__<?php echo $key; ?>_<?php echo $index; ?>"
                                                    data-parent="#accordion_<?php echo $key; ?>">
                                                    <div class="accordionFAQs__content editor">
                                                        <?php echo $val['description']; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                    <!-- End accordion Item -->
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
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
<!-- End before_the_trip -->

<?php
// footer template
get_footer();
?>