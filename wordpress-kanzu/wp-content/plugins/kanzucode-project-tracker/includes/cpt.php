<?php
// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

function kct_register_project_cpt() {
    $labels = array(
        'name'               => 'Projects',
        'singular_name'      => 'Project',
        'add_new'            => 'Add New Project',
        'add_new_item'       => 'Add New Project',
        'edit_item'          => 'Edit Project',
        'view_item'          => 'View Project',
        'all_items'          => 'All Projects',
        'search_items'       => 'Search Projects',
        'not_found'          => 'No projects found',
        'not_found_in_trash' => 'No projects found in trash',
    );

    $args = array(
        'labels'              => $labels,
        'public'              => true,
        'show_in_menu'        => true,
        'show_in_admin_bar'   => true,
        'supports'            => array('title'),
        'has_archive'         => true,
        'rewrite'             => array('slug' => 'projects'),
        'menu_icon'           => 'dashicons-portfolio',
        'menu_position'       => 5,
    );

    register_post_type('project', $args);
}

add_action('init', 'kct_register_project_cpt');