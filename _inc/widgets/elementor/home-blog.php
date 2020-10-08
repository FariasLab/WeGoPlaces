<?php // Home Blog Elementor Widget

namespace Elementor;

use WP_Query;

if ( ! defined( 'ABSPATH' ) ) exit;

class WGP_Home_Blog extends Widget_Base
{

    public function get_name() {
        return 'wgp_home_blog';
    }

    public function get_title() {
        return __('Home blog', 'wgp');
    }

    public function get_icon() {
        return 'wgp-widget-icon';
    }

    public function get_categories() {
        return ['wgp_home_page'];
    }

    protected function _register_controls() {
        register_common_controls($this, [
            ['read_link_text', 'Read Link Text', Controls_Manager::TEXT]
        ]);
    }

    protected function render() {

        global $WGP;
        $settings = $this->get_settings_for_display();
        $posts_query = new WP_Query([
            'post_type' => 'post',
            'posts_per_page' => 5
        ]);

        if ( Plugin::$instance->editor->is_edit_mode() || Plugin::$instance->preview->is_preview_mode() ) {
            get_template_part('_inc/partials/icon-svg-symbols');
        } ?>

        <section class="wgp-home-blog">
            <div class="inner-wrap">
                <header class="section-header">
                    <div class="section-img-wrap">
                        <img src="<?php bloginfo('template_url'); ?>/_inc/assets/img/home-blog.jpg?v=2" class="section-img">
                    </div>
                    <img src="<?php bloginfo('template_url'); ?>/_inc/assets/img/blog-title.svg" class="blog-title">
                    <p class="blog-tagline"><?php echo $WGP['blog_tagline']; ?></p>
                </header>

                <ul class="posts-list">
                    <?php if ($posts_query->have_posts()) {
                        while ($posts_query->have_posts()) {
                            $posts_query->the_post(); ?>

                            <li class="posts-list-item">
                                <h3 class="post-title"><?php echo get_the_title(); ?></h3>
                                <p class="post-date"><?php echo get_the_date('M Y'); ?></p>
                                <a href="<?php the_permalink(); ?>" class="more-link">
                                    <span class="link-text"><?php echo $settings['read_link_text']; ?></span>
                                    <svg class="arrow-icon">
                                        <use xlink:href="#arrow-icon">
                                    </svg>
                                </a>
                            </li>

                        <?php }
                    } ?>
                </ul>
            </div>
        </section>

        <?php wp_reset_postdata();
    }
}

Plugin::instance()->widgets_manager->register_widget_type( new WGP_Home_Blog() );