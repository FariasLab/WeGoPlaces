<?php // Site Header Elementor Widget

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

class WGP_Site_Header extends Widget_Base
{

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
        $raw_html = '<br>' . __( 'Go to WGP Options > Header & Footer to edit the phone number and social links.', 'wgp' );
        $raw_html .= '<br><br>' . __( 'Go to Appearance > Menus and select Header Menu or Language Switcher Menu to edit the respective menu.', 'wgp' );
        register_common_controls($this, [
            ['instructions', 'Instructions to edit the main content:', Controls_Manager::RAW_HTML, ['raw' => $raw_html]]
        ]);
    }

    protected function render() {

        if ( Plugin::$instance->editor->is_edit_mode() || Plugin::$instance->preview->is_preview_mode() ) {
            get_template_part('_inc/partials/icon-svg-symbols');
        } ?>

        <div class="wgp-site-header">
            <section class="wgp-site-header-expanded">
                <div class="inner-wrap">
                    <div class="logo-wrap">
                        <a href="<?php echo home_url(); ?>" class="logo-link">
                            <img src="<?php bloginfo('template_url'); ?>/_inc/assets/img/logo-wgp-header.svg" class="logo-img"/>
                        </a>
                        <?php get_template_part('_inc/partials/btn-menu-icon'); ?>
                    </div>
                    <nav class="nav-wrap">
                        <div class="top-wrap">
                            <?php get_template_part('_inc/partials/hf-phone-link');
                            get_template_part('_inc/partials/hf-whatsapp-skype');
                            get_template_part('_inc/partials/hf-instagram-facebook');
                            get_template_part('_inc/partials/lang-switcher');
                            get_template_part('_inc/partials/btn-menu-icon'); ?>
                        </div>
                        <?php get_template_part('_inc/partials/header-menu'); ?>
                    </nav>
                </div>
            </section>

            <section class="wgp-site-header-collapsed">
                <div class="inner-wrap">
                    <?php get_template_part('_inc/partials/hf-phone-link');
                    get_template_part('_inc/partials/hf-whatsapp-skype');
                    get_template_part('_inc/partials/hf-instagram-facebook');
                    get_template_part('_inc/partials/header-menu');
                    get_template_part('_inc/partials/btn-menu-icon'); ?>
                </div>
            </section>

            <div class="wgp-site-header-dropdown">
                <?php get_template_part('_inc/partials/lang-switcher');
                get_template_part('_inc/partials/header-menu');
                get_template_part('_inc/partials/hf-instagram-facebook'); ?>
                <a href="#" class="btn-close-dropdown">
                    <img src="<?php bloginfo('template_url'); ?>/_inc/assets/img/icon-close.svg" class="icon-close">
                </a>
            </div>
        </div>

        <script type="text/javascript">
            if (window.initSiteHeaderById) {
                window.initSiteHeaderById('<?php echo $this->get_id(); ?>');
            } else {
                window.addEventListener('siteHeaderReadyToInit', function() {
                    window.initSiteHeaderById('<?php echo $this->get_id(); ?>');
                });
            }
        </script>

    <?php }
}

Plugin::instance()->widgets_manager->register_widget_type( new WGP_Site_Header() );