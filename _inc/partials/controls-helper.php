<?php // Register Common Elementor Controls Helper Function

use Elementor\Controls_Manager;
use Elementor\Widget_Base;

function register_common_controls(Widget_Base &$widget, Array $controls = []) {
    register_section_start($widget);

    foreach ($controls as $control) {
        register_common_control($widget, $control);
    }

    register_section_end($widget);
}

function register_section_start(Widget_Base &$widget) {
    $widget->start_controls_section(
        'content_section', [
            'label' => __('Content', 'wgp'),
            'label_block' => true,
            'tab' => Controls_Manager::TAB_CONTENT,
        ]
    );
}

function register_common_control(Widget_Base &$widget, Array $control) {
    // $control[0] - id
    // $control[1] - label
    // $control[2] - type
    // $control[3] - additional args

    $args = [
        'type' => $control[2],
        'label' => __($control[1], 'wgp'),
        'label_block' => true
    ];

    switch ($control[2]) {
        case Controls_Manager::TEXTAREA:
            if (!is_array($control[3]) || !isset($control[3]['rows']))
                $args['rows'] = 2;
            break;
        case Controls_Manager::URL:
            $args['show_external'] = false;
            break;
    }

    if (is_array($control[3]))
        $args = array_merge($args, $control[3]);

    $widget->add_control($control[0], $args);
}

function register_section_end(Widget_Base &$widget) {
    $widget->add_control(
        'help', [
            'label' => __( 'To edit other content:', 'wgp' ),
            'type' => Controls_Manager::RAW_HTML,
            'label_block' => true,
            'separator' => 'before',
            'raw' => '<br>' . __( 'Please contact your web developer.', 'wgp' )
        ]
    );

    $widget->end_controls_section();
}
