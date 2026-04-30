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
        return '<div class="kct-login-prompt">
                    <p>Please <a href="' . wp_login_url( get_permalink() ) . '">log in</a> to view your project status.</p>
                </div>';
    }

    // STEP 2: Is the logged-in user actually a client?
    $current_user = wp_get_current_user();

    // Only administrators should access the dashboard.
    if ( in_array( 'administrator', $current_user->roles, true ) ) {
        return '<div class="kct-notice">
                    <p>You are logged in as an administrator.
                    <a href="' . admin_url( 'admin.php?page=kct-dashboard' ) . '">
                        Go to Project Tracker Dashboard →
                    </a></p>
                </div>';
    }

    // Not a client/dev
    if ( ! in_array( 'kct_client', $current_user->roles, true ) && ! in_array( 'kct_developer', $current_user->roles, true ) ) {
        return '<div class="kct-notice">
                    <p>This page is only for assigned clients and developers.</p>
                </div>';
    }

    // STEP 3: Find the project linked to this user
    $meta_filter = in_array( 'kct_developer', $current_user->roles, true )
        ? array(
            'key'     => '_kct_developer',
            'value'   => $current_user->display_name,
            'compare' => '=',
        )
        : array(
            'key'     => '_kct_client_id',
            'value'   => $current_user->ID, // Fixed: was $current_user_id (undefined)
            'compare' => '=',
        );

    $query = new WP_Query( array(
        'post_type'      => 'project',
        'posts_per_page' => -1,
        'post_status'    => 'publish',
        'meta_query'     => array( $meta_filter ),
    ) );

    // STEP 4: Did we find a project?
    if ( ! $query->have_posts() ) {
        return '<div class="kct-notice">
                    <p>No assigned projects found for your account. Please contact your administrator.</p>
                </div>';
    }

    // STEP 5: Build the output HTML
    ob_start();
    $card_mode_class = is_front_page() ? 'kct-project-grid--stacked' : 'kct-project-grid--cards';
    echo '<div class="kct-project-grid ' . esc_attr( $card_mode_class ) . '">';

    while ( $query->have_posts() ) {
        $query->the_post();

        $status    = get_post_meta( get_the_ID(), '_kct_status',       true );
        $developer = get_post_meta( get_the_ID(), '_kct_developer',    true );
        $go_live   = get_post_meta( get_the_ID(), '_kct_go_live_date', true );

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

        <div class="kct-project-card kct-project-card--full-width">
            <h2 class="kct-project-card__title"><?php the_title(); ?></h2>

            <div class="kct-project-card__meta">

                <div class="kct-project-card__row">
                    <span class="kct-project-card__label">Status</span>
                    <span class="kct-project-card__status kct-project-card__status--<?php echo esc_attr( $status ); ?>">
                        <?php echo esc_html( $status_label ); ?>
                    </span>
                </div>

                <div class="kct-project-card__row">
                    <span class="kct-project-card__label">Developer</span>
                    <span class="kct-project-card__value">
                        <?php echo esc_html( $developer ?: 'Not assigned yet' ); ?>
                    </span>
                </div>

                <div class="kct-project-card__row">
                    <span class="kct-project-card__label">Go-Live Date</span>
                    <span class="kct-project-card__value">
                        <?php echo esc_html( $go_live ?: 'TBD' ); ?>
                    </span>
                </div>

            </div> <!-- /.kct-project-card__meta  Fixed: was missing -->
        </div> <!-- /.kct-project-card  Fixed: was missing -->

        <?php
    }

    echo '</div>'; // Fixed: was echoed twice

    // Always reset after a custom WP_Query
    wp_reset_postdata();

    return ob_get_clean();
}

add_shortcode( 'project_status', 'kct_project_status_shortcode' );