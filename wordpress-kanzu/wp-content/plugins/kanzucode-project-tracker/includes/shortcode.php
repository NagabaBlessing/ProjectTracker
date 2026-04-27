<?php
/**
 * [project_status] shortcode
 *
 * Displays the current logged-in client's project details.
 * Usage: add [project_status] to any WordPress page.
 */

function kct_project_status_shortcode() {
    // STEP 1: Is anyone logged in?
    if ( ! is_user_logged_in() ) {
        // Not logged in — show a login link instead
        return '<div class="kct-login-prompt">
                    <p>Please <a href="' . wp_login_url( get_permalink() ) . '">log in</a> to view your project status.</p>
                </div>';
    }

    // STEP 2: Is the logged-in user actually a client?
    $current_user = wp_get_current_user();
    if ( ! in_array( 'kct_client', $current_user->roles ) ) {
        // Logged in but not a client (e.g. admin visiting the page)
        return '<div class="kct-notice">
                    <p>This page is for clients only.</p>
                </div>';
    }

    // STEP 3: Find the project linked to this client
    // We use WP_Query with meta_query to search project meta
    // for a client_id that matches the current user's ID
    $current_user_id = get_current_user_id();

    $query = new WP_Query( array(
        'post_type'      => 'project',
        'posts_per_page' => 1,           // one client = one project
        'post_status'    => 'publish',
        'meta_query'     => array(
            array(
                'key'     => '_kct_client_id',   // the meta key from metaboxes.php
                'value'   => $current_user_id,
                'compare' => '=',
            ),
        ),
    ) );

    // STEP 4: Did we find a project?
    if ( ! $query->have_posts() ) {
        return '<div class="kct-notice">
                    <p>No project found for your account. Please contact your administrator.</p>
                </div>';
    }

    // STEP 5: Build the output HTML
    // ob_start() captures everything we echo into a string
    // instead of printing it directly — shortcodes must RETURN
    // their output, not echo it
    ob_start();

    while ( $query->have_posts() ) {
        $query->the_post();

        // Get the custom meta fields saved by metaboxes.php
        $status    = get_post_meta( get_the_ID(), '_kct_status',    true );
        $developer = get_post_meta( get_the_ID(), '_kct_developer', true );
        $go_live   = get_post_meta( get_the_ID(), '_kct_go_live_date', true );

        // Map status slugs to readable labels + CSS classes
        $status_labels = array(
            'in_progress' => 'In Progress',
            'qa_testing'  => 'QA Testing',
            'go_live'     => 'Go Live',
            'completed'   => 'Completed',
        );
        $status_label = isset( $status_labels[ $status ] )
            ? $status_labels[ $status ]
            : ucfirst( $status );
        ?>

        <div class="kct-project-card">
            <h2 class="kct-project-title"><?php the_title(); ?></h2>

            <div class="kct-project-meta">

                <div class="kct-meta-row">
                    <span class="kct-meta-label">Status</span>
                    <span class="kct-status kct-status--<?php echo esc_attr( $status ); ?>">
                        <?php echo esc_html( $status_label ); ?>
                    </span>
                </div>

                <div class="kct-meta-row">
                    <span class="kct-meta-label">Developer</span>
                    <span class="kct-meta-value">
                        <?php echo esc_html( $developer ?: 'Not assigned yet' ); ?>
                    </span>
                </div>

                <div class="kct-meta-row">
                    <span class="kct-meta-label">Go-Live Date</span>
                    <span class="kct-meta-value">
                        <?php echo esc_html( $go_live ?: 'TBD' ); ?>
                    </span>
                </div>

            </div>
        </div>

        <?php
    }

    // IMPORTANT: Always reset after a custom WP_Query
    // so WordPress's global $post doesn't get corrupted
    wp_reset_postdata();

    // Return the captured HTML
    return ob_get_clean();
}
// Register the shortcode with WordPress
add_shortcode( 'project_status', 'kct_project_status_shortcode' );