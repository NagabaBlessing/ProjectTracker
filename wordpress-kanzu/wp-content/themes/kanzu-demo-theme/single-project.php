<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php the_title(); ?> | <?php bloginfo('name'); ?></title>
    <?php wp_head(); ?>
    <link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>">
</head>
<body>

<header class="site-header">
    <a class="site-title" href="<?php echo home_url(); ?>">
        <span class="kanzu">Kanzu</span> <span class="desk">Desk</span>
    </a>
</header>

<main class="site-main">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        <div class="post-card">
            <h1><?php the_title(); ?></h1>

            <?php
            $status    = get_post_meta(get_the_ID(), '_kct_status', true);
            $developer = get_post_meta(get_the_ID(), '_kct_developer', true);
            $client    = get_post_meta(get_the_ID(), '_kct_client_name', true);
            $go_live   = get_post_meta(get_the_ID(), '_kct_go_live_date', true);
            ?>

            <table style="width:100%; margin-top:16px; border-collapse:collapse;">
                <tr>
                    <th style="text-align:left; padding:10px; background:#1a1a2e; color:white;">Status</th>
                    <td style="padding:10px; border-bottom:1px solid #e5e7eb;"><?= esc_html($status) ?></td>
                </tr>
                <tr>
                    <th style="text-align:left; padding:10px; background:#1a1a2e; color:white;">Developer</th>
                    <td style="padding:10px; border-bottom:1px solid #e5e7eb;"><?= esc_html($developer) ?></td>
                </tr>
                
                <tr>
                    <th style="text-align:left; padding:10px; background:#1a1a2e; color:white;">Go-Live Date</th>
                    <td style="padding:10px;"><?= esc_html($go_live) ?></td>
                </tr>
            </table>
        </div>

    <?php endwhile; endif; ?>
</main>

<footer class="site-footer">
    <p>Powered by <span class="kanzu">Kanzu</span><span class="code">Code</span> &copy; 2026</p>
</footer>

<?php wp_footer(); ?>
</body>
</html>