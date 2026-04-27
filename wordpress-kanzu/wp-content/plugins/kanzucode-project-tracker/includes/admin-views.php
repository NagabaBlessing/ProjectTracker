<?php
if (!defined('ABSPATH')) {
    exit;
}

function kct_render_dashboard() {
    $query = new WP_Query(array(
        'post_type'      => 'project',
        'posts_per_page' => -1,
        'post_status'    => 'publish',
        'orderby'        => 'date',
        'order'          => 'DESC',
    ));
    ?>
    <div class="wrap">
        <h1>Project Tracker Dashboard</h1>

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

                    // Convert client ID to a readable name
                    $client_name = '—';
                    if ($client_id) {
                        $client_user = get_userdata($client_id);
                        if ($client_user) {
                            $client_name = esc_html(
                                $client_user->display_name . 
                                ' (' . $client_user->user_email . ')'
                            );
                        }
                    }

                    // Status badge colours
                    $status_colours = array(
                        'In Progress' => '#fff3cd',
                        'QA Testing'  => '#cfe2ff',
                        'Go Live'     => '#d1e7dd',
                        'Completed'   => '#d3d3d3',
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
                        <span style="background:<?php echo $badge_colour; ?>; 
                                     padding:3px 10px; 
                                     border-radius:12px;
                                     font-size:0.85em;">
                            <?php echo esc_html($status ?: '—'); ?>
                        </span>
                    </td>
                    <td><?php echo esc_html($developer ?: '—'); ?></td>
                    <td><?php echo $client_name; ?></td>
                    <td><?php echo esc_html($go_live ?: '—'); ?></td>
                    <td>
                        <a href="<?php echo get_edit_post_link(get_the_ID()); ?>" 
                           class="button button-small">
                            Edit
                        </a>
                    </td>
                </tr>
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
            </tbody>
        </table>

        <?php else : ?>
            <p>No projects found. <a href="<?php echo admin_url('post-new.php?post_type=project'); ?>">Add your first project.</a></p>
        <?php endif; ?>

    </div>
    <?php
}