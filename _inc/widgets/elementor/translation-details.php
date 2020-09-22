<?php // Translation Details Elementor Widget

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

class WGP_Translation_Details extends Widget_Base
{

    public function get_name() {
        return 'wgp_translation_details';
    }

    public function get_title() {
        return __('Translation Details', 'wgp');
    }

    public function get_icon() {
        return 'wgp-widget-icon';
    }

    public function get_categories() {
        return ['wgp_translation_page'];
    }

    protected function _register_controls() {
        register_common_controls($this, [
            ['icon1_title', 'Icon 1 Title', Controls_Manager::TEXT],
            ['icon1_text', 'Icon 1 Text', Controls_Manager::TEXTAREA, ['rows' => 6]],
            ['icon2_title', 'Icon 2 Title', Controls_Manager::TEXT],
            ['icon2_text', 'Icon 2 Text', Controls_Manager::TEXTAREA, ['rows' => 6]],
            ['icon3_title', 'Icon 3 Title', Controls_Manager::TEXT],
            ['icon3_text', 'Icon 3 Text', Controls_Manager::TEXTAREA, ['rows' => 6]],
            ['icon4_title', 'Icon 4 Title', Controls_Manager::TEXT],
            ['icon4_text', 'Icon 4 Text', Controls_Manager::TEXTAREA, ['rows' => 6]],
            ['check_list_title', 'Check List Title', Controls_Manager::TEXT],
        ], true, false);

        $check_list = new Repeater();

        $check_list->add_control(
            'check_item_text', [
                'label' => __('Check Item Text', 'wgp'),
                'type' => Controls_Manager::TEXTAREA,
                'rows' => 2
            ]
        );

        $this->add_control(
            'check_list', [
                'label' => __( 'Check List', 'wgp' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $check_list->get_controls(),
                'title_field' => '{{{ check_item_text }}}'
            ]
        );

        register_section_end($this);
    }

    protected function render() {

        $settings = $this->get_settings_for_display();
        $icons = ['website', 'manual', 'brochure', 'documents'];

        if ( Plugin::$instance->editor->is_edit_mode() || Plugin::$instance->preview->is_preview_mode() ) {
            get_template_part('_inc/partials/icon-svg-symbols');
        } ?>

        <section class="wgp-translation-details wgp-2-cols-details">
            <div class="inner-wrap">
                <ul class="block-list">
                    <?php for ($i = 0; $i < 4; $i++) {
                        $img_src = get_template_directory_uri() . "/_inc/assets/img/icon-$icons[$i].svg";
                        $img_class = "icon-img icon-$icons[$i]"; ?>
                        <li class="block-list-item">
                            <div class="icon-wrap">
                                <img src="<?php echo $img_src; ?>" class="<?php echo $img_class; ?>">
                            </div>
                            <p class="block-title"><?php echo $settings['icon' . ($i + 1) . '_title']; ?></p>
                            <p class="block-text"><?php echo $settings['icon' . ($i + 1) . '_text']; ?></p>
                        </li>
                    <?php } ?>
                </ul>

                <ul class="check-list">
                    <li class="section-title"><?php echo $settings['check_list_title']; ?></li>
                    <?php if ($settings['check_list']) {
                        foreach ($settings['check_list'] as $item) { ?>
                            <li class="check-list-item">
                                <svg class="check-icon"><use xlink:href="#check-icon"></svg>
                                <p class="check-item-text"><?php echo $item['check_item_text']; ?></p>
                            </li>
                        <?php }
                    } ?>
                </ul>
            </div>
        </section>

    <?php }

}

Plugin::instance()->widgets_manager->register_widget_type( new WGP_Translation_Details() );