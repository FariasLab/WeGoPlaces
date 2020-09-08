<?php // Site Header Elementor Widget

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

class WGP_Site_Header extends \Elementor\Widget_Base {

    public function get_name() {
        return 'wgp_site_header';
    }

    public function get_title() {
        return __( 'Site Header', 'wgp' );
    }

    public function get_icon() {
        return 'wgp-widget-icon';
    }

    public function get_categories() {
        return [ 'wgp_header_footer' ];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'content_section', [
                'label' => __( 'Content', 'wgp' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $raw_html = '<br>' . __( 'Go to Appearance > Menus to edit the menu.', 'wgp' );
        $raw_html .= '<br><br>' . __( 'Go to WGP Options > Header & Footer to edit the phone number and social links.', 'wgp' );
        $raw_html .= '<br><br>' . __( 'For other changes please contact your web developer.', 'wgp' );
        $this->add_control(
            'help', [
                'label' => __( 'To edit the header content:', 'wgp' ),
                'type' => \Elementor\Controls_Manager::RAW_HTML,
                'label_block' => true,
                'raw' => $raw_html
            ]
        );

        $this->end_controls_section();

    }

    protected function render() { ?>

        <section class="wgp-site-header">
            <div class="inner-wrap">
                <div class="logo-wrap">
                    <a href="<?php echo home_url(); ?>" class="logo-link">
                        <img src="<?php bloginfo('template_url'); ?>/_inc/assets/img/logo-wgp-header.png" class="logo-img"/>
                    </a>
                </div>
                <nav class="nav-wrap">
                    <div class="top-wrap">
                        <a href="tel:+351967763522" class="phone-number-link">
                            <span class="country-code">+351 </span><span class="phone-number">967 763 522</span>
                        </a>
                        <a href="#" class="hf-icon whatsapp">
                            <svg><use xlink:href="#whatsapp-icon"></svg>
                        </a>
                        <a href="#" class="hf-icon skype">
                            <svg><use xlink:href="#skype-icon"></svg>
                        </a>
                        <a href="#" class="hf-icon instagram">
                            <svg><use xlink:href="#instagram-icon"></svg>
                        </a>
                        <a href="#" class="hf-icon facebook">
                            <svg><use xlink:href="#facebook-icon"></svg>
                        </a>
                        <?php wp_nav_menu([
                            'menu_class' => 'menu lang-switcher',
                            'container' => '',
                            'depth' => 1,
                            'theme_location' => 'lang_switcher'
                        ]); ?>
                    </div>
                    <?php wp_nav_menu([
                        'menu_class' => 'menu header-menu',
                        'container' => '',
                        'depth' => 1,
                        'theme_location' => 'header'
                    ]); ?>
                </nav>
            </div>
        </section>

    <?php }
}

Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\WGP_Site_Header() );