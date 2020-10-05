<?php // Blog Posts Elementor Widget

namespace Elementor;

use WP_Query;

if ( ! defined( 'ABSPATH' ) ) exit;

class WGP_Blog_Posts extends Widget_Base
{

    public function get_name() {
        return 'wgp_blog_posts';
    }

    public function get_title() {
        return __('Blog Posts', 'wgp');
    }

    public function get_icon() {
        return 'wgp-widget-icon';
    }

    public function get_categories() {
        return ['wgp_blog_page'];
    }

    protected function _register_controls() {
        register_common_controls($this, [
            ['popular_posts_title', 'Popular Posts Title', Controls_Manager::TEXT]
        ]);
    }

    protected function render() {

        $settings = $this->get_settings_for_display();
        $posts_query = new WP_Query([
            'post_type' => 'post',
            'posts_per_page' => 5
        ]);

        if ( Plugin::$instance->editor->is_edit_mode() || Plugin::$instance->preview->is_preview_mode() ) {
            get_template_part('_inc/partials/icon-svg-symbols');
        } ?>

        <section class="wgp-blog-posts wgp-posts-loop">
            <div class="inner-wrap">
                <?php get_search_form();

                if ($posts_query->have_posts()) {
                    $posts_query->the_post();
                    $author_id = get_the_author_meta('ID');
                    $avatar_url = get_wp_user_avatar_src($author_id, 'wgp_160x160'); ?>

                    <div class="latest-post">
                        <div class="thumbnail-wrap">
                            <a href="<?php the_permalink(); ?>" class="thumbnail-link">
                                <img src="<?php the_post_thumbnail_url('wgp_685x384'); ?>" class="thumbnail-img">
                            </a>
                            <div class="author-avatar">
                                <img src="<?php echo $avatar_url; ?>" class="avatar-img">
                            </div>
                        </div>
                        <div class="text-wrap">
                            <h2 class="post-title">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h2>
                            <p class="post-date"><?php the_date('M Y'); ?></p>
                            <p class="post-excerpt"><?php the_excerpt(); ?></p>
                            <a href="<?php the_permalink();?>" class="more-link">
                                <span class="link-text"><?php echo $settings['button_text']; ?></span>
                                <svg class="arrow-icon"><use xlink:href="#arrow-icon"></svg>
                            </a>
                        </div>
                    </div>

                <?php } ?>



                <div class="posts-sidebar-wrap">
                    <div class="other-recent-posts">
                        <?php if ($posts_query->have_posts()) {
                            while ($posts_query->have_posts()) {
                                $posts_query->the_post();
                                get_template_part('_inc/partials/post-block-item');
                            }
                        } ?>
                    </div>

                    <?php get_sidebar(); ?>
                </div>
            </div>
        </section>

        <?php wp_reset_postdata();
    }

}

Plugin::instance()->widgets_manager->register_widget_type( new WGP_Blog_Posts() );