<?php
if (!defined('ABSPATH')) {
    exit;
}

// Register the meta boxes
function kct_register_meta_boxes()
{
    add_meta_box(
        'kct_project_details',
        'Project Details',
        'kct_project_details_cb',
        'project',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'kct_register_meta_boxes');


// Render the meta box fields
function kct_project_details_cb($post)
{
    wp_nonce_field('kct_save_project_details', 'kct_project_nonce');

    // Get existing saved values
    $status = get_post_meta($post->ID, '_kct_status', true);
    $developer = get_post_meta($post->ID, '_kct_developer', true);
    $client_id = get_post_meta($post->ID, '_kct_client_id', true);
    $go_live = get_post_meta($post->ID, '_kct_go_live_date', true);

    // Fetch all users with the kct_client role for the client dropdown
    $clients = get_users(array('role' => 'kct_client'));

    /// Fetch all users with the dedicated project developer role.
    $developers = get_users(array(
        'role' => 'kct_developer',
    ));
    ?>

    <table class="form-table">

        <!-- PROJECT STATUS -->
        <tr>
            <th><label for="kct_status">Project Status</label></th>
            <td>
                <select name="kct_status" id="kct_status">
                    <option value="">— Select Status —</option>
                    <option value="Requirements" <?php selected($status, 'Requirements Gathering'); ?>>Requirements Gathering</option>
                    <option value="In Progress" <?php selected($status, 'In Progress'); ?>>In Progress</option>
                    <option value="QA Testing" <?php selected($status, 'QA Testing'); ?>>QA Testing</option>
                    <option value="UAT" <?php selected($status, 'UAT'); ?>>UAT</option>
                    <option value="Go Live" <?php selected($status, 'Go Live'); ?>>Go Live</option>
                </select>
            </td>
        </tr>

        <!-- ASSIGNED DEVELOPER DROPDOWN -->
        <tr>
            <th><label for="kct_developer">Assigned Developer</label></th>
            <td>
                <select name="kct_developer" id="kct_developer" style="min-width:200px">
                    <option value="">— Select Developer —</option>
                    <?php foreach ($developers as $dev): ?>
                        <option value="<?php echo esc_attr($dev->display_name); ?>" <?php selected($developer, $dev->display_name); ?>>
                            <?php echo esc_html($dev->display_name); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <p class="description">Only users with the "KCT Developer" role appear here.</p>
            </td>
        </tr>

        <!-- ASSIGNED CLIENT DROPDOWN -->
        <tr>
            <th><label for="kct_client_id">Assigned Client</label></th>
            <td>
                <select name="kct_client_id" id="kct_client_id" style="min-width:200px">
                    <option value="">— Select Client —</option>
                    <?php foreach ($clients as $client): ?>
                        <option value="<?php echo esc_attr($client->ID); ?>" <?php selected($client_id, $client->ID); ?>>
                            <?php echo esc_html($client->display_name); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <?php if (empty($clients)): ?>
                    <p class="description" style="color:#1f4e8c">
                        No clients found. Add a user with the "KCT Client" role first.
                    </p>
                <?php endif; ?>
            </td>
        </tr>

        <!-- GO-LIVE DATE -->
        <tr>
            <th><label for="kct_go_live_date">Go-Live Date</label></th>
            <td>
                <input type="date" name="kct_go_live_date" id="kct_go_live_date" value="<?php echo esc_attr($go_live); ?>">
            </td>
        </tr>

    </table>
    <?php
}


// Save meta box data
function kct_save_project_details($post_id)
{

    if (
        !isset($_POST['kct_project_nonce']) ||
        !wp_verify_nonce($_POST['kct_project_nonce'], 'kct_save_project_details')
    ) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    if (isset($_POST['kct_status'])) {
        update_post_meta(
            $post_id,
            '_kct_status',
            sanitize_text_field($_POST['kct_status'])
        );
    }

    // Developer is now saved as display_name string (same as before)
   
    if (isset($_POST['kct_developer'])) {
        update_post_meta(
            $post_id,
            '_kct_developer',
            sanitize_text_field($_POST['kct_developer'])
        );
    }

    // Client is saved as numeric ID (same as before)
    if (isset($_POST['kct_client_id'])) {
        update_post_meta(
            $post_id,
            '_kct_client_id',
            absint($_POST['kct_client_id'])
        );
    }

    if (isset($_POST['kct_go_live_date'])) {
        update_post_meta(
            $post_id,
            '_kct_go_live_date',
            sanitize_text_field($_POST['kct_go_live_date'])
        );
    }
}
add_action('save_post_project', 'kct_save_project_details');