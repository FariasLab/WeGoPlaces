<?php // Footer Template ?>

            <?php get_template_part('_inc/partials/fixed-footer'); ?>
            <div class="site-footer-wrap">
                <?php if ( function_exists( 'hfe_footer_enabled' ) && hfe_footer_enabled() ) {
                    hfe_render_footer();
                } ?>
            </div>
        </div><!-- /.site-wrap -->
        <?php wp_footer(); ?>
    </body>
</html>