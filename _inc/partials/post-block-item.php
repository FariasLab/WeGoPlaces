<?php // Partial - Post Block Item for WP_Query Loops

global $WGP;
$author_id = get_the_author_meta('ID');
$avatar_url = get_wp_user_avatar_src($author_id, 'wgp_160x160'); ?>

<div class="post-block-item">
    <div class="author-avatar">
        <img src="<?php echo $avatar_url; ?>" class="avatar-img">
    </div>
    <h2 class="post-title">
        <a href="<?php the_permalink(); ?>" class="title-link"><?php echo get_the_title(); ?></a>
    </h2>
    <p class="post-date"><?php echo get_the_date('M Y'); ?></p>
    <p class="post-excerpt"><?php the_excerpt(); ?></p>
    <a href="<?php the_permalink(); ?>" class="more-link">
        <span class="link-text"><?php echo $WGP['btn_continue_text']; ?></span>
        <svg class="arrow-icon"><use xlink:href="#arrow-icon"></svg>
    </a>
</div>
