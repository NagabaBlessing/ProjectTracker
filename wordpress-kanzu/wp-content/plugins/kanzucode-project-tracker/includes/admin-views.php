<?php
if (!defined('ABSPATH')) {
    exit;
}

function kct_render_dashboard() {
    $search = isset($_GET['kct_search']) ? sanitize_text_field($_GET['kct_search']) : '';

    $args = array(
        'post_type'      => 'project',
        'posts_per_page' => -1,
        'post_status'    => 'publish',
        'orderby'        => 'date',
        'order'          => 'DESC',
    );

    if ( $search ) {
        $args['s'] = $search;
    }

    $query = new WP_Query($args);
    ?>
    <div class="wrap">

        <!-- HEADER ROW -->
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1rem;">
            <h1 style="margin:0;">Project Tracker Dashboard</h1>
            <a href="<?php echo admin_url('post-new.php?post_type=project'); ?>"
               class="button button-primary">
                + Add New Project
            </a>
        </div>

        <!-- SEARCH BAR -->
        <form method="GET" action="" style="margin-bottom:1rem;">
            <input type="hidden" name="page" value="kct-dashboard">
            <input
                type="text"
                name="kct_search"
                value="<?php echo esc_attr($search); ?>"
                placeholder="Search projects by name..."
                style="width:300px; padding:6px 10px; border:1px solid #ccc; border-radius:4px;">
            <button type="submit" class="button">Search</button>
            <?php if ($search) : ?>
                <a href="<?php echo admin_url('admin.php?page=kct-dashboard'); ?>"
                   class="button">Clear</a>
            <?php endif; ?>
        </form>

        <?php if ($search) : ?>
            <p>Showing results for: <strong><?php echo esc_html($search); ?></strong></p>
        <?php endif; ?>

        <?php if ($query->have_posts()) : ?>
        <table class="wp-list-table widefat fixed striped">
            <thead>
                <tr>
                    <th>Project Name</th>
                    <th>Status</th>
                    <th>Assigned Developer</th>
                    <th>Assigned Client</th>
                    <th>Go-Live Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($query->have_posts()) : $query->the_post();
                    $status    = get_post_meta(get_the_ID(), '_kct_status',       true);
                    $developer = get_post_meta(get_the_ID(), '_kct_developer',    true);
                    $client_id = get_post_meta(get_the_ID(), '_kct_client_id',    true);
                    $go_live   = get_post_meta(get_the_ID(), '_kct_go_live_date', true);

                    $client_name = '—';
                    if ($client_id) {
                        $client_user = get_userdata((int) $client_id);
                        if ($client_user) {
                            $client_name = $client_user->display_name; // Fixed: store raw, escape on output
                        }
                    }

                    $status_colours = array(
                        'In Progress' => '#fff3cd',  // Fixed: yellow (was near-identical blue)
                        'QA Testing'  => '#cfe2ff',  // Fixed: blue (was near-identical blue)
                        'Go Live'     => '#d1e7dd',  // Fixed: green (was near-identical blue)
                        'Completed'   => '#d3d3d3',  // Fixed: grey (was near-identical blue)
                    );
                    $badge_colour = isset($status_colours[$status])
                        ? $status_colours[$status]
                        : '#f0f0f0';
                ?>
                <tr>
                    <td>
                        <strong>
                            <a href="<?php echo get_edit_post_link(get_the_ID()); ?>">
                                <?php the_title(); ?>
                            </a>
                        </strong>
                    </td>
                    <td>
                        <span style="background:<?php echo esc_attr($badge_colour); ?>;
                                     padding:3px 10px;
                                     border-radius:12px;
                                     font-size:0.85em;">
                            <?php echo esc_html($status ?: '—'); ?>
                        </span>
                    </td>
                    <td><?php echo esc_html($developer ?: '—'); ?></td>
                    <td><?php echo esc_html($client_name); ?></td> <!-- Fixed: escape on output -->
                    <td><?php echo esc_html($go_live ?: '—'); ?></td>
                    <td style="display:flex; gap:6px;">
                        <a href="<?php echo get_edit_post_link(get_the_ID()); ?>"
                           class="button button-small">Edit</a>
                        <a href="<?php echo get_permalink(get_the_ID()); ?>"
                           class="button button-small" target="_blank">View</a>
                    </td>
                </tr>
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
            </tbody>
        </table>

        <?php else : ?>
            <div style="padding:2rem; text-align:center; background:#f9f9f9; border:1px solid #e0e0e0; border-radius:8px;">
                <?php if ($search) : ?>
                    <p>No projects found matching "<strong><?php echo esc_html($search); ?></strong>"</p>
                    <a href="<?php echo admin_url('admin.php?page=kct-dashboard'); ?>" class="button">Show All</a>
                <?php else : ?>
                    <p>No projects yet.</p>
                    <a href="<?php echo admin_url('post-new.php?post_type=project'); ?>" class="button button-primary">
                        + Add Your First Project
                    </a>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
    <?php
}