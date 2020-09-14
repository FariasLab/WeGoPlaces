<?php // Home Testimonials Elementor Widget

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

class WGP_Home_Testimonials extends Widget_Base
{

    public function get_name() {
        return 'wgp_home_testimonials';
    }

    public function get_title() {
        return __('Home Testimonials', 'wgp');
    }

    public function get_icon() {
        return 'wgp-widget-icon';
    }

    public function get_categories() {
        return ['wgp_home_page'];
    }

    protected function _register_controls() {
        $raw_html = '<br>' . __( 'Go to WGP Options > Testimonials to edit the testimonials.', 'wgp' );
        register_common_controls($this, [
            ['instructions', 'Instructions to edit the main content:', Controls_Manager::RAW_HTML, ['raw' => $raw_html]]
        ]);
    }

    protected function render() {

        global $WGP; ?>

        <section class="wgp-home-testimonials">
            <div class="inner-wrap">
                <ul class="testimonial-list">
                     <?php for ($i = 1; $i <= 3; $i++) { ?>
                         <li class="testimonial-list-item">
                             <img src="<?php bloginfo('template_url'); ?>/_inc/assets/img/icon-quote.svg" class="icon-quote">
                             <div class="testimonial-text">
                                 <?php echo $WGP["testimonial_text_$i"]; ?>
                             </div>
                             <div class="author-wrap">
                                 <div class="author-name">
                                     <?php echo $WGP["testimonial_author_$i"]; ?>
                                 </div>
                                 <div class="author-company">
                                     <?php echo $WGP["testimonial_company_$i"]; ?>
                                 </div>
                             </div>
                         </li>
                     <?php } ?>
                </ul>
            </div>
        </section>

    <?php }

}

Plugin::instance()->widgets_manager->register_widget_type( new WGP_Home_Testimonials() );