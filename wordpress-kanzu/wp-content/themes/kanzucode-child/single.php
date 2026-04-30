<?php
get_header();
?>

<main class="site-main kct-content-wrap">
    <?php if (have_posts()): ?>
        <?php while (have_posts()): the_post();
            $status  = get_post_meta(get_the_ID(), '_kct_status',       true);
            $go_live = get_post_meta(get_the_ID(), '_kct_go_live_date', true);

            $status_colours = array(
                'In Progress' => '#fff3cd',  // Fixed: yellow (was near-identical blue)
                'QA Testing'  => '#cfe2ff',  // Fixed: blue (was near-identical blue)
                'Go Live'     => '#d1e7dd',  // Fixed: green (was near-identical blue)
                'Completed'   => '#d3d3d3',  // Fixed: grey (was near-identical blue)
            );
            $badge = isset($status_colours[$status]) ? $status_colours[$status] : '#f0f0f0';
            ?>

            <article class="post-card kct-project-single-card">
                <h1><?php the_title(); ?></h1>

                <div class="kct-project-single-meta">
                    <p>
                        <span class="kct-status-pill" style="background:<?php echo esc_attr($badge); ?>;">
                            <?php echo esc_html($status ?: 'No status'); ?>
                        </span>
                    </p>
                    <p><strong>Go-Live Date:</strong> <?php echo esc_html($go_live ?: 'TBD'); ?></p>
                </div>
            </article>

        <?php endwhile; ?>
    <?php else: ?>
        <div class="kct-notice">Project not found.</div>
    <?php endif; ?>
</main>

<?php get_footer(); ?>