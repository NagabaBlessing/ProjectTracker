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
/**
 * Redirect clients to client portal after login
 * and if they visit the homepage directly
 */
function kct_redirect_clients_to_portal() {
    if ( ! is_user_logged_in() ) return;
    
    $user = wp_get_current_user();
    
    if ( in_array('kct_client', $user->roles) && is_front_page() ) {
        wp_redirect( home_url('/client-portal/') );
        exit;
    }
}
add_action('template_redirect', 'kct_redirect_clients_to_portal');
// Add theme support for custom logo
add_theme_support('custom-logo', array(
    'height'      => 80,
    'width'       => 200,
    'flex-height' => true,
    'flex-width'  => true,
));