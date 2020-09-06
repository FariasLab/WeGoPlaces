<?php // Theme Functions

// Required Files
require_once get_template_directory() . '/_inc/classes/class-tgm-plugin-activation.php';


// Register Required Plugins
add_action( 'tgmpa_register', function () {
    tgmpa([
        [
            'name'      => 'Elementor Page Builder',
            'slug'      => 'elementor',
            'required'  => true
        ],
        [
            'name'      => 'Elementor – Header, Footer & Blocks Template',
            'slug'      => 'header-footer-elementor',
            'required'  => true
        ]
    ],[
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
    // set_post_thumbnail_size( 1200, 9999 );
    // add_image_size( 'o_fullscreen', 1980, 9999 );

    add_theme_support(
        'html5',
        array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'script',
            'style',
        )
    );
});


// Enqueue Styles and Scripts
add_action( 'wp_enqueue_scripts', function () {
    $theme_version = wp_get_theme()->get( 'Version' );

    // Styles
    wp_enqueue_style( 'wgp-style', get_stylesheet_uri(), array(), $theme_version );
    // wp_add_inline_style( 'o-style', o_get_customizer_css( 'front-end' ) );

    // Scripts
    if ( ( ! is_admin() ) && is_singular() && comments_open() && get_option( 'thread_comments' ) )
        wp_enqueue_script( 'comment-reply' );
    wp_enqueue_script( 'wgp-script', get_template_directory_uri() . '/_inc/assets/js/script.js', array(), $theme_version, true );
    // wp_script_add_data( 'o-script', 'async', true );
});


// Navigation Menus
add_action( 'init', function () {
    register_nav_menus([
        'header' => __('Header Menu', 'wgp'),
        'footer' => __('Footer Menu', 'wgp')
    ]);
});


// Helper Functions

// Shim for wp_body_open, ensuring backward compatibility with versions of WordPress older than 5.2.
if ( ! function_exists( 'wp_body_open' ) ) {
    function wp_body_open() {
        do_action( 'wp_body_open' );
    }
}

//function built_with_elementor($id) {
//	return class_exists('Elementor\Plugin') && \Elementor\Plugin::$instance->db->is_built_with_elementor($id);
//}