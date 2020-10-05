<?php // Single Post Template

global $WGP;

get_header(); ?>

<section class="site-main wgp-blog-single">
    <div class="inner-wrap">
        <div class="full-post-wrap">
            <a href="<?php echo get_page_link($WGP['blog_page_id']); ?>" class="more-link back-link">
                <svg class="arrow-icon"><use xlink:href="#arrow-icon"></svg>
                <span class="link-text"><?php echo $WGP['all_posts_text']; ?></span>
            </a>

            <?php if (have_posts()) {
                while (have_posts()) {
                    the_post();
                    $author_id = get_the_author_meta('ID');
                    $avatar_url = get_wp_user_avatar_src($author_id, 'wgp_160x160');
                    $author_name = get_the_author_meta('display_name');

                    if (has_post_thumbnail()) { ?>
                        <div class="thumbnail-wrap">
                            <img src="<?php the_post_thumbnail_url('wgp_685x384'); ?>" class="thumbnail-img">
                        </div>
                    <?php } ?>

                    <h2 class="post-title"><?php the_title(); ?></h2>
                    <div class="post-meta">
                        <?php if ($avatar_url) { ?>
                            <div class="avatar-wrap">
                                <img src="<?php echo $avatar_url; ?>" class="avatar-img">
                            </div>
                        <?php } ?>
                        <p class="name-date-wrap"><?php echo $author_name . ' &bull; '; the_date('M Y'); ?></p>
                    </div>
                    <div class="post-content"><?php the_content(); ?></div>

                <?php }
            } ?>
        </div>

        <?php get_sidebar(); ?>
    </div>
</section>

<?php get_footer(); ?>
