<?php // Theme Functions

// Imports & Misc Required Files

use Elementor\Plugin as EP;

require_once get_template_directory() . '/_inc/classes/class-tgm-plugin-activation.php';
require_once get_template_directory() . '/_inc/partials/redux-config.php';
require_once get_template_directory() . '/_inc/partials/controls-helper.php';


// Require Custom Elementor Widgets
add_action( 'elementor/widgets/widgets_registered', function() {
    require_once( get_template_directory() . '/_inc/widgets/elementor/site-header.php' );
    require_once( get_template_directory() . '/_inc/widgets/elementor/site-footer.php' );
    require_once( get_template_directory() . '/_inc/widgets/elementor/home-hero.php' );
    require_once( get_template_directory() . '/_inc/widgets/elementor/home-training.php' );
    require_once( get_template_directory() . '/_inc/widgets/elementor/home-translation.php' );
    require_once( get_template_directory() . '/_inc/widgets/elementor/home-testimonials.php' );
    require_once( get_template_directory() . '/_inc/widgets/elementor/home-clients.php' );
    require_once( get_template_directory() . '/_inc/widgets/elementor/home-blog.php' );
});


// Register Required Plugins
add_action( 'tgmpa_register', function () {
    tgmpa([
        [
            'name'      => 'Elementor Page Builder',
            'slug'      => 'elementor',
            'required'  => true
        ], [
            'name'      => 'Elementor – Header, Footer & Blocks Template',
            'slug'      => 'header-footer-elementor',
            'required'  => true
        ], [
            'name'      => 'Redux – Gutenberg Blocks Library & Framework',
            'slug'      => 'redux-framework',
            'required'  => true
        ]
    ], [
        'id'           => 'wgp',
        'default_path' => '',
        'menu'         => 'tgmpa-install-plugins',
        'parent_slug'  => 'themes.php',
        'capability'   => 'edit_theme_options',
        'has_notices'  => true,
        'dismissable'  => false,
        'is_automatic' => false,
        'message'      => ''
    ]);
});


// Theme Support
add_action( 'after_setup_theme', function() {
    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'title-tag' );
    add_theme_support( 'align-wide' );
    add_theme_support( 'responsive-embeds' );
    add_theme_support( 'customize-selective-refresh-widgets' );
    add_theme_support( 'header-footer-elementor' );

    add_theme_support( 'post-thumbnails' );
    add_image_size( 'wgp_656x366', 656, 366, true ); // post single
    add_image_size( 'wgp_1312x732', 1312, 732, true ); // post single 2x
    add_image_size( 'wgp_360x202', 360, 202, true ); // blog page + all mobile post thumbs
    add_image_size( 'wgp_720x404', 720, 404, true ); // blog page 2x
    add_image_size( 'wgp_1023x654', 1023, 654, true ); // home blog
    add_image_size( 'wgp_200x200', 200, 200, false ); // client logos 2x
    add_image_size( 'wgp_160x160', 160, 160, true ); // avatar 2x

    add_theme_support(
        'html5', [
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'script',
            'style'
        ]
    );
});


// Categories for Custom Elementor Widgets
add_action( 'elementor/init', function() {
    EP::$instance->elements_manager->add_category('wgp_header_footer', ['title' => __( 'WGP Header & Footer', 'wgp' )]);
    EP::$instance->elements_manager->add_category('wgp_home_page', ['title' => __( 'WGP Home Page', 'wgp' )]);
    EP::$instance->elements_manager->add_category('wgp_about_page', ['title' => __( 'WGP About Page', 'wgp' )]);
    EP::$instance->elements_manager->add_category('wgp_courses_page', ['title' => __( 'WGP Courses Page', 'wgp' )]);
    EP::$instance->elements_manager->add_category('wgp_translation_page', ['title' => __( 'WGP Translation Page', 'wgp' )]);
    EP::$instance->elements_manager->add_category('wgp_clients_page', ['title' => __( 'WGP Clients Page', 'wgp' )]);
    EP::$instance->elements_manager->add_category('wgp_blog_page', ['title' => __( 'WGP Blog Page', 'wgp' )]);
    EP::$instance->elements_manager->add_category('wgp_contact_page', ['title' => __( 'WGP Contact Page', 'wgp' )]);
});


// Icon CSS for Custom Elementor Widgets
add_action( 'elementor/editor/before_enqueue_scripts', function() {
    $theme_version = wp_get_theme()->get( 'Version' );
    wp_enqueue_style( 'wgp-widget-icons', get_template_directory_uri() . '/_inc/assets/admin/widgets-icon.css', [], $theme_version );
});


// Prevent Elementor from loading Google Fonts
add_filter( 'elementor/frontend/print_google_fonts', '__return_false' );


// Prevent Elementor form loading Font Awesome
add_action( 'elementor/frontend/after_register_styles', function() {
    foreach( [ 'solid', 'regular', 'brands' ] as $style ) {
        wp_deregister_style( 'elementor-icons-fa-' . $style );
    }
}, 20 );


// Enqueue CSS
add_action( 'wp_enqueue_scripts', function () {
    $theme_version = wp_get_theme()->get( 'Version' );
    wp_enqueue_style( 'wgp-style', get_stylesheet_uri(), [], $theme_version );
});


// Enqueue JS
add_action( 'elementor/frontend/before_enqueue_scripts', function() {
    $theme_version = wp_get_theme()->get( 'Version' );
    wp_deregister_script( 'swiper');
    wp_register_script('swiper', get_template_directory_uri() . '/_inc/assets/js/swiper.min.js', [], '4.5.1', true);
    wp_enqueue_script('wgp-script', get_template_directory_uri() . '/_inc/assets/js/script.js', [
        'swiper'
    ], $theme_version, true);
}, 20 );


// Navigation Menus
add_action( 'init', function () {
    register_nav_menus([
        'header' => __('Header Menu', 'wgp'),
        'footer' => __('Footer Menu', 'wgp'),
        'lang_switcher' => __('Language Switcher Menu', 'wgp')
    ]);
});


// Icon System SVG Symbols
add_action('wp_body_open', function () {
    get_template_part('_inc/partials/icon-svg-symbols');
});
