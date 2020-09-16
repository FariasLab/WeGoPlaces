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
        register_common_controls($this, [
            ['section_tagline', 'Section Tagline', Controls_Manager::TEXTAREA],
            ['section_title', 'Section Title', Controls_Manager::TEXTAREA],
            ['icon1_text', 'Icon 1 Text', Controls_Manager::TEXT],
            ['icon2_text', 'Icon 2 Text', Controls_Manager::TEXT],
            ['icon3_text', 'Icon 3 Text', Controls_Manager::TEXT],
            ['button_text', 'Button Text', Controls_Manager::TEXT],
            ['button_link', 'Button Link', Controls_Manager::URL]
        ]);
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
                    <?php foreach ($icon_list as $item) {
                        $img_src = get_template_directory_uri() . '/_inc/assets/img/icon-' . $item['icon'] . '.svg';
                        $img_class = 'icon-img icon-' . $item['icon']; ?>
                        <li class="icon-list-item">
                            <div class="icon-wrap">
                                <img src="<?php echo $img_src; ?>" class="<?php echo $img_class; ?>">
                            </div>
                            <div class="icon-text"><?php echo $item['text']; ?></div>
                        </li>
                    <?php } ?>
                </ul>
                <div class="more-link-wrap">
                    <a href="<?php echo $settings['button_link']['url']; ?>" class="more-link">
                        <span class="link-text"><?php echo $settings['button_text']; ?></span>
                        <svg class="arrow-icon"><use xlink:href="#arrow-icon"></svg>
                    </a>
                </div>
            </div>
        </section>

    <?php }

}

Plugin::instance()->widgets_manager->register_widget_type( new WGP_Home_Training() );