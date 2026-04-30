<?php
// Define role variables FIRST before anything else
$current_user = wp_get_current_user();
$is_admin     = in_array('administrator', $current_user->roles, true); // Fixed: added strict true
$is_client    = in_array('kct_client',    $current_user->roles, true); // Fixed: added strict true
$is_developer = in_array('kct_developer', $current_user->roles, true); // Fixed: added strict true

get_header();
?>
<main class="site-main">
<?php if ( is_front_page() ) : ?>

    <?php if ( ! is_user_logged_in() ) : ?>
        <div class="kct-welcome">
            <h1>Welcome to Kanzu Desk</h1>
            <p>The project tracking portal for Kanzu Code clients and team.</p>
            <a href="<?php echo wp_login_url( home_url('/client-portal/') ); ?>"
               class="kct-login-btn">Log In</a>
        </div>

    <?php elseif ( $is_admin ) : ?>
        <h1 class="page-title">Latest Projects</h1>
        <?php
        $projects = new WP_Query(array(
            'post_type'      => 'project',
            'posts_per_page' => 10,
            'post_status'    => 'publish',
            'orderby'        => 'date',
            'order'          => 'DESC',
        ));

        if ( $projects->have_posts() ) :
            while ( $projects->have_posts() ) : $projects->the_post();
                $status    = get_post_meta(get_the_ID(), '_kct_status',       true);
                $developer = get_post_meta(get_the_ID(), '_kct_developer',    true);
                $go_live   = get_post_meta(get_the_ID(), '_kct_go_live_date', true);
                $client_id = get_post_meta(get_the_ID(), '_kct_client_id',    true);

                $client_name = '—';
                if ( $client_id ) {
                    $client_user = get_userdata( $client_id );
                    if ( $client_user ) $client_name = $client_user->display_name;
                }

                $status_colours = array(
                    'In Progress' => '#fff3cd',  // Fixed: yellow (was near-identical blue)
                    'QA Testing'  => '#cfe2ff',  // Fixed: blue (was near-identical blue)
                    'Go Live'     => '#d1e7dd',  // Fixed: green (was near-identical blue)
                    'Completed'   => '#d3d3d3',  // Fixed: grey (was near-identical blue)
                );
                $badge = isset($status_colours[$status]) ? $status_colours[$status] : '#f0f0f0';
        ?>
            <div class="post-card">
                <h2>
                    <a href="<?php echo get_edit_post_link(get_the_ID()); ?>">
                        <?php the_title(); ?>
                    </a>
                </h2>
                <p>
                    <span style="background:<?php echo $badge; ?>;padding:3px 10px;border-radius:12px;font-size:0.85em;">
                        <?php echo esc_html($status ?: 'No status'); ?>
                    </span>
                    &nbsp; Developer: <strong><?php echo esc_html($developer ?: '—'); ?></strong>
                    &nbsp; Client: <strong><?php echo esc_html($client_name); ?></strong>
                    &nbsp; Go-Live: <strong><?php echo esc_html($go_live ?: 'TBD'); ?></strong>
                </p>
            </div>
        <?php
            endwhile;
            wp_reset_postdata();
        else : ?>
            <div class="no-posts">No projects yet.
                <a href="<?php echo admin_url('post-new.php?post_type=project'); ?>">Add first project</a>
            </div>
        <?php endif; ?>

    <?php elseif ( $is_client || $is_developer ) : ?>
        <?php /* Redirect already handled in functions.php via template_redirect hook — nothing needed here */ ?>

    <?php endif; ?>

<?php else : ?>
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <div class="page-content">
            <?php the_content(); ?>
        </div>
    <?php endwhile; endif; ?>
<?php endif; ?>

</main>

<?php get_footer(); ?>