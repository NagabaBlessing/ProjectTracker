<?php
/**
 * Kanzu Code Child Theme functions
 */

function kanzucode_child_enqueue_styles() {
    // Step 1: Load the parent theme's stylesheet
    wp_enqueue_style(
        'parent-style',
        get_template_directory_uri() . '/style.css'
    );

    // Step 2: Load the child theme's stylesheet (after parent)
    wp_enqueue_style(
        'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array('parent-style'), // depends on parent loading first
        wp_get_theme()->get('Version')
    );
}
add_action('wp_enqueue_scripts', 'kanzucode_child_enqueue_styles');