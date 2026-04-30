<?php
/**␊
 * Register lightweight frontend-only roles.
 */
function kct_register_frontend_roles() {
    if ( ! get_role( 'kct_client' ) ) {
        add_role(
            'kct_client',
            'KCT Client',
            array(
                'read' => true,
            )
        );
    }

    if ( ! get_role( 'kct_developer' ) ) {
        add_role(
            'kct_developer',
            'KCT Developer',
            array(
                'read' => true,
            )
        );
    }
}
register_activation_hook( KCT_PLUGIN_FILE, 'kct_register_frontend_roles' );
add_action( 'init', 'kct_register_frontend_roles' );

/**
 * Handle all login redirects based on user role.
 * Admins → WP Admin dashboard page.
 * Clients & Developers → Frontend  portal.
 */
function kct_redirect_client_after_login( $redirect_to, $request, $user ) {
    if ( isset( $user->roles ) && ( in_array( 'kct_client', $user->roles, true ) || in_array( 'kct_developer', $user->roles, true ) ) ) {
        return home_url( '/client-portal/' );
    }

    return $redirect_to;
}
add_filter( 'login_redirect', 'kct_redirect_client_after_login', 10, 3 );




/**
 * Keep wp-admin restricted to administrators only.
 */
function kct_redirect_admin_after_login($redirect_to, $request, $user) {
    if (isset($user->roles) && in_array('administrator', $user->roles, true)) {
        return admin_url('admin.php?page=kct-dashboard');
    }
    return $redirect_to;
}
add_filter('login_redirect', 'kct_redirect_admin_after_login', 10, 3);

/**
 * Keep wp-admin restricted to administrators only.
 */
function kct_block_non_admin_dashboard_access() {
    if ( ! is_user_logged_in() || wp_doing_ajax() ) {
        return;
    }

    if ( current_user_can( 'administrator' ) ) {
        return;
    }

    if ( is_admin() ) {
        wp_safe_redirect( home_url( '/client-portal/' ) );
        exit;
    }
}
add_action( 'admin_init', 'kct_block_non_admin_dashboard_access' );
