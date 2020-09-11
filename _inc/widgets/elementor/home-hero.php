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

        $this->start_controls_section(
            'content_section', [
                'label' => __('Content', 'wgp'),
                'label_block' => true,
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'section_tagline', [
                'label' => __( 'Section Tagline', 'wgp' ),
                'label_block' => true,
                'type' => Controls_Manager::TEXTAREA,
                'rows' => 2
            ]
        );

        $this->add_control(
            'section_title', [
                'label' => __( 'Section Title', 'wgp' ),
                'label_block' => true,
                'type' => Controls_Manager::TEXTAREA,
                'rows' => 2
            ]
        );

        $this->add_control(
            'body_text', [
                'label' => __( 'Body Text', 'wgp' ),
                'label_block' => true,
                'type' => Controls_Manager::TEXTAREA,
                'rows' => 6
            ]
        );

        $this->add_control(
            'button_text', [
                'label' => __( 'Button Text', 'wgp' ),
                'label_block' => true,
                'type' => Controls_Manager::TEXT
            ]
        );

        $this->add_control(
            'button_link', [
            'label' => __( 'Button Link', 'wgp' ),
            'type' => Controls_Manager::URL,
            'show_external' => false
        ]);

        $this->add_control(
            'help', [
                'label' => __( 'To edit other content:', 'wgp' ),
                'type' => Controls_Manager::RAW_HTML,
                'label_block' => true,
                'separator' => 'before',
                'raw' => '<br>' . __( 'Please contact your web developer.', 'wgp' )
            ]
        );

        $this->end_controls_section();

    }

    protected function render() {

        $settings = $this->get_settings_for_display(); ?>

        <section class="wgp-home-hero hero-section">
            <div class="inner-wrap">
                <header class="section-header">
                    <p class="section-tagline"><?php echo $settings['section_tagline']; ?></p>
                    <h2 class="section-title"><?php echo $settings['section_title']; ?></h2>
                </header>
                <img src="<?php bloginfo('template_url'); ?>/_inc/assets/img/home-hero.svg" class="section-img">
                <p class="body-text"><?php echo $settings['body_text']; ?></p>
                <?php get_template_part('_inc/partials/btn-ask-quote'); ?>
            </div>
        </section>

    <?php }

}

Plugin::instance()->widgets_manager->register_widget_type( new WGP_Home_Hero() );