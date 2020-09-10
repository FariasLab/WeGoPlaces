<?php // Site Footer Elementor Widget

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

class WGP_Site_Footer extends Widget_Base
{

    public function get_name() {
        return 'wgp_site_footer';
    }

    public function get_title() {
        return __('Site Footer', 'wgp');
    }

    public function get_icon() {
        return 'wgp-widget-icon';
    }

    public function get_categories() {
        return ['wgp_header_footer'];
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
            'footer_claims', [
                'label' => __( 'Footer Claims', 'wgp' ),
                'label_block' => true,
                'type' => Controls_Manager::TEXT
            ]
        );

        $this->add_control(
            'footer_locations', [
                'label' => __( 'Footer Locations', 'wgp' ),
                'label_block' => true,
                'type' => Controls_Manager::TEXT
            ]
        );

        $this->add_control(
            'contacts_title', [
                'label' => __( 'Contacts Title', 'wgp' ),
                'label_block' => true,
                'type' => Controls_Manager::TEXT
            ]
        );

        $this->add_control(
            'socials_title', [
                'label' => __( 'Socials Title', 'wgp' ),
                'label_block' => true,
                'type' => Controls_Manager::TEXT
            ]
        );

        $this->add_control(
            'blog_title', [
                'label' => __( 'Blog Title', 'wgp' ),
                'label_block' => true,
                'type' => Controls_Manager::TEXT
            ]
        );

        $this->add_control(
            'blog_link', [
            'label' => __( 'Blog Link', 'wgp' ),
            'type' => Controls_Manager::URL,
            'show_external' => false
        ]);

        $raw_html = '<br>' . __( 'Go to Appearance > Menus and select Footer Menu to edit the menu.', 'wgp' );
        $raw_html .= '<br><br>' . __( 'Go to WGP Options > Header & Footer to edit the phone number and social links.', 'wgp' );
        $raw_html .= '<br><br>' . __( 'For other changes please contact your web developer.', 'wgp' );
        $this->add_control(
            'help', [
                'label' => __( 'To edit other footer content:', 'wgp' ),
                'type' => Controls_Manager::RAW_HTML,
                'label_block' => true,
                'separator' => 'before',
                'raw' => $raw_html
            ]
        );

        $this->end_controls_section();

    }

    protected function render() {

        $settings = $this->get_settings_for_display();

        if ( Plugin::$instance->editor->is_edit_mode() || Plugin::$instance->preview->is_preview_mode() ) {
            get_template_part('_inc/partials/icon-svg-symbols');
        } ?>

        <section class="wgp-site-footer">
            <div class="inner-wrap">
                <div class="logo-wrap">
                    <a href="<?php echo home_url(); ?>" class="logo-link">
                        <img src="<?php bloginfo('template_url'); ?>/_inc/assets/img/logo-wgp-footer.svg" class="logo-img"/>
                    </a>
                    <p class="footer-claims"><?php echo $settings['footer_claims']; ?></p>
                    <p><?php echo $settings['footer_locations']; ?></p>
                </div>

                <?php wp_nav_menu([
                    'menu_class' => 'footer-menu',
                    'container' => '',
                    'depth' => 1,
                    'theme_location' => 'footer'
                ]); ?>

                <div class="contacts-wrap">
                    <p class="footer-title"><?php echo $settings['contacts_title']; ?></p>
                    <?php get_template_part('_inc/partials/hf-phone-link');
                    get_template_part('_inc/partials/hf-whatsapp-skype'); ?>
                </div>

                <div class="socials-wrap">
                    <p class="footer-title"><?php echo $settings['socials_title']; ?></p>
                    <a href="<?php echo $settings['blog_link']['url']; ?>" class="blog-link">
                        <?php echo $settings['blog_title']; ?>
                    </a>
                    <?php get_template_part('_inc/partials/hf-instagram-facebook'); ?>
                </div>
            </div>
        </section>

    <?php }

}

Plugin::instance()->widgets_manager->register_widget_type( new WGP_Site_Footer() );