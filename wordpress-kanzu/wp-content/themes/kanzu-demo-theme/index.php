<?php get_header(); ?>

<h1>All Posts</h1>

<?php if (have_posts()) : ?>

    <?php while (have_posts()) : the_post(); ?>

        <div class="post">
            <h2><?php the_title(); ?></h2>
            <p><?php the_content(); ?></p>
        </div>

    <?php endwhile; ?>

<?php else : ?>

    <p>No posts found.</p>

<?php endif; ?>

<?php get_footer(); ?>