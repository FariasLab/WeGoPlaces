<?php // Contact Form Elementor Widget

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

class WGP_Contact_Form extends Widget_Base
{

    public function get_name() {
        return 'wgp_contact_form';
    }

    public function get_title() {
        return __('Contact Form', 'wgp');
    }

    public function get_icon() {
        return 'wgp-widget-icon';
    }

    public function get_categories() {
        return ['wgp_contact_page'];
    }

    protected function _register_controls() {
        register_common_controls($this, [
            ['name_label', 'Name Label', Controls_Manager::TEXT],
            ['company_label', 'Company Label', Controls_Manager::TEXT],
            ['email_label', 'Email Label', Controls_Manager::TEXT],
            ['phone_label', 'Phone Label', Controls_Manager::TEXT],
            ['message_label', 'Message Label', Controls_Manager::TEXT],
            ['required_alert', 'Required Alert', Controls_Manager::TEXT],
            ['submit_text', 'Submit Text', Controls_Manager::TEXT],
            ['submitting_text', 'Submitting Text', Controls_Manager::TEXT],
            ['success_main_text', 'Success Main Text', Controls_Manager::TEXT],
            ['success_more_text', 'Success More Text', Controls_Manager::TEXTAREA],
            ['error_main_text', 'Error Main Text', Controls_Manager::TEXT],
            ['contact_info_title', 'Contact Info Title', Controls_Manager::TEXT],
            ['contact_info_text', 'Contact Info Text', Controls_Manager::TEXTAREA]
        ]);
    }

    protected function render() {

        $settings = $this->get_settings_for_display();

        if ( Plugin::$instance->editor->is_edit_mode() || Plugin::$instance->preview->is_preview_mode() ) {
            get_template_part('_inc/partials/icon-svg-symbols');
        } ?>

        <section class="wgp-contact-form">
            <div class="inner-wrap">
                <form class="form-wrap wgp-form" role="search" method="post" action="">
                    <?php foreach (['name', 'company', 'email', 'phone'] as $input) {
                        $required = in_array($input, ['name', 'email']) ? 'required' : '';
                        $type = $input ==  'phone' ? 'tel' : $input == 'email' ? 'email' : 'text'; ?>
                        <label class="form-label">
                            <span class="label-text <?php echo $required; ?>"><?php echo $settings["{$input}_label"]; ?></span>
                            <input class="form-field" type="<?php echo $type; ?>" value="" name="<?php echo $input; ?>" autocomplete="off" <?php echo $required; ?>>
                        </label>
                    <?php } ?>
                    <label class="form-label message-label">
                        <span class="label-text required"><?php echo $settings['message_label']; ?></span>
                        <textarea class="form-field textarea" value="" name="message" autocomplete="off" required></textarea>
                    </label>
                    <p class="required"><?php echo $settings['required_alert']; ?></p>
                    <button type="submit" class="btn-submit btn-primary">
                        <div class="inner-wrap">
                            <span class="btn-text" data-submit="<?php echo $settings['submit_text']; ?>" data-submitting="<?php echo $settings['submitting_text']; ?>"></span>
                            <svg class="arrow-icon"><use xlink:href="#arrow-icon"></svg>
                        </div>
                    </button>
                </form>

                <div class="info-wrap">
                    <p class="info-title"><?php echo $settings['contact_info_title']; ?></p>
                    <p class="info-text"><?php echo $settings['contact_info_text']; ?></p>
                    <div class="links-wrap">
                        <?php get_template_part('_inc/partials/hf-phone-link');
                        get_template_part('_inc/partials/hf-whatsapp-skype');
                        get_template_part('_inc/partials/hf-instagram-facebook'); ?>
                    </div>
                </div>
            </div>
            <div class="alert-wrap">
                <div class="form-alert success">
                    <div class="main-alert">
                        <svg class="alert-icon check-icon"><use xlink:href="#check-icon"></svg>
                        <p class="alert-text"><?php echo $settings['success_main_text']; ?></p>
                    </div>
                    <p class="more-alert-text"><?php echo $settings['success_more_text']; ?></p>
                </div>

                <div class="form-alert error">
                    <div class="main-alert">
                        <svg class="alert-icon check-icon"><use xlink:href="#error-icon"></svg>
                        <p class="alert-text"><?php echo $settings['error_main_text']; ?></p>
                    </div>
                </div>
            </div>
        </section>

        <script type="text/javascript">
            if (window.initContactFormById) {
                window.initContactFormById('<?php echo $this->get_id(); ?>');
            } else {
                window.addEventListener('contactFormReadyToInit', function() {
                    window.initContactFormById('<?php echo $this->get_id(); ?>');
                });
            }
        </script>

    <?php }

}

Plugin::instance()->widgets_manager->register_widget_type( new WGP_Contact_Form() );