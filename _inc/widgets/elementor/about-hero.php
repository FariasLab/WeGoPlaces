<?php // About Hero Elementor Widget

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

class WGP_About_Hero extends Widget_Base
{

    public function get_name() {
        return 'wgp_about_hero';
    }

    public function get_title() {
        return __('About Hero', 'wgp');
    }

    public function get_icon() {
        return 'wgp-widget-icon';
    }

    public function get_categories() {
        return ['wgp_about_page'];
    }

    protected function _register_controls() {
        register_common_controls($this, [
            ['section_tagline', 'Section Tagline', Controls_Manager::TEXTAREA],
            ['section_title', 'Section Title', Controls_Manager::TEXTAREA]
        ]);
    }

    protected function render() {

        $settings = $this->get_settings_for_display(); ?>

        <section class="wgp-about-hero">
            <div class="inner-wrap">
                <p class="section-tagline"><?php echo $settings['section_tagline']; ?></p>
                <h2 class="hero-title smaller-on-tablet"><?php echo $settings['section_title']; ?></h2>
                <div class="section-img-wrap">
                    <img src="<?php bloginfo('template_url'); ?>/_inc/assets/img/about-hero.svg" class="section-img">
                </div>
            </div>
        </section>

    <?php }

}

Plugin::instance()->widgets_manager->register_widget_type( new WGP_About_Hero() );