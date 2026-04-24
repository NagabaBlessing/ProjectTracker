<?php
if (!defined('ABSPATH')) {
    exit;
}

function kct_render_dashboard() {
    // WP_Query to fetch all projects
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
        <a href="<?= admin_url('post-new.php?post_type=project') ?>" 
           class="page-title-action">+ Add New Project</a>

        <table class="wp-list-table widefat fixed striped" style="margin-top:20px;">
            <thead>
                <tr>
                    <th>Project Name</th>
                    <th>Status</th>
                    <th>Developer</th>
                    <th>Client ID</th>
                    <th>Go-Live Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($query->have_posts()) : ?>
                    <?php while ($query->have_posts()) : $query->the_post(); ?>
                        <?php
                        $status    = get_post_meta(get_the_ID(), '_kct_status', true);
                        $developer = get_post_meta(get_the_ID(), '_kct_developer', true);
                        $client_id = get_post_meta(get_the_ID(), '_kct_client_id', true);
                        $go_live   = get_post_meta(get_the_ID(), '_kct_go_live_date', true);
                        ?>
                        <tr>
                            <td><?= get_the_title() ?></td>
                            <td>
    <?php
    $badge_class = match($status) {
        'In Progress' => 'kct-badge-progress',
        'QA Testing'  => 'kct-badge-qa',
        'Go Live'     => 'kct-badge-live',
        default       => ''
    };
    ?>
    <span class="kct-badge <?= $badge_class ?>">
        <?= esc_html($status) ?>
    </span>
</td>
                            <td><?= esc_html($developer) ?></td>
                            <td><?= esc_html($client_id) ?></td>
                            <td><?= esc_html($go_live) ?></td>
                            <td>
                                <a href="<?= get_edit_post_link() ?>">Edit</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                    <?php wp_reset_postdata(); ?>
                <?php else : ?>
                    <tr>
                        <td colspan="6">No projects found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <?php
}