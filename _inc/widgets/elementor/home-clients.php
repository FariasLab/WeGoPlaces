<?php // Home Clients Elementor Widget

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

class WGP_Home_Clients extends Widget_Base
{

    public function get_name() {
        return 'wgp_home_clients';
    }

    public function get_title() {
        return __('Home Clients', 'wgp');
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
            ['section_title', 'Section Title', Controls_Manager::TEXTAREA]
        ]);
    }

    protected function render() {

        global $WGP;
        $settings = $this->get_settings_for_display(); ?>

        <section class="wgp-home-clients">
            <div class="inner-wrap">
                <p class="section-tagline"><?php echo $settings['section_tagline']; ?></p>
                <h2 class="section-title"><?php echo $settings['section_title']; ?></h2>
                <?php // var_dump($WGP['client_logo_1']); ?>
                <ul class="logos-list">
                    <?php for ($i = 1; $i <= 6; $i++) { ?>
                        <li class="logos-list-item">

                        </li>
                    <?php } ?>
                </ul>
            </div>
        </section>

    <?php }

}

Plugin::instance()->widgets_manager->register_widget_type( new WGP_Home_Clients() );