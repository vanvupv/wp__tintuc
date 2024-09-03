<?php
/**
 * Template name: Contact Us     
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

//           
get_template_part('template-parts/banner_blog');

// header       
$title = get_field('title') ?? null;
$desc = get_field('description') ?? null;
$image = get_field('image') ?? null;

// list_contact
$list_contact = get_field('list_contact') ?? null;
$list_qr = get_field('list_social_qr') ?? null;
?>

<main id="primary" class="site-main">
    <!-- Header -->
    <?php if ($title): ?>
        <div class="newDayUs mt-5">
            <div class="container">
                <div class="row">
                    <?php if ($image): ?>
                        <div class="col-lg-3">
                            <div class="newDayUs__borderImg">
                                <img width="300" height="300" src="<?php echo $image; ?>" alt="<?php echo $title; ?>">
                            </div>
                        </div>
                    <?php endif; ?>

                    <div class="col-lg-9">
                        <div class="newDayUs__contentNewDay">
                            <h2 class="newDayUs__headingNewDay">
                                <?php echo $title; ?>
                            </h2>
                            <div class="col-lg-12 p-0">
                                <?php if ($desc): ?>
                                    <div class="newDayUs__descNewDay">
                                        <?php echo $desc; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif ?>
    <!-- / Header -->
    <!-- Contact -->
    <div class="infoContact">
        <div class="container">
            <div class="row infoContact__row">
                <?php foreach ($list_contact as $item): ?>
                    <?php if ($item['title'] && $item['icon']): ?>
                        <div class="col-md-6 col-lg-3">
                            <div class="infoContact__infoItem">
                                <div class="infoContact__boderIcon">
                                    <img src="<?php echo $item['icon']; ?>" alt="<?php echo $item['title'] ?>">
                                </div>
                                <div class="infoContact__title">
                                    <?php echo $item['title'] ?>
                                </div>
                                <?php if ($item['detail']): ?>
                                    <div class="infoContact__desc">
                                        <?php echo $item['detail'] ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endforeach ?>
            </div>
        </div>
    </div>
    <!-- / Contact -->

    <!-- QR -->
    <?php
    if ($list_qr): ?>
        <div class="qrContact">
            <div class="container">
                <div class="row qrContact__row">
                    <?php foreach ($list_qr as $item): ?>
                        <?php if ($item): ?>
                            <div class="col-md-6 col-lg-4">
                                <div class="qrContact__qrItem">
                                    <h4 class="qrContact__qrTitle">
                                        <?php echo $item['title']; ?>
                                    </h4>
                                    <div class="qrContact__qrImg">
                                        <img src="<?php echo $item['image_qr']; ?>" alt="<?php echo $item['title']; ?>">
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    <?php endif ?>
    <!-- / QR -->

    <!-- Free Consultation -->
    <?php
    $callme = get_field('free_consultation') ?? null;

    $title = $callme['title'] ?? null;
    $phone = $callme['phone'] ?? null;
    $background = $callme['background'] ?? null;

    if ($background): ?>
        <div class="freeconsultation" style="background-image: url('<?php echo $background; ?>');">
            <div class="freeconsultation__inner" data-mh="freeconsultation">
                <div class="container">
                    <div class="row no-gutters freeconsultation__item">
                        <div class="col-12 col-md-10 col-lg-6">
                            <?php if ($title): ?>
                                <div class="freeconsultation__heading">
                                    <h2 class="h1 freeconsultation__headingText m-0">
                                        <?php echo $title; ?>
                                    </h2>
                                </div>
                            <?php endif; ?>
                            <?php if ($phone): ?>
                                <div class="freeconsultation__desc">
                                    <?php echo $phone; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <!-- / Free Consultation -->

    <!-- Form Contact Us -->
    <?php
    $contact_form = get_field('contact_form') ?? null;
    $titleForm = $contact_form['title'] ?? null;
    $subtitle = $contact_form['subtitle'] ?? null;
    $descForm = $contact_form['description'] ?? null;
    $contact = $contact_form['contact_form'] ?? null;
    ?>
    <div class="contactForm mt-5 mb-5">
        <div class="container">
            <div class="contactForm__heading">
                <div class="row">
                    <?php if ($subtitle): ?>
                        <div class="col-lg-6 contactForm__headingCol">
                            <span class="contactForm__subtitle">
                                <?php echo $subtitle; ?>
                            </span>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="row">
                    <div class=" col-lg-6 contactForm__headingCol">
                        <?php if ($titleForm): ?>
                            <h2 class="contactForm__title">
                                <?php echo $titleForm; ?>
                            </h2>
                        <?php endif; ?>
                    </div>
                    <?php if ($descForm): ?>
                        <div class="col-lg-6">
                            <?php echo $descForm; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <!-- form contact -->
            <?php ?>
            <div class="contactForm__inner mt-5">
                <?php
                echo do_shortcode("[contact-form-7 id=\"$contact\" html_class=\"formGroup\" novalidate]");
                ?>
            </div>
            <!-- Contact Info -->

        </div>
    </div>
    <!-- / Form Contact Us -->

</main><!-- #main -->

<?php
get_footer();