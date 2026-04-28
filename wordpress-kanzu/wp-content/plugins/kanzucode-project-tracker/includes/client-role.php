<?php
/**
 * Register the Client user role
 * Clients can only read — no access to wp-admin
 */

function kct_register_client_role() {
    // Only add the role if it doesn't already exist
    // (WordPress stores roles in the database, so we
    // check first to avoid duplicating on every page load)
    if ( ! get_role( 'kct_client' ) ) {
        add_role(
            'kct_client',                    // role slug
            'KCT Client',                    // display name in WP admin
            array(
                'read' => true,              // can read content
                // Everything else is false by default
                // No edit_posts, no delete_posts, no admin access
            )
        );
    }
}
// Run on plugin activation — the cleanest time to register roles
register_activation_hook(
    KCT_PLUGIN_FILE,
    'kct_register_client_role'
);

/**
 * Redirect clients away from wp-admin after login
 * They should only see the frontend client portal page
 */
function kct_redirect_client_after_login( $redirect_to, $request, $user ) {
    // Check if the logged-in user has the kct_client role
    if ( isset( $user->roles ) && in_array( 'kct_client', $user->roles ) ) {
        // Send them to the homepage for now
        // Later we'll change this to the project status page
        return home_url( '/client-portal/' );
    }
    // Everyone else (admins etc) goes to their normal destination
    return $redirect_to;
}
add_filter( 'login_redirect', 'kct_redirect_client_after_login', 10, 3 );
/**
 * Redirect admins away from wp-admin after login
 * They should only see the frontend admin portal page
 */
function kct_redirect_admin_after_login($redirect_to, $request, $user) {
    if (isset($user->roles) && in_array('administrator', $user->roles)) {
        // Send admin straight to the Project Tracker page
        return admin_url('admin.php?page=kct-dashboard');
    }
    return $redirect_to;
}
add_filter('login_redirect', 'kct_redirect_admin_after_login', 10, 3);