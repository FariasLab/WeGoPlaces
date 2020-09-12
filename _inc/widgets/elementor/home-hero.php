<?php // Home Hero Elementor Widget

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

class WGP_Home_Hero extends Widget_Base
{

    public function get_name() {
        return 'wgp_home_hero';
    }

    public function get_title() {
        return __('Home Hero', 'wgp');
    }

    public function get_icon() {
        return 'wgp-widget-icon';
    }

    public function get_categories() {
        return ['wgp_home_page'];
    }

    protected function _register_controls() {
        register_common_controls($this, [
            ['section_tagline', 'Section Tagline', Controls_Manager::TEXTAREA],
            ['section_title', 'Section Title', Controls_Manager::TEXTAREA],
            ['body_text', 'Body Text', Controls_Manager::TEXTAREA, ['rows' => 6]],
            ['button_text', 'Button Text', Controls_Manager::TEXT],
            ['button_link', 'Button Link', Controls_Manager::URL],
        ]);
    }

    protected function render() {

        $settings = $this->get_settings_for_display();

        if ( Plugin::$instance->editor->is_edit_mode() || Plugin::$instance->preview->is_preview_mode() ) {
            get_template_part('_inc/partials/icon-svg-symbols');
        } ?>

        <section class="wgp-home-hero">
            <div class="inner-wrap">
                <header class="section-header">
                    <p class="section-tagline"><?php echo $settings['section_tagline']; ?></p>
                    <h2 class="section-title"><?php echo $settings['section_title']; ?></h2>
                </header>
                <div class="section-img-wrap">
                    <img src="<?php bloginfo('template_url'); ?>/_inc/assets/img/home-hero.svg" class="section-img">
                </div>
                <p class="body-text"><?php echo $settings['body_text']; ?></p>
                <?php get_template_part('_inc/partials/btn-ask-quote'); ?>
            </div>
        </section>

    <?php }

}

Plugin::instance()->widgets_manager->register_widget_type( new WGP_Home_Hero() );