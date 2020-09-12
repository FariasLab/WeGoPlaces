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
        $raw_html = '<br>' . __( 'Go to Appearance > Menus and select Footer Menu to edit the menu.', 'wgp' );
        $raw_html .= '<br><br>' . __( 'Go to WGP Options > Header & Footer to edit the phone number and social links.', 'wgp' );
        register_common_controls($this, [
            ['footer_claims', 'Footer Claims', Controls_Manager::TEXT],
            ['footer_locations', 'Footer Locations', Controls_Manager::TEXT],
            ['contacts_title', 'Contacts Title', Controls_Manager::TEXT],
            ['socials_title', 'Socials Title', Controls_Manager::TEXT],
            ['instructions', 'Instructions to edit other main content:', Controls_Manager::RAW_HTML, ['raw' => $raw_html, 'separator' => 'before']]
        ]);
    }

    protected function render() {

        $settings = $this->get_settings_for_display();

        $menu = get_term(get_nav_menu_locations()['footer'], 'nav_menu');
        $menu_items = wp_get_nav_menu_items($menu);
        $last_menu_item = end($menu_items);


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
                    <a href="<?php echo $last_menu_item->url; ?>" class="last-menu-link">
                        <?php echo $last_menu_item->post_title; ?>
                    </a>
                    <?php get_template_part('_inc/partials/hf-instagram-facebook'); ?>
                </div>
            </div>
        </section>

    <?php }

}

Plugin::instance()->widgets_manager->register_widget_type( new WGP_Site_Footer() );