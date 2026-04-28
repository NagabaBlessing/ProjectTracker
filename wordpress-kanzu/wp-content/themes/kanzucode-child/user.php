<?php // This template is used for user profile view
get_header();

$author = get_queried_object(); // the user being viewed
$author_id = $author->ID;
$author_role = !empty($author->roles) ? $author->roles[0] : '';
?>

<main class="site-main" style="padding: 2rem;">

    <!-- User Profile Card -->
    <div class="post-card" style="margin-bottom: 2rem;">
        <h1><?php echo esc_html($author->display_name); ?></h1>
        <p>
            <strong>Email:</strong> <?php echo esc_html($author->user_email); ?>
            &nbsp;&nbsp;
            <strong>Role:</strong> <?php echo esc_html(ucfirst($author_role)); ?>
        </p>
    </div>

    <?php
    // Find projects linked to this user
    // Check both as client AND as developer
    $as_client = new WP_Query(array(
        'post_type'      => 'project',
        'posts_per_page' => -1,
        'post_status'    => 'publish',
        'meta_query'     => array(
            array(
                'key'     => '_kct_client_id',
                'value'   => $author_id,
                'compare' => '=',
            )
        )
    ));

    $as_developer = new WP_Query(array(
        'post_type'      => 'project',
        'posts_per_page' => -1,
        'post_status'    => 'publish',
        'meta_query'     => array(
            array(
                'key'     => '_kct_developer',
                'value'   => $author->display_name,
                'compare' => 'LIKE',
            )
        )
    ));
    ?>

    <!-- Projects as Client -->
    <?php if ($as_client->have_posts()) : ?>
        <h2 class="page-title">Projects as Client</h2>
        <?php while ($as_client->have_posts()) : $as_client->the_post();
            $status  = get_post_meta(get_the_ID(), '_kct_status', true);
            $go_live = get_post_meta(get_the_ID(), '_kct_go_live_date', true);
            $status_colours = array(
                'In Progress' => '#fff3cd',
                'QA Testing'  => '#cfe2ff',
                'Go Live'     => '#d1e7dd',
                'Completed'   => '#d3d3d3',
            );
            $badge = isset($status_colours[$status]) ? $status_colours[$status] : '#f0f0f0';
        ?>
            <div class="post-card">
                <h3>
                    <a href="<?php echo get_edit_post_link(get_the_ID()); ?>">
                        <?php the_title(); ?>
                    </a>
                </h3>
                <p>
                    <span style="background:<?php echo $badge; ?>;
                                 padding:3px 10px;
                                 border-radius:12px;
                                 font-size:0.85em;">
                        <?php echo esc_html($status ?: '—'); ?>
                    </span>
                    &nbsp; Go-Live: <strong><?php echo esc_html($go_live ?: 'TBD'); ?></strong>
                </p>
            </div>
        <?php endwhile; wp_reset_postdata(); ?>

    <?php else : ?>
        <div class="kct-notice">No projects assigned as client.</div>
    <?php endif; ?>

    <!-- Projects as Developer -->
    <?php if ($as_developer->have_posts()) : ?>
        <h2 class="page-title" style="margin-top:2rem;">Projects as Developer</h2>
        <?php while ($as_developer->have_posts()) : $as_developer->the_post();
            $status  = get_post_meta(get_the_ID(), '_kct_status', true);
            $client_id = get_post_meta(get_the_ID(), '_kct_client_id', true);
            $client_name = '—';
            if ($client_id) {
                $cu = get_userdata((int)$client_id);
                if ($cu) $client_name = $cu->display_name;
            }
            $badge = isset($status_colours[$status]) ? $status_colours[$status] : '#f0f0f0';
        ?>
            <div class="post-card">
                <h3>
                    <a href="<?php echo get_edit_post_link(get_the_ID()); ?>">
                        <?php the_title(); ?>
                    </a>
                </h3>
                <p>
                    <span style="background:<?php echo $badge; ?>;
                                 padding:3px 10px;
                                 border-radius:12px;
                                 font-size:0.85em;">
                        <?php echo esc_html($status ?: '—'); ?>
                    </span>
                    &nbsp; Client: <strong><?php echo esc_html($client_name); ?></strong>
                </p>
            </div>
        <?php endwhile; wp_reset_postdata(); ?>

    <?php else : ?>
        <div class="kct-notice" style="margin-top:1rem;">No projects assigned as developer.</div>
    <?php endif; ?>

</main>

<?php get_footer(); ?>