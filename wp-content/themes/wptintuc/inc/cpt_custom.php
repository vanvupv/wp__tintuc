<?php
function register_cpt_post_types()
{
    $cpt_list = [
        'event' => [
            'labels' => __('Event', 'cltheme'),
            'cap' => false,
            'hierarchical' => false
        ],
    ];

    $cpt_tax = [
        'event_category' => [
            'labels' => __('Event category', 'cltheme'),
            'cap' => false,
            'post_type' => ['event']
        ],
    ];

    // foreach ($cpt_list as $post_type => $data) {
    //     register_cpt($post_type, $data);
    // }

    // foreach ($cpt_tax as $ctx => $data) {
    //     register_ctx($ctx, $data);
    // }
}
add_action('init', 'register_cpt_post_types');

function register_cpt($post_type, $data = [])
{
    $hierarchical = !empty($data['hierarchical']) ? $data['hierarchical'] : false;
    $attributes = $hierarchical == true ? 'page-attributes' : '';

    $labels = [
        'name' => $data['labels'],
        'singular_name' => $data['labels'],
        'menu_name' => $data['labels'],
    ];

    $args = array(
        'labels' => $labels,
        'description' => '',
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_rest' => true,
        'rest_base' => '',
        'rest_controller_class' => 'WP_REST_Posts_Controller',
        'has_archive' => false,
        'show_in_menu' => true,
        'show_in_nav_menus' => true,
        'delete_with_user' => false,
        'exclude_from_search' => true,
        'map_meta_cap' => true,
        'hierarchical' => $hierarchical,
        'rewrite' => array('slug' => $post_type, 'with_front' => true),
        'query_var' => true,
        'menu_icon' => 'dashicons-admin-post',
        'supports' => array('title', 'editor', 'thumbnail', 'revisions', 'author', $attributes),
        'capability_type' => 'post',
        'can_export' => true,
    );

    if (!empty($data['tax'])) {
        $args['taxonomies'] = $data['tax'];
    }

    if (!empty($data['cap'])) {
        $capabilities = [
            'create_posts' => 'create_' . $post_type,
            'delete_others_posts' => 'delete_' . $post_type,
            'delete_posts' => 'delete_' . $post_type,
            'delete_private_posts' => 'delete_private_' . $post_type,
            'delete_published_posts' => 'delete_published_' . $post_type,
            'edit_others_posts' => 'edit_others_' . $post_type,
            'edit_posts' => 'edit_' . $post_type,
            'edit_private_posts' => 'edit_private_' . $post_type,
            'edit_published_posts' => 'edit_published_' . $post_type,
            'publish_posts' => 'publish_' . $post_type,
            'read_private_posts' => 'read_private_' . $post_type,
        ];
        $args['capabilities'] = $capabilities;
    }

    register_post_type($post_type, $args);
}

function register_ctx($ctx, $data)
{
    $labels = [
        'name' => $data['labels'],
        'singular_name' => $data['labels'],
    ];

    $args = [
        "label" => $ctx,
        "labels" => $labels,
        "public" => true,
        "publicly_queryable" => true,
        "hierarchical" => true,
        "show_ui" => true,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "query_var" => true,
        "rewrite" => ['slug' => $ctx, 'with_front' => true],
        "show_admin_column" => true,
        "show_in_rest" => true,
        "rest_base" => "car_model_id",
        "rest_controller_class" => "WP_REST_Terms_Controller",
        "show_in_quick_edit" => true,
        "show_in_graphql" => false,
        'show_tagcloud' => true,
    ];

    if (!empty($data['cap'])) {
        $capabilities = [
            'manage_terms' => 'manage_' . $ctx,
            'edit_terms' => 'edit_' . $ctx,
            'delete_terms' => 'delete_' . $ctx,
            'assign_terms' => 'assign_' . $ctx,
        ];
        $args['capabilities'] = $capabilities;
    }

    register_taxonomy($ctx, $data['post_type'], $args);
}