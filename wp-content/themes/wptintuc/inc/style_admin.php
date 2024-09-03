<?php
add_action('admin_footer', 'custom_style_admin', 99);
function custom_style_admin()
{
    ?>
    <style>
        /* Hide Post's default sticky function */
        .inline-edit-group.wp-clearfix>.alignleft>input[name="sticky"],
        .inline-edit-group.wp-clearfix>.alignleft>input[name="sticky"]~.checkbox-title {
            display: none !important;
        }

        /* Hide the page's comment function */
        .inline-edit-group.wp-clearfix>.alignleft>input[name="comment_status"],
        .inline-edit-group.wp-clearfix>.alignleft>input[name="comment_status"]~.checkbox-title {
            display: none !important;
        }

        /* Dashboard wp cerber */
        .cerber-msg.crb-announcement.crb-cerber-logo-big,
        #crb-aside {
            display: none !important;
        }
    </style>
    <?php
}