<?php get_header(); ?>
<main class="site-main">
    <h1 class="page-title"><?php the_archive_title(); ?></h1>
    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <div class="post-card">
            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            <p><?php the_excerpt(); ?></p>
        </div>
    <?php endwhile; else : ?>
        <div class="no-posts">Nothing found here.</div>
    <?php endif; ?>
</main>

<?php get_footer(); ?>
