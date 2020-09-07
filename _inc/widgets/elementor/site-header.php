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

        <header class="wgp-site-header">
            Header stuff will go here
        </header>

    <?php }
}

Plugin::instance()->widgets_manager->register_widget_type( new \Elementor\WGP_Site_Header() );