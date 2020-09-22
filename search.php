<?php  // Search Results Template

get_header(); ?>

    <main class="site-main">

        <?php if (have_posts()) {
            while (have_posts()) {
                the_post(); ?>
                <p><?php the_title(); ?></p>
            <?php }
        } ?>
    </main>

<?php get_footer(); ?>