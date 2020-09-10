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

        $this->start_controls_section(
            'content_section', [
                'label' => __( 'Content', 'wgp' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $raw_html = '<br>' . __( 'Go to Appearance > Menus and select Header Menu to edit the menu.', 'wgp' );
        $raw_html .= '<br><br>' . __( 'Go to WGP Options > Header & Footer to edit the phone number and social links.', 'wgp' );
        $raw_html .= '<br><br>' . __( 'For other changes please contact your web developer.', 'wgp' );
        $this->add_control(
            'help', [
                'label' => __( 'To edit the header content:', 'wgp' ),
                'type' => Controls_Manager::RAW_HTML,
                'label_block' => true,
                'raw' => $raw_html
            ]
        );

        $this->end_controls_section();

    }

    protected function render() {

        if ( Plugin::$instance->editor->is_edit_mode() || Plugin::$instance->preview->is_preview_mode() ) {
            get_template_part('_inc/partials/icon-svg-symbols');
        } ?>

        <div class="wgp-site-header">
            <div class="inner-wrap">
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

                                /*wp_nav_menu([
                                    'menu_class' => 'menu lang-switcher',
                                    'container' => '',
                                    'depth' => 1,
                                    'theme_location' => 'lang_switcher'
                                ]);*/ ?>
                                <ul class="menu lang-switcher">
                                    <li class="current-menu-item"><a href="#">Eng</a></li>
                                    <li><a href="#">Por</a></li>
                                </ul>
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
                <section class="wgp-site-header-collapsed">
                    <div class="inner-wrap">
                        <?php get_template_part('_inc/partials/hf-phone-link');
                        get_template_part('_inc/partials/hf-whatsapp-skype');
                        get_template_part('_inc/partials/hf-instagram-facebook');

                        wp_nav_menu([
                            'menu_class' => 'menu header-menu',
                            'container' => '',
                            'depth' => 1,
                            'theme_location' => 'header'
                        ]);

                        get_template_part('_inc/partials/btn-menu-icon'); ?>
                    </div>
                </section>
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