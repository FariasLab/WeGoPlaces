<?php // Blog Hero Elementor Widget

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

class WGP_Blog_Hero extends Widget_Base
{

    public function get_name() {
        return 'wgp_blog_hero';
    }

    public function get_title() {
        return __('Blog Hero', 'wgp');
    }

    public function get_icon() {
        return 'wgp-widget-icon';
    }

    public function get_categories() {
        return ['wgp_blog_page'];
    }

    protected function _register_controls() {
        $raw_html = '<br>' . __( 'Go to WGP Options > Blog to edit the tagline.', 'wgp' );
        register_common_controls($this, [
            ['instructions', 'Instructions to edit the main content:', Controls_Manager::RAW_HTML, ['raw' => $raw_html]]
        ]);
    }

    protected function render() {

        global $WGP; ?>

        <section class="wgp-blog-hero">
            <div class="inner-wrap">
                <img src="<?php bloginfo('template_url'); ?>/_inc/assets/img/blog-title.svg" class="blog-title">
                <p class="blog-tagline"><?php echo $WGP['blog_tagline']; ?></p>
            </div>
        </section>

    <?php }

}

Plugin::instance()->widgets_manager->register_widget_type( new WGP_Blog_Hero() );