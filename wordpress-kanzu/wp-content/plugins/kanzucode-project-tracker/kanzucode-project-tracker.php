<?php
/**
 * Plugin Name: KanzuCode Project Tracker
 * Plugin URI:  https://kanzucode.com
 * Description: A project tracking tool for Kanzu Code clients and admins.
 * Version:     1.0.0
 * Author:      Blessing Nagaba
 * Author URI:  https://kanzucode.com
 * License:     GPL2
 */

// Exit if accessed directly - security measure
if (!defined('ABSPATH')) {
    exit;
}
// Include plugin files
require_once plugin_dir_path(__FILE__) . 'includes/cpt.php';
require_once plugin_dir_path(__FILE__) . 'includes/metaboxes.php';
require_once plugin_dir_path(__FILE__) . 'includes/admin-views.php';

// Activation hook
register_activation_hook(__FILE__, 'kct_activate');
function kct_activate() {
    // Runs when plugin is activated
    flush_rewrite_rules();
}

// Deactivation hook
register_deactivation_hook(__FILE__, 'kct_deactivate');
function kct_deactivate() {
    // Runs when plugin is deactivated
    flush_rewrite_rules();
}

// Add admin menu page
add_action('admin_menu', 'kct_admin_menu');
function kct_admin_menu() {
    add_menu_page(
        'Project Tracker',           // Page title shown in browser tab
        'Project Tracker',           // Label shown in sidebar menu
        'manage_options',            //  Who can see it - 'manage_options' means admins only - capability required
        'kct-dashboard',             // Menu slug - Unique ID for this page used in URL
        'kct_dashboard_page',        // Function to display page / that builds the page content
        'dashicons-clipboard',       // Icon- inbuilt in wordpress
        6                            // Position in menu - Position - 6 puts it near top of sideba
    );
}

// Dashboard page content
function kct_dashboard_page() {
    kct_render_dashboard();            
}
// Enqueue admin styles

function kct_enqueue_admin_styles($hook) {
    if ($hook !== 'toplevel_page_kct-dashboard') {
        return;
    }
    wp_enqueue_style(
        'kct-admin-style',
        plugin_dir_url(__FILE__) . 'assets/admin-style.css',
        array(),
        '1.0.0'
    );
}
add_action('admin_enqueue_scripts', 'kct_enqueue_admin_styles');
