<?php // Blog Page & Posts Sidebar Template

$posts_query = new WP_Query([
    'post_type' => 'post',
    'posts_per_page' => 10,
    'meta_key' => 'wgp_post_views_count',
    'orderby' => 'meta_value_num',
    'order' => 'DESC'
]); ?>

<div class="sidebar-wrap">
    <?php get_search_form();

    if ($posts_query->have_posts()) { ?>
        <div class="popular-posts">
            <p class="popular-posts-title">Popular Posts</p>
            <ol class="popular-posts-list">
                <?php while ($posts_query->have_posts()) {
                    $posts_query->the_post(); ?>

                    <li class="popular-list-item">
                        <a href="<?php the_permalink(); ?>" class="post-link">
                            <span class="link-text"><?php the_title(); ?></span>
                            <svg class="arrow-icon"><use xlink:href="#arrow-icon"></svg>
                        </a>
                    </li>
                <?php } ?>
            </ol>
        </div>
    <?php } ?>
</div>

<?php wp_reset_postdata(); ?>