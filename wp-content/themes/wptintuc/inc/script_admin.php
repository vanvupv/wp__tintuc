<?php
add_action('admin_footer', 'custom_script_admin');
function custom_script_admin()
{
    global $post_type;
    ?>
    <!-- Validate post title -->
    <script>
        jQuery(document).ready(function ($) {
            if ($('#post').length > 0) {
                $('#post').submit(function () {
                    var title_post = $('#title').val();
                    if (title_post.trim() === '') {
                        alert('Please enter "Title".');
                        $('#title').focus();
                        return false;
                    }
                });
            }
        });
    </script>
    <?php
    // required to enter featured images
    if ($post_type == 'post'):
        ?>
        <script>
            jQuery(document).ready(function ($) {
                $('label[for="postimagediv-hide"]').remove();
                $('#post').submit(function () {
                    if ($('#set-post-thumbnail img').length == 0) {
                        let postimagediv = $('#postimagediv');
                        $('html, body').animate({
                            scrollTop: postimagediv.offset().top - 100
                        }, 500);
                        alert('Please enter "Featured image".');
                        return false;
                    }
                });
            });
        </script>
        <?php
    endif;

    // The function requires entering a category for the article
    if ($post_type == 'post'):
        ?>
        <script type="text/javascript">
            jQuery(document).ready(function ($) {
                $('label[for="categorydiv-hide"]').remove();
                $('#post').submit(function () {
                    if ($('#categorychecklist input[type="checkbox"]:checked').length === 0) {
                        alert('Please enter "Category".');
                        $('html, body').animate({
                            scrollTop: $('#categorydiv').offset().top - 100
                        }, 'slow');
                        return false;
                    }
                });

                <?php
                // Remove automatic checking on default category
                if (isset($_GET['post']) && $_GET['post'] == 0):
                    ?>
                    $('#categorychecklist input[type="checkbox"]').prop('checked', false);
                    <?php
                endif;
                ?>
            });
        </script>
        <?php
    endif;

    // Prevent users from using weak passwords
    ?>
    <script>
        jQuery(document).ready(function ($) {
            $(".pw-weak").remove();
        });
    </script>
    <?php
}