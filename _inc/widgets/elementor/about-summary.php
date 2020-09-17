<?php // About Summary Elementor Widget

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

class WGP_About_Summary extends Widget_Base
{

    public function get_name() {
        return 'wgp_about_summary';
    }

    public function get_title() {
        return __('About Summaary', 'wgp');
    }

    public function get_icon() {
        return 'wgp-widget-icon';
    }

    public function get_categories() {
        return ['wgp_about_page'];
    }

    protected function _register_controls() {
        register_common_controls($this, [
            ['summary_text', 'Summary Text', Controls_Manager::TEXTAREA, ['rows' => 15]],
            ['text_below_signature', 'Text Below Signature', Controls_Manager::TEXT]
        ]);
    }

    protected function render() {

        $settings = $this->get_settings_for_display(); ?>

        <section class="wgp-about-summary">
            <div class="inner-wrap">
                <div class="columns-wrap">
                    <p class="summary-text"><?php echo nl2br($settings['summary_text']); ?></p>
                    <img src="<?php bloginfo('template_url'); ?>/_inc/assets/img/beatriz-signature.svg" class="signature-img">
                    <p class="text-below-signature"><?php echo $settings['text_below_signature']; ?></p>
                </div>
            </div>
        </section>

    <?php }

}

Plugin::instance()->widgets_manager->register_widget_type( new WGP_About_Summary() );