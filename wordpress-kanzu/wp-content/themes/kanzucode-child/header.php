<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php bloginfo('name'); ?> - <?php wp_title('|'); ?></title>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<header class="site-header">
    <div class="site-branding">
        <?php if ( has_custom_logo() ) : ?>
            <?php the_custom_logo(); ?>
        <?php endif; ?>
        <a href="<?php echo home_url(); ?>" class="site-name">
            <span class="kanzu">Kanzu</span><span class="desk"> Desk</span>
        </a>
    </div>

    <div class="kct-header-actions">
        <?php if ( ! is_front_page() && ( ! is_user_logged_in() || current_user_can('administrator') ) ) :
            $back_url = home_url('/');
            if ( is_user_logged_in() ) {
                $user = wp_get_current_user();
                if ( in_array('kct_client', (array) $user->roles, true) || in_array('kct_developer', (array) $user->roles, true) ) { // Fixed: added developer check
                    $back_url = add_query_arg('kct_client_no_access', '1', home_url('/'));
                }
            }
        ?>
            <a class="kct-back-btn" href="<?php echo esc_url($back_url); ?>">
                ← Back to Home
            </a>
        <?php endif; ?>

        <div class="kct-profile-menu">
            <?php if ( is_user_logged_in() ) : ?>
                <a href="<?php echo esc_url(get_edit_profile_url(get_current_user_id())); ?>">👤</a>
                <a href="<?php echo esc_url(wp_logout_url(home_url('/'))); ?>">Logout</a>
            <?php else : ?>
                <a href="<?php echo esc_url(wp_login_url()); ?>">Log in</a>
            <?php endif; ?>
        </div>
    </div>
</header>