<?php // Redux Config

if ( ! class_exists( 'Redux' ) ) return;

Redux::disable_demo();

$opt_name = 'WGP';

Redux::set_args( $opt_name, [
    'display_name' => 'We Go Places Options',
    'menu_title' => esc_html__( 'WGP Options', 'wgp' ),
    'customizer' => true,
    'dev_mode' => false
] );

$pages = get_pages();
$page_options = [];
foreach ($pages as $page) $page_options[$page->ID] = $page->post_title;

Redux::set_section( $opt_name, [
    'title'  => esc_html__( 'General', 'wgp' ),
    'desc'  => esc_html__( 'Edit common content from multiple pages in one place here.', 'wgp' ),
    'id'     => 'general',
    'fields' => [
        [
            'id' => 'quote_section_start',
            'type' => 'section',
            'title' => esc_html__( 'Ask for a Quote Button', 'wgp' ),
            'indent' => true
        ], [
            'id' => 'quote_btn_text',
            'type' => 'text',
            'title' => esc_html__( 'Button Text', 'wgp' ),
            'subtitle' => esc_html__( 'Ex: Ask for a Quote', 'wgp' )
        ], [
            'id' => 'quote_page_id',
            'type' => 'select',
            'title' => esc_html__( 'Button Link', 'wgp' ),
            'subtitle' => esc_html__( 'Ex: Contact', 'wgp' ),
            'options' => $page_options
        ], [
            'id' => 'quote_section_end',
            'type' => 'section',
            'indent' => false
        ]
    ]
]);

Redux::set_section( $opt_name, [
    'title'  => esc_html__( 'Header & Footer', 'wgp' ),
    'desc'  => esc_html__( 'Edit common content from the header and footer in one place here.', 'wgp' ),
    'id'     => 'header_footer',
    'fields' => [
        [
            'id' => 'phone_section_start',
            'type' => 'section',
            'title' => esc_html__( 'Phone Number Details', 'wgp' ),
            'indent' => true
        ], [
            'id' => 'country_code',
            'type' => 'text',
            'title' => esc_html__( 'Country Code', 'wgp' ),
            'subtitle' => esc_html__( 'Ex: +351', 'wgp' )
        ], [
            'id' => 'phone_number',
            'type' => 'text',
            'title' => esc_html__( 'Phone Number', 'wgp' ),
            'subtitle' => esc_html__( 'Ex: 967 763 522', 'wgp' )
        ], [
            'id' => 'phone_section_end',
            'type' => 'section',
            'indent' => false
        ],

        [
            'id' => 'icons_section_start',
            'type' => 'section',
            'title' => esc_html__( 'Icon Links', 'wgp' ),
            'indent' => true
        ], [
            'id' => 'whatsapp_link',
            'type' => 'text',
            'title' => esc_html__( 'Whatsapp Icon', 'wgp' ),
            'subtitle' => esc_html__( 'Ex: https://wa.me/351967763522', 'wgp' )
        ], [
            'id' => 'skype_link',
            'type' => 'text',
            'title' => esc_html__( 'Skype Icon', 'wgp' ),
            'subtitle' => esc_html__( 'Ex: skype:wegoplaces?chat', 'wgp' )
        ], [
            'id' => 'instagram_link',
            'type' => 'text',
            'title' => esc_html__( 'Instagram Icon', 'wgp' ),
            'subtitle' => esc_html__( 'Ex: https://www.instagram.com/wegoplacespt', 'wgp' )
        ], [
            'id' => 'facebook_link',
            'type' => 'text',
            'title' => esc_html__( 'Facebook Icon', 'wgp' ),
            'subtitle' => esc_html__( 'Ex: https://fb.me/wegoplaces.beasaiani', 'wgp' )
        ], [
            'id' => 'icons_section_end',
            'type' => 'section',
            'indent' => false
        ]
    ]
]);
