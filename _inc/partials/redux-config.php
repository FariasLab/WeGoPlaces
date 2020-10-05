<?php // Redux Config

if ( ! class_exists( 'Redux' ) ) return;

$opt_name = 'WGP';
$pages = get_pages();
$page_options = [];
$home_testimonials_options = [];

foreach ($pages as $page) $page_options[$page->ID] = $page->post_title;

Redux::disable_demo();

Redux::set_args( $opt_name, [
    'display_name' => 'We Go Places Options',
    'menu_title' => esc_html__( 'WGP Options', 'wgp' ),
    'customizer' => true,
    'dev_mode' => false
] );




// General Section

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
        ], [
            'id' => 'cookie_consent_text',
            'type' => 'textarea',
            'rows' => 3,
            'title' => esc_html__( 'Cookie Consent Text', 'wgp' ),
            'subtitle' => esc_html__( 'Ex: By using our website you agree to our use of cookies to deliver a better experience', 'wgp' ),
        ]
    ]
]);


// Header & Footer Section

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


// Testimonials Section

$testimonial_fields = [
    [
        'id' => 'testimonials_section_start',
        'type' => 'section',
        'title' => '&nbsp;',
        'indent' => true
    ]
];

for ($i = 1; $i <= 6; $i++) {
    $testimonial_fields[] = [
        'id' => "testimonial_text_$i",
        'type' => 'editor',
        'title' => esc_html__( "Testimonial $i", 'wgp' ),
        'subtitle' => esc_html__( 'Enter your clients quote here', 'wgp' ),
        'args' => [
            'media_buttons' => false,
            'textarea_rows' => 6
        ]
    ];
    $testimonial_fields[] = [
        'id' => "testimonial_author_$i",
        'type' => 'text',
        'title' => esc_html__( 'Author Name', 'wgp' ),
        'subtitle' => esc_html__( "of Testimonial $i", 'wgp' )
    ];
    $testimonial_fields[] = [
        'id' => "testimonial_company_$i",
        'type' => 'text',
        'title' => esc_html__( 'Author Company', 'wgp' ),
        'subtitle' => esc_html__( "of Testimonial $i", 'wgp' )
    ];
    $testimonial_fields[] = [
        'id' => "testimonial_divider_$i",
        'type' => 'raw',
        'content' => '<div style="height: 30px"></div>'
    ];

    $home_testimonials_options["$i"] = "$i";
}

$testimonial_fields[] = [
    'id' => 'testimonials_section_end',
    'type' => 'section',
    'indent' => false
];

$testimonial_fields[] = [
    'id' => 'home_testimonials',
    'type' => 'select',
    'multi' => true,
    'title'  => esc_html__( 'Home Testimonials', 'wgp' ),
    'desc'  => esc_html__( 'Select which testimonials to show in the Home Page', 'wgp' ),
    'options' => $home_testimonials_options,
    'sortable' => true,
    'default' => ['5', '4', '1']
];

Redux::set_section( $opt_name, [
    'title'  => esc_html__( 'Testimonials', 'wgp' ),
    'desc'  => esc_html__( 'Edit testimonials shown in the Home Page and Clients Page in one place here.', 'wgp' ),
    'id'     => 'testimonials',
    'fields' => $testimonial_fields
]);


// Client Logos

$client_fields = [
    [
        'id' => 'clients_section_start',
        'type' => 'section',
        'title' => '&nbsp;',
        'indent' => true
    ]
];

for ($i = 1; $i <= 6; $i++) {
    $client_fields[] = [
        'id' => "client_logo_$i",
        'type' => 'media',
        'title' => esc_html__( "Client Logo $i", 'wgp' ),
        'subtitle' => esc_html__( 'Upload logo image in jpg/png', 'wgp' ),
        'library_filter' => ['jpg', 'png']
    ];
    $client_fields[] = [
        'id' => "client_logo_width_$i",
        'type' => 'slider',
        'title' => esc_html__( 'Width (%)', 'wgp' ),
        'subtitle' => esc_html__( "of Client Logo $i", 'wgp' ),
        'display_value' => 'label',
        'default' => 80,
        'min' => 1,
        'max' => 100
    ];
    $client_fields[] = [
        'id' => "client_divider_$i",
        'type' => 'raw',
        'content' => '<div style="height: 30px"></div>'
    ];
}

$client_fields[] = [
    'id' => 'client_section_end',
    'type' => 'section',
    'indent' => false
];

Redux::set_section( $opt_name, [
    'title'  => esc_html__( 'Client Logos', 'wgp' ),
    'desc'  => esc_html__( 'Edit client logos shown in the Home Page and Clients Page in one place here.', 'wgp' ),
    'id'     => 'clients',
    'fields' => $client_fields
]);


// Blog Section

Redux::set_section( $opt_name, [
    'title'  => esc_html__( 'Blog', 'wgp' ),
    'desc'  => esc_html__( 'Edit common content from blog pages in one place here.', 'wgp' ),
    'id'     => 'blog',
    'fields' => [
        [
            'id' => 'blog_page_id',
            'type' => 'select',
            'title' => esc_html__( 'Blog Page', 'wgp' ),
            'subtitle' => esc_html__( 'Ex: Bea\'s Blog', 'wgp' ),
            'options' => $page_options
        ], [
            'id' => 'blog_tagline',
            'type' => 'text',
            'title' => esc_html__( 'Blog Tagline', 'wgp' ),
            'subtitle' => esc_html__( 'Ex: Interesting tips for learning a new language', 'wgp' )
        ], [
            'id' => 'all_posts_text',
            'type' => 'text',
            'title' => esc_html__( 'All Posts Button Text', 'wgp' ),
            'subtitle' => esc_html__( 'Ex: All Posts', 'wgp' )
        ], [
            'id' => 'search_form_text',
            'type' => 'text',
            'title' => esc_html__( 'Search Form Text', 'wgp' ),
            'subtitle' => esc_html__( 'Ex: Search previous posts', 'wgp' )
        ], [
            'id' => 'popular_posts_title',
            'type' => 'text',
            'title' => esc_html__( 'Popular Posts Title', 'wgp' ),
            'subtitle' => esc_html__( 'Ex: Popular Posts', 'wgp' )
        ]
    ]
]);


// Error 404 Section

Redux::set_section( $opt_name, [
    'title'  => esc_html__( 'Error 404', 'wgp' ),
    'desc'  => esc_html__( 'Edit content from Error 404 pages in one place here.', 'wgp' ),
    'id'     => 'error_404',
    'fields' => [
        [
            'id' => 'main_text_404',
            'type' => 'textarea',
            'rows' => 2,
            'title' => esc_html__( 'Error 404 Main Text', 'wgp' ),
            'subtitle' => esc_html__( 'Ex: The page you\'re looking for could not be found (error 404)', 'wgp' )
        ], [
            'id' => 'more_text_404',
            'type' => 'text',
            'title' => esc_html__( 'Error 404 More Text', 'wgp' ),
            'subtitle' => esc_html__( 'Ex: Let us guide you back. Go back to the', 'wgp' )
        ], [
            'id' => 'link_text_404',
            'type' => 'text',
            'title' => esc_html__( 'Error 404 Link Text', 'wgp' ),
            'subtitle' => esc_html__( 'Ex: homepage', 'wgp' )
        ], [
            'id' => 'link_id_404',
            'type' => 'select',
            'title' => esc_html__( 'Error 404 Link Page', 'wgp' ),
            'subtitle' => esc_html__( 'Ex: Home', 'wgp' ),
            'options' => $page_options
        ]
    ]
]);