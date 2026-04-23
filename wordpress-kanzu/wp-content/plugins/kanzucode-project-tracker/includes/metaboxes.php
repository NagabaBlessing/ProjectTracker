<?php
if (!defined('ABSPATH')) {
    exit;
}

// Register the meta boxes
function kct_register_meta_boxes() {
    add_meta_box(
        'kct_project_details',      // Unique ID
        'Project Details',          // Title shown on edit screen
        'kct_project_details_cb',   // Callback function that renders the fields
        'project',                  // Which post type to show it on
        'normal',                   // Position - 'normal' means main column
        'high'                      // Priority - 'high' means near the top
    );
}
add_action('add_meta_boxes', 'kct_register_meta_boxes');


// Render the meta box fields
function kct_project_details_cb($post) {
    // Generate nonce field for security
    wp_nonce_field('kct_save_project_details', 'kct_project_nonce');

    // Get existing values from database if editing an existing project
    $status    = get_post_meta($post->ID, '_kct_status', true);
    $developer = get_post_meta($post->ID, '_kct_developer', true);
    $client_id = get_post_meta($post->ID, '_kct_client_id', true);
    $go_live   = get_post_meta($post->ID, '_kct_go_live_date', true);
    ?>

    <table class="form-table">
        <tr>
            <th><label for="kct_status">Project Status</label></th>
            <td>
                <select name="kct_status" id="kct_status">
                    <option value="In Progress" <?= selected($status, 'In Progress', false) ?>>In Progress</option>
                    <option value="QA Testing"  <?= selected($status, 'QA Testing', false) ?>>QA Testing</option>
                    <option value="Go Live"     <?= selected($status, 'Go Live', false) ?>>Go Live</option>
                </select>
            </td>
        </tr>
        <tr>
            <th><label for="kct_developer">Assigned Developer</label></th>
            <td>
                <input type="text" 
                       name="kct_developer" 
                       id="kct_developer" 
                       value="<?= esc_attr($developer) ?>" 
                       class="regular-text">
            </td>
        </tr>
        <tr>
            <th><label for="kct_client_id">Client User ID</label></th>
            <td>
                <input type="number" 
                       name="kct_client_id" 
                       id="kct_client_id" 
                       value="<?= esc_attr($client_id) ?>">
            </td>
        </tr>
        <tr>
            <th><label for="kct_go_live_date">Go-Live Date</label></th>
            <td>
                <input type="date" 
                       name="kct_go_live_date" 
                       id="kct_go_live_date" 
                       value="<?= esc_attr($go_live) ?>">
            </td>
        </tr>
    </table>
    <?php
}


// Save meta box data when post is saved
function kct_save_project_details($post_id) {

    // Verify nonce - security check
    if (!isset($_POST['kct_project_nonce']) ||
        !wp_verify_nonce($_POST['kct_project_nonce'], 'kct_save_project_details')) {
        return;
    }

    // Don't save during autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    // Check user has permission to edit
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    // Sanitize and save each field
    if (isset($_POST['kct_status'])) {
        update_post_meta($post_id, '_kct_status',
            sanitize_text_field($_POST['kct_status']));
    }

    if (isset($_POST['kct_developer'])) {
        update_post_meta($post_id, '_kct_developer',
            sanitize_text_field($_POST['kct_developer']));
    }

    if (isset($_POST['kct_client_id'])) {
        update_post_meta($post_id, '_kct_client_id',
            absint($_POST['kct_client_id']));
    }

    if (isset($_POST['kct_go_live_date'])) {
        update_post_meta($post_id, '_kct_go_live_date',
            sanitize_text_field($_POST['kct_go_live_date']));
    }
}
add_action('save_post_project', 'kct_save_project_details');