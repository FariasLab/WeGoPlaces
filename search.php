<?php  // Search Results Template

global $WGP;

get_header(); ?>

<section class="site-main wgp-search-results wgp-posts-loop">
    <div class="inner-wrap">
        <div class="main-column-wrap">
            <a href="<?php echo get_page_link($WGP['blog_page_id']); ?>" class="more-link back-link">
                <svg class="arrow-icon"><use xlink:href="#arrow-icon"></svg>
                <span class="link-text"><?php echo $WGP['all_posts_text']; ?></span>
            </a>

            <?php get_search_form(); ?>

            <p class="results-title <?php echo $wp_query->found_posts === 0 ? 'zero-found' : ''; ?>">
                <?php echo '<span class="found-posts">' . $wp_query->found_posts . ' </span>';
                if ($wp_query->found_posts !== 1) echo $WGP['results_for_text'];
                else echo $WGP['result_for_text']; ?>
                <span class="search-term"><?php the_search_query(); ?></span>
            </p>

            <?php /* if ($wp_query->found_posts === 0) { // Back to all posts & New Search } */ ?>

            <?php if (have_posts()) {
                while (have_posts()) {
                    the_post();
                    get_template_part('_inc/partials/post-block-item');
                }
            } ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>