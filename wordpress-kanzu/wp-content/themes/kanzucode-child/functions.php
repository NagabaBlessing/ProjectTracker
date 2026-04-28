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

/**
 * Handle client back-button route and show a no-access prompt with logout action.
 */
function kct_handle_client_back_prompt() {
    if (!is_user_logged_in() || !isset($_GET['kct_client_no_access'])) {
        return;
    }

    $user = wp_get_current_user();
    if (!in_array('kct_client', (array) $user->roles, true)) {
        return;
    }

    $logout_url = wp_logout_url(home_url('/'));
    wp_die(
        '<div style="max-width:540px;margin:30px auto;font-family:Poppins,Arial,sans-serif;">'
        . '<h1 style="margin-bottom:12px;">No access to all projects</h1>'
        . '<p style="font-size:16px;line-height:1.6;">As a client, you can only access your own project portal. Please log out to switch account.</p>'
        . '<p><a href="' . esc_url($logout_url) . '" style="display:inline-block;background:#E8431E;color:#fff;padding:10px 16px;border-radius:8px;text-decoration:none;font-weight:600;">Log out</a></p>'
        . '</div>',
        'Access restricted',
        array('response' => 403)
    );
}
add_action('template_redirect', 'kct_handle_client_back_prompt');
// Add theme support for custom logo
add_theme_support('custom-logo', array(
    'height'      => 80,
    'width'       => 200,
    'flex-height' => true,
    'flex-width'  => true,
));
