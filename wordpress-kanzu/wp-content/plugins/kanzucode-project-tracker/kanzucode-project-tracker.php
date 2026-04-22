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
        'Project Tracker',           // Page title
        'Project Tracker',           // Menu title
        'manage_options',            // Capability required
        'kct-dashboard',             // Menu slug
        'kct_dashboard_page',        // Function to display page
        'dashicons-clipboard',       // Icon
        6                            // Position in menu
    );
}

// Dashboard page content
function kct_dashboard_page() {
    echo '<div class="wrap">';
    echo '<h1>KanzuCode Project Tracker</h1>';
    echo '<p>Welcome to the Project Tracker plugin.</p>';
    echo '</div>';
}