<?php // Home Blog Elementor Widget

namespace Elementor;

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
            ['blog_tagline', 'Blog Tagline', Controls_Manager::TEXTAREA],
            ['read_link_text', 'Read Link Text', Controls_Manager::TEXT]
        ]);
    }

    protected function render() {

        $settings = $this->get_settings_for_display();

        if ( Plugin::$instance->editor->is_edit_mode() || Plugin::$instance->preview->is_preview_mode() ) {
            get_template_part('_inc/partials/icon-svg-symbols');
        } ?>

        <section class="wgp-home-blog">
            <div class="inner-wrap">
                <header class="section-header">
                    <div class="section-img-wrap">
                        <img src="<?php bloginfo('template_url'); ?>/_inc/assets/img//home-blog.jpg" class="section-img">
                    </div>
                    <img src="<?php bloginfo('template_url'); ?>/_inc/assets/img//blog-title.svg" class="blog-title">
                    <p class="blog-tagline"><?php echo $settings['blog_tagline']; ?></p>
                </header>
                <ul class="posts-list">
                    <?php for ($i = 0; $i < 3; $i++) { ?>
                        <li class="posts-list-item">
                            <h3 class="post-title">
                                Quis nostrud exercitation ullamco laboris nisi ut aliquip
                            </h3>
                            <p class="post-date">
                                Aug 2, 2020
                            </p>
                            <a href="#" class="more-link">
                                <span class="link-text"><?php echo $settings['read_link_text']; ?></span>
                                <svg class="arrow-icon"><use xlink:href="#arrow-icon"></svg>
                            </a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </section>

    <?php }

}

Plugin::instance()->widgets_manager->register_widget_type( new WGP_Home_Blog() );