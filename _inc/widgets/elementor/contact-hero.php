<?php // Contact Hero Elementor Widget

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

class WGP_Contact_Hero extends Widget_Base
{

    public function get_name() {
        return 'wgp_contact_hero';
    }

    public function get_title() {
        return __('Contact Hero', 'wgp');
    }

    public function get_icon() {
        return 'wgp-widget-icon';
    }

    public function get_categories() {
        return ['wgp_contact_page'];
    }

    protected function _register_controls() {
        register_common_controls($this, [
            ['section_title', 'Section Title', Controls_Manager::TEXTAREA],
            ['body_text', 'Body Text', Controls_Manager::TEXTAREA, ['rows' => 6]]
        ]);
    }

    protected function render() {

        $settings = $this->get_settings_for_display(); ?>

        <section class="wgp-contact-hero">
            <div class="inner-wrap">
                <h2 class="section-title"><?php echo $settings['section_title']; ?></h2>
                <p class="body-text"><?php echo $settings['body_text']; ?></p>
                <div class="alert-wrap"></div>
            </div>
        </section>

    <?php }

}

Plugin::instance()->widgets_manager->register_widget_type( new WGP_Contact_Hero() );