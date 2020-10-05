<?php // About Team Elementor Widget

namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit;

class WGP_About_Team extends Widget_Base
{

    public function get_name() {
        return 'wgp_about_team';
    }

    public function get_title() {
        return __('About Team', 'wgp');
    }

    public function get_icon() {
        return 'wgp-widget-icon';
    }

    public function get_categories() {
        return ['wgp_about_page'];
    }

    protected function _register_controls() {
        register_section_start($this);
        register_common_control($this, ['section_title', 'Section Title', Controls_Manager::TEXT]);

        $team_members = new Repeater();

        $team_members->add_control(
            'member_name', [
                'label' => __('Member Name', 'wgp'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true
            ]
        );

        $team_members->add_control(
            'member_avatar', [
                'label' => __('Member Avatar', 'wgp'),
                'type' => Controls_Manager::MEDIA
            ]
        );

        $team_members->add_control(
            'member_bio', [
                'label' => __('Member Bio', 'wgp'),
                'type' => Controls_Manager::TEXTAREA,
                'rows' => 12
            ]
        );

        $this->add_control(
			'team_members', [
				'label' => __( 'Team Members', 'wgp' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => $team_members->get_controls(),
				'title_field' => '{{{ member_name }}}'
			]
		);

        register_common_control($this, ['button_text', 'Button Text', Controls_Manager::TEXT]);
        register_section_end($this);
    }

    protected function render() {

        $settings = $this->get_settings_for_display();

        if ( Plugin::$instance->editor->is_edit_mode() || Plugin::$instance->preview->is_preview_mode() ) {
            get_template_part('_inc/partials/icon-svg-symbols');
        } ?>

        <section class="wgp-about-team">
            <div class="inner-wrap">
                <p class="section-tagline"><?php echo $settings['section_title']; ?></p>
                <div class="columns-wrap">
                    <?php if ($settings['team_members']) {
                        foreach ($settings['team_members'] as $team_member) { ?>
                            <div class="team-member">
                                <p class="team-member-name"><?php echo $team_member['member_name']; ?></p>
                                <div class="avatar-bio-wrap">
                                    <div class="team-avatar-wrap">
                                        <?php $img_id = $team_member['member_avatar']['id'];
                                        if ($img_id) {
                                            $img_src = wp_get_attachment_image_src($img_id, 'wgp_160x160')[0]; ?>
                                            <img src="<?php echo $img_src; ?>" class="avatar-img">
                                        <?php } else { ?>
                                            <img src="<?php bloginfo('template_url'); ?>/_inc/assets/img/icon-avatar.svg" class="avatar-img">
                                        <?php } ?>
                                    </div>
                                    <div class="bio-wrap">
                                        <p class="member-bio"><?php echo nl2br($team_member['member_bio']); ?></p>
                                        <div class="more-link-wrap">
                                            <a href="#" class="more-link">
                                                <span class="link-text"><?php echo $settings['button_text']; ?></span>
                                                <svg class="arrow-icon"><use xlink:href="#arrow-icon"></svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php }
                    } ?>
                </div>
            </div>
        </section>

        <div class="wgp-page-overlay">
            <div class="scrollable-wrap">
                <div class="popup-wrap">
                    <a href="#" class="btn-close-popup">
                        <svg class="close-icon"><use xlink:href="#close-icon"></svg>
                    </a>
                    <header class="popup-header">
                        <div class="team-avatar-wrap"></div>
                        <p class="team-member-name"></p>
                    </header>
                    <p class="member-bio"></p>
                </div>
            </div>
        </div>

        <script type="text/javascript">
            if (window.initAboutTeamById) {
                window.initAboutTeamById('<?php echo $this->get_id(); ?>');
            } else {
                window.addEventListener('aboutTeamReadyToInit', function() {
                    window.initAboutTeamById('<?php echo $this->get_id(); ?>');
                });
            }
        </script>

    <?php }

}

Plugin::instance()->widgets_manager->register_widget_type( new WGP_About_Team() );