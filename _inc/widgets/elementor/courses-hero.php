<?php // Courses Hero Elementor Widget

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

class WGP_Courses_Hero extends Widget_Base
{

    public function get_name() {
        return 'wgp_courses_hero';
    }

    public function get_title() {
        return __('Courses Hero', 'wgp');
    }

    public function get_icon() {
        return 'wgp-widget-icon';
    }

    public function get_categories() {
        return ['wgp_courses_page'];
    }

    protected function _register_controls() {
        register_common_controls($this, [
            ['section_tagline', 'Section Tagline', Controls_Manager::TEXTAREA],
            ['section_title', 'Section Title', Controls_Manager::TEXTAREA],
            ['body_text', 'Body Text', Controls_Manager::TEXTAREA, ['rows' => 6]]
        ]);
    }

    protected function render() {

        $settings = $this->get_settings_for_display();

        if ( Plugin::$instance->editor->is_edit_mode() || Plugin::$instance->preview->is_preview_mode() ) {
            get_template_part('_inc/partials/icon-svg-symbols');
        } ?>

        <section class="wgp-courses-hero">
            <div class="inner-wrap">
                <p class="section-tagline"><?php echo $settings['section_tagline']; ?></p>
                <h2 class="section-title"><?php echo $settings['section_title']; ?></h2>
                <div class="section-img-wrap">
                    <img src="<?php bloginfo('template_url'); ?>/_inc/assets/img/courses-hero.svg" class="section-img">
                </div>
                <p class="body-text"><?php echo $settings['body_text']; ?></p>
                <?php get_template_part('_inc/partials/btn-ask-quote'); ?>
            </div>
        </section>

    <?php }

}

Plugin::instance()->widgets_manager->register_widget_type( new WGP_Courses_Hero() );