<?php  // 404 Template

global $WGP;

// Force 404 if necessary
if ( ! is_404() ) {
    status_header( 404 );
    nocache_headers();
    if ( isset( $the_query ) ) {
        $the_query->is_404 = true;
    } else{
        $wp_query->is_404 = true;
    }
}

get_header(); ?>

<section class="site-main wgp-404">
    <div class="inner-wrap">
        <h2 class="section-title"><?php echo $WGP['main_text_404']; ?></h2>
        <div class="section-img-wrap">
            <img src="<?php bloginfo('template_url'); ?>/_inc/assets/img/404.svg" class="section-img">
        </div>
        <p class="body-text">
            <?php echo $WGP['more_text_404']; ?>
            <a href="<?php echo get_page_link($WGP['link_id_404']); ?>" class="body-link">
                <?php echo $WGP['link_text_404']; ?>
            </a>
        </p>
    </div>
</section>

<?php get_footer(); ?>