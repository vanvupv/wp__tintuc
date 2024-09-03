<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package cltheme
 */

?>

<?php
$newsletter = get_field('newsletter', 'option') ?? null;

if ($newsletter):
    ?>
    <section class="joinOur">
        <div class="container">
            <div class="row no-gutters align-items-center">
                <div class="col-lg-2">
                    <?php if ($newsletter['title']): ?>
                        <div class="joinOur__label">
                            <?php echo $newsletter['title']; ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="col-lg-5">
                    <div class="joinOur__form">
                        <form action="">
                            <input class="joinOur__input" type="text" placeholder="Your email address">
                            <input class="btnHover joinOur__submit" type="submit" value="Subscribe">
                        </form>

                        <?php
                        // if ($newsletter['contact_form']) {
                        //     $form = $newsletter['contact_form'];
                        //     echo do_shortcode("[contact-form-7 id=\"$form\"]");
                        // }
                        ?>
                    </div>
                </div>
                <div class="col-lg-5">
                    <?php if ($newsletter['description']): ?>
                        <div class="joinOur__desc">
                            <?php echo $newsletter['description']; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

<!-- footer -->
<?php
$contact_info = get_field('contact_info', 'option') ?? null;

if ($contact_info):
    ?>
    <footer id="footer" class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="footer__item">
                        <a href="#" class="footer__logo">
                            <img src="<?php echo get_template_directory_uri() . '/assets/images/sky-news-2-logo.png'; ?>"
                                alt="logo">
                        </a>
                        <div class="footer__contactInfo">
                            <?php if ($contact_info['intro']): ?>
                                <div class="footer__contactInfoItem footer__contactInfoItem--title">
                                    <?php echo $contact_info['intro']; ?>
                                </div>
                            <?php endif; ?>

                            <?php if ($contact_info['address']): ?>
                                <div class="footer__contactInfoItem footer__contactInfoItem--adress">
                                    <?php echo $contact_info['address']; ?>
                                </div>
                            <?php endif; ?>

                            <?php if ($contact_info['phone']): ?>
                                <a href="tel:<?php echo $contact_info['phone']; ?>"
                                    class="footer__contactInfoItem footer__contactInfoItem--phone">
                                    <?php echo $contact_info['phone']; ?>
                                </a>
                            <?php endif; ?>

                            <?php if ($contact_info['mail']): ?>
                                <a href="mailto:<?php echo $contact_info['mail']; ?>"
                                    class="footer__contactInfoItem footer__contactInfoItem--mail">
                                    <?php echo $contact_info['mail']; ?>
                                </a>
                            <?php endif; ?>

                            <?php if ($contact_info['website']): ?>
                                <a target="_blank" href="<?php echo $contact_info['website']; ?>"
                                    class="footer__contactInfoItem footer__contactInfoItem--website">
                                    <?php echo $contact_info['website']; ?>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 pl-lg-5">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="footer__item">
                                <?php if ($contact_info['title_menu_1']): ?>
                                    <div class="h4 footer__title">
                                        <?php echo $contact_info['title_menu_1']; ?>
                                    </div>
                                <?php endif; ?>

                                <?php
                                if (has_nav_menu('footer-1')) {
                                    wp_nav_menu(
                                        array(
                                            'theme_location' => 'footer-1',
                                            'container' => 'nav',
                                            'container_class' => 'footer__nav',
                                            'depth' => 1,
                                        )
                                    );
                                }
                                ?>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="footer__item">
                                <?php if ($contact_info['title_menu_2']): ?>
                                    <div class="h4 footer__title">
                                        <?php echo $contact_info['title_menu_2']; ?>
                                    </div>
                                <?php endif; ?>

                                <?php
                                if (has_nav_menu('footer-2')) {
                                    wp_nav_menu(
                                        array(
                                            'theme_location' => 'footer-2',
                                            'container' => 'nav',
                                            'container_class' => 'footer__nav',
                                            'depth' => 1,
                                        )
                                    );
                                }
                                ?>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="footer__item">
                                <?php if ($contact_info['title_menu_3']): ?>
                                    <div class="h4 footer__title">
                                        <?php echo $contact_info['title_menu_3']; ?>
                                    </div>
                                <?php endif; ?>

                                <div class="footer__social">
                                    <?php if ($contact_info['tripadvisor']): ?>
                                        <a target="_blank" href="<?php echo $contact_info['tripadvisor']; ?>"
                                            class="footer__socialItem footer__socialItem--tripadvisor"></a>
                                    <?php endif; ?>
                                    <?php if ($contact_info['messenger']): ?>
                                        <a target="_blank" href="<?php echo $contact_info['messenger']; ?>"
                                            class="footer__socialItem footer__socialItem--mess"></a>
                                    <?php endif; ?>
                                    <?php if ($contact_info['facebook']): ?>
                                        <a target="_blank" href="<?php echo $contact_info['facebook']; ?>"
                                            class="footer__socialItem footer__socialItem--fb"></a>
                                    <?php endif; ?>
                                    <?php if ($contact_info['youtube']): ?>
                                        <a target="_blank" href="<?php echo $contact_info['youtube']; ?>"
                                            class="footer__socialItem footer__socialItem--ytb"></a>
                                    <?php endif; ?>
                                    <?php if ($contact_info['twitter']): ?>
                                        <a target="_blank" href="<?php echo $contact_info['twitter']; ?>"
                                            class="footer__socialItem footer__socialItem--tw"></a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php if ($contact_info['copyright']): ?>
                <div class="footer__copyright">
                    <?php echo $contact_info['copyright']; ?>
                </div>
            <?php endif; ?>
        </div>
    </footer>
<?php endif; ?>
<!-- end footer -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>

</html>