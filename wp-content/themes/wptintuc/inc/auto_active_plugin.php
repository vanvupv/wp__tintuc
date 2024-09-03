<?php
function activate_my_plugins()
{
    $plugins = [
        'advanced-custom-fields-pro\acf.php',
        'classic-editor\classic-editor.php',
        'duplicator\duplicator.php',
        'duplicate-post\duplicate-post.php',
        'wordpress-seo\wp-seo.php',
        'wp-cerber\wp-cerber.php',
    ];

    foreach ($plugins as $plugin) {
        $plugin_path = WP_PLUGIN_DIR . '/' . $plugin;

        if (file_exists($plugin_path) && !is_plugin_active($plugin)) {
            activate_plugin($plugin);
        }
    }
}
add_action('admin_init', 'activate_my_plugins');

// stop upgrading wp cerber plugin
add_filter('site_transient_update_plugins', 'disable_plugins_update');
function disable_plugins_update($value)
{
    // disable acf pro
    if (isset($value->response['advanced-custom-fields-pro/acf.php'])) {
        unset($value->response['advanced-custom-fields-pro/acf.php']);
    }
    // disable wp cerber
    if (isset($value->response['wp-cerber/wp-cerber.php'])) {
        unset($value->response['wp-cerber/wp-cerber.php']);
    }
    return $value;
}