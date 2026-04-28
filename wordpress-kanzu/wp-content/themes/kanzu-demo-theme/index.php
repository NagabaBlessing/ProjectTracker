<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title><?php bloginfo('name'); ?></title>
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
        <h1 class="page-title">Latest Posts</h1>

        <?php if (have_posts()): ?>

            <?php while (have_posts()):
                the_post(); ?>

                <div class="post-card">
                    <h2><?php the_title(); ?></h2>
                    <p><?php the_content(); ?></p>
                </div>

            <?php endwhile; ?>

        <?php else: ?>

            <div class="no-posts">No posts found.</div>

        <?php endif; ?>

    </main>

    <footer class="site-footer">
        <p>Powered by <span class="kanzu">Kanzu</span><span class="code">Code</span> &copy; 2026</p>
    </footer>

    <?php wp_footer(); ?>
</body>

</html>