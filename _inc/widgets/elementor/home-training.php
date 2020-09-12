<?php // Home Training Elementor Widget

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

class WGP_Home_Training extends Widget_Base
{

    public function get_name() {
        return 'wgp_home_training';
    }

    public function get_title() {
        return __('Home Training', 'wgp');
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
            'icon1_text', [
                'label' => __( 'Icon 1 Text', 'wgp' ),
                'label_block' => true,
                'type' => Controls_Manager::TEXT
            ]
        );

        $this->add_control(
            'icon2_text', [
                'label' => __( 'Icon 2 Text', 'wgp' ),
                'label_block' => true,
                'type' => Controls_Manager::TEXT
            ]
        );

        $this->add_control(
            'icon3_text', [
                'label' => __( 'Icon 3 Text', 'wgp' ),
                'label_block' => true,
                'type' => Controls_Manager::TEXT
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

        $settings = $this->get_settings_for_display();
        $icon_list = [
            ['icon' => 'tune', 'text' => $settings['icon1_text']],
            ['icon' => 'chat', 'text' => $settings['icon2_text']],
            ['icon' => 'stairs', 'text' => $settings['icon3_text']]
        ];

        if ( Plugin::$instance->editor->is_edit_mode() || Plugin::$instance->preview->is_preview_mode() ) {
            get_template_part('_inc/partials/icon-svg-symbols');
        } ?>

        <section class="wgp-home-training">
            <div class="inner-wrap">
                <p class="section-tagline"><?php echo $settings['section_tagline']; ?></p>
                <h2 class="section-title"><?php echo $settings['section_title']; ?></h2>
                <div class="section-img-wrap">
                    <img src="<?php bloginfo('template_url'); ?>/_inc/assets/img/home-training.svg" class="section-img">
                </div>
                <ul class="icon-list">
                    <?php foreach ($icon_list as $item) { ?>
                        <li class="icon-list-item">
                            <div class="icon-wrap">
                                <img src="<?php bloginfo('template_url'); echo '/_inc/assets/img/icon-' . $item['icon'] . '.svg'; ?>" class="icon-img">
                            </div>
                            <div class="icon-text"><?php echo $item['text']; ?></div>
                        </li>
                    <?php } ?>
                </ul>
                <a href="<?php echo $settings['button_link']['url']; ?>" class="more-link">
                    <span class="link-text"><?php echo $settings['button_text']; ?></span>
                    <svg class="arrow-icon"><use xlink:href="#arrow-icon"></svg>
                </a>
            </div>
        </section>

    <?php }

}

Plugin::instance()->widgets_manager->register_widget_type( new WGP_Home_Training() );