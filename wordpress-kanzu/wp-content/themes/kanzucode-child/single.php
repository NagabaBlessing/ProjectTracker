<?php get_header(); ?>

<main class="site-main" style="padding: 2rem;">

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

    <?php if ( get_post_type() === 'project' ) :
        $status    = get_post_meta(get_the_ID(), '_kct_status',       true);
        $developer = get_post_meta(get_the_ID(), '_kct_developer',    true);
        $go_live   = get_post_meta(get_the_ID(), '_kct_go_live_date', true);
        $client_id = get_post_meta(get_the_ID(), '_kct_client_id',    true);

        $client_name = '—';
        if ($client_id) {
            $client_user = get_userdata((int)$client_id);
            if ($client_user) $client_name = $client_user->display_name;
        }

        $status_colours = array(
            'In Progress' => '#fff3cd',
            'QA Testing'  => '#cfe2ff',
            'Go Live'     => '#d1e7dd',
            'Completed'   => '#d3d3d3',
        );
        $badge = isset($status_colours[$status]) ? $status_colours[$status] : '#f0f0f0';
    ?>

        <div class="post-card">
            <h1><?php the_title(); ?></h1>
            <p>
                <span style="background:<?php echo $badge; ?>;
                             padding:3px 10px;
                             border-radius:12px;
                             font-size:0.85em;">
                    <?php echo esc_html($status ?: 'No status'); ?>
                </span>
                &nbsp; Developer: <strong><?php echo esc_html($developer ?: '—'); ?></strong>
                &nbsp; Client: <strong><?php echo esc_html($client_name); ?></strong>
                &nbsp; Go-Live: <strong><?php echo esc_html($go_live ?: 'TBD'); ?></strong>
            </p>
        </div>

    <?php else : ?>
        <!-- Regular posts -->
        <div class="post-card">
            <h1><?php the_title(); ?></h1>
            <div><?php the_content(); ?></div>
        </div>
    <?php endif; ?>

<?php endwhile; endif; ?>

</main>

<?php get_footer(); ?>